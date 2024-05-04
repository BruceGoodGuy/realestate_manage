<?php

namespace App\Repositories\Properties;

use App\Repositories\EloquentRepository;
use App\Interfaces\Property\PropertyRepositoryInterface;
use Illuminate\Contracts\Cache\Store;
use Illuminate\Support\Facades\Storage;
use stdClass;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Throwable;

class PropertyRepository extends EloquentRepository implements PropertyRepositoryInterface
{
    /**
     * get model
     * @return string
     */
    public function getModel()
    {
        return \App\Models\Property::class;
    }

    public function storeProperty(array $data): stdClass
    {
        $avatarpath = '';
        $content = '';
        $response = (object) ['success' => true, 'data' => [], 'statuscode' => 200, 'message' => 'ok', 'warning' => ''];

        if (!empty($data['avatar'])) {
            $avatarpath = $data['avatar'];
        }

        if (!empty($data['content'])) {
            $content = $data['content'];
        }
        try {
            $property = $this->_model->create($this->setupData($data));
        } catch (Throwable $error) {
            makeLog($error, 'storeProperty first');
            $response->success = false;
            $response->statuscode = 500;
            $response->message = 'Lỗi không xác định.';
            return $response;
        }

        $updatedata = $this->proccessImages($property->id, $content, $avatarpath);

        if (!empty($updatedata)) {
            foreach ($updatedata as $key => $item) {
                $property->$key = $item;
            }
            $property->save();
        }

        $response->data = ['id' => $property->id];

        return $response;
    }

    /**
     * Return list of properties.
     *
     * @param array $options
     * 
     * @return stdClass
     * 
     */
    public function getProperties(array $option): stdClass
    {
        $response = (object) ['success' => true, 'message' => '', 'warning' => '', 'data' => []];
        $fields = ['id', 'name', 'price', 'avatar', 'province', 'status'];
        if (isset($options['extrafields'])) {
            $fields = [...$fields, $options['extrafields']];
        }
        try {
            // TODO - Pagination. 
            $response->data = $this->_model->select($fields)
                ->orderBy($option['order']['by'] ?? 'created_at', $option['order']['order'] ?? 'DESC')
                ->skip($options['skip'] ?? 0)
                ->take($options['take'] ?? config('constants.maxrecords'))
                ->get();
        } catch (Throwable $error) {
            makeLog($error, 'getProperties');
            $response->success = false;
            $response->message = 'Lỗi không xác định.';
        }
        return $response;
    }

    public function getProperty(int $id): stdClass
    {
        $response = (object) ['success' => true, 'message' => '', 'warning' => '', 'data' => [], 'statuscode' => 200];
        try {
            $property = $this->_model->select([
                'id', 'name', 'note', 'price', 'address', 'province', 'district', 'ward',
                'avatar', 'avatar_name', 'status', 'content'
            ])->where('id', $id)->firstOrFail();
            $response->data = $property;
        } catch (ModelNotFoundException $error) {
            $response->success = false;
            $response->statuscode = 404;
            $response->message = 'Không thể tìm thấy bất động sản.';
        }

        return $response;
    }

