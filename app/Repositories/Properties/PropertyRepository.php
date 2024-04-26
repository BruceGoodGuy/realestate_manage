<?php

namespace App\Repositories\Properties;

use App\Repositories\EloquentRepository;
use App\Interfaces\Property\PropertyRepositoryInterface;
use Illuminate\Support\Facades\Storage;
use stdClass;
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

        $updatedata = [];
        // Move content image file to public.
        if (!empty($content)) {
            $draftpaths = $this->retrieveDraftImagePath($content);
            if (!empty($draftpaths)) {
                foreach ($draftpaths as $path) {
                    $filename = explode('/', $path);
                    $newfile = "property/item-$property->id/images/content/" . array_pop($filename);
                    if (Storage::disk('public')->exists($path)) {
                        Storage::disk('public')->move($path, $newfile);
                        $updatedata['content'] = str_replace($path, $newfile, $content);
                    }
                }
            }
        }

        if (!empty($avatarpath)) {
            $filename = explode('/', $avatarpath);
            $newfile = "property/item-$property->id/images/avatar/" . array_pop($filename);
            if (Storage::disk('public')->exists($avatarpath)) {
                Storage::disk('public')->move($avatarpath, $newfile);
                $updatedata['avatar'] = $newfile;
            }
        }

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
            $src = ltrim($image->getAttribute('src'), '.../storage/');
            // Add it to the array
            $srcattributes[] = $src;
        }

        return $srcattributes;
    }
}