    public function updateProperty($data): stdClass
    {
        $response = (object) ['success' => true, 'message' => 'Đã cập nhật thành công', 'warning' => '', 'data' => [], 'statuscode' => 200];

        try {
            $property = $this->_model->where('id', $data['id'])->firstOrFail();
            $updatedata =  [];
            $oldimages = [];
            if ($property->avatar !== $data['avatar']) {
                $property->avatar_name = $data['avatar_name'];
                $updatedata['avatar'] = $data['avatar'];
                if (!empty($property->avatar)) {
                    $oldimages[] = $property->avatar;
                }
            }

            if ($property->content !== $data['content']) {
                $updatedata['content'] =  $data['content'];
                $newimages = array_map(function ($new) {
                    return asset(ltrim($new, "'../'"));
                }, empty($data['content']) ? [] : $this->retrieveDraftImagePath($data['content']));
                $currentimages = empty($property->content) ? [] : $this->retrieveDraftImagePath($property->content ?? '');
                $oldimages = [...$oldimages, ...array_diff($currentimages, $newimages)];
            }

            $contentdata = $this->proccessImages($property->id, $updatedata['content'] ?? '', $updatedata['avatar'] ?? '');
            $data = [...$data, ...$contentdata];
            $data['status'] = isset($data['active']);
            unset($data['id']);
            $property->update($data);
            // Delete old images;
            if (!empty($oldimages)) {
                $oldimages = array_map(function ($url) {
                    $startindex = strpos($url, "property");
                    if ($startindex !== false) {
                        return substr($url, $startindex);
                    } else {
                        return $url; // If "storage" is not found, return the original URL
                    }
                }, $oldimages);
                Storage::disk('public')->delete($oldimages ?? []);
            }
        } catch (ModelNotFoundException $error) {
            $response->success = false;
            $response->statuscode = 404;
            $response->message = 'Không thể tìm thấy bất động sản.';
        } catch (\Throwable $error) {
            makeLog($error, 'updateProperty');
            $response->success = false;
            $response->statuscode = 500;
            $response->message = 'Lỗi không xác định.';
        }
        return $response;
    }

    private function proccessImages(int $id, string $content, string $avatarpath): array
    {
        $updatedata = [];
        // Move content image file to public.
        if (!empty($content)) {
            $draftpaths = $this->retrieveDraftImagePath($content);
            if (!empty($draftpaths)) {
                foreach ($draftpaths as $path) {
                    $filename = explode('/', $path);
                    $filepath = "property/item-$id/images/content/" . array_pop($filename);
                    $newfile = asset('storage/' . $filepath);
                    if (Storage::disk('public')->exists(ltrim($path, '.../storage/'))) {
                        Storage::disk('public')->move(ltrim($path, '.../storage/'), $filepath);
                        $content = str_replace($path, $newfile, $content);
                    }
                }
            }
            $updatedata['content'] = $content;
        }

        if (!empty($avatarpath)) {
            $filename = explode('/', $avatarpath);
            $newfile = "property/item-$id/images/avatar/" . array_pop($filename);
            if (Storage::disk('public')->exists($avatarpath)) {
                Storage::disk('public')->move($avatarpath, $newfile);
                $updatedata['avatar'] = $newfile;
            }
        }

        return $updatedata;
    }


    /**
     * Setup data for content data before saving it.
     *
     * @param array $data Raw content data.
     * @param array $extradata Extra data.
     * @return array content data after adjusted.
     * 
     */
    private function setupData(array $data, array $extradata = []): array
    {
        if (isset($data['province_value'])) {
            $data['province'] = $data['province_value'];
        }
        if (isset($data['district_value'])) {
            $data['district'] = $data['district_value'];
        }
        if (isset($data['ward_value'])) {
            $data['ward'] = $data['ward_value'];
        }

        $data['status'] = (int) isset($data['active']);

        $data['created_by'] = auth()->user()->id;
        unset($data['province_value'], $data['district_value'], $data['ward_value']);
        unset($data['avatar'], $data['content'], $data['active']);

        if (!empty($extradata)) {
            // Merging it.
            $data = [...$data, ...$extradata];
        }

        return $data;
    }

    /**
     * Retrieve list of image path.
     *
     * @param string $content
     * 
     * @return [type]
     * 
     */
    private function retrieveDraftImagePath(string $content)
    {
        // Create a DOMDocument object
        $dom = new \DOMDocument();
        $dom->loadHTML($content);

        // Get all img tags
        $images = $dom->getElementsByTagName('img');

        // Array to store src attributes
        $srcattributes = [];

        // Loop through each img tag
        foreach ($images as $image) {
            // Get the src attribute value
            $src = $image->getAttribute('src');
            // Add it to the array
            $srcattributes[] = $src;
        }

        return $srcattributes;
    }
}
