<?php

namespace App\Repositories\Clients;

use App\Repositories\EloquentRepository;
use App\Interfaces\Client\ClientRepositoryInterface;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Models\Referrals;
use App\Services\Client;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Support\Facades\Auth;

use stdClass;
use Throwable;

class ClientRepository extends EloquentRepository implements ClientRepositoryInterface
{
    /**
     * get model
     * @return string
     */
    public function getModel()
    {
        return \App\Models\Client::class;
    }

    /**
     * Store client
     *
     * @param array $data User data.
     * @return stdClass
     * 
     */
    public function storeClient(array $data): stdClass
    {
        $response = (object) ['success' => true, 'message' => 'Thêm khách hàng thành công.', 'warning' => '', 'data' => [], 'statuscode' => 200,];
        $referralcode = $this->generateReferralCode();
        $userdata = $this->setupData($data, ['referral_code' => $referralcode]);
        try {
            $user = $this->_model::create($userdata);
            $response->data = ['id' => $user->id];
            $relationstatus = $this->addRelation($data['referral_code'] ?? '', $user->id);
            if (!$relationstatus->success) {
                $response->warning = $relationstatus->message;
            }
        } catch (Throwable $error) {
            makeLog($error, 'storeClient');
            $response->success = false;
            $response->statuscode = 500;
            $response->message = 'Lỗi không xác định.';
        }
        return $response;
    }

    /**
     * Return list of clients.
     *
     * @param array $options
     * 
     * @return stdClass
     * 
     */
    public function getClients(array $options): stdClass
    {
        $response = (object) ['success' => true, 'message' => '', 'warning' => '', 'data' => [], 'statuscode' => 200,];
        $fields = ['id', 'firstname', 'lastname', 'status', 'phone', 'email', 'status'];
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
            makeLog($error, 'getClients');
            $response->success = false;
            $response->statuscode = 500;
            $response->message = 'Lỗi không xác định.';
        }
        return $response;
    }

    /**
     * Retrieve a client detail based of the clientID.
     *
     * @param int $clientID
     * @param bool $withreferral.
     * 
     * @return stdClass
     * 
     */
    public function getClient(int $clientID, bool $withreferral = true): stdClass
    {
        $response = (object) ['success' => true, 'statuscode' => 200, 'message' => '', 'warning' => '', 'data' => []];
        try {
            // TODO - Need to improve performance for this SQL.
            // TODO - Need to join more like dynamonds, points and more in the future.
            $fields = [
                'clients.id', 'firstname', 'lastname', 'address', 'province', 'ward', 'district', 'referral_code',
                'note', 'email', 'phone', 'clients.status', 'birthday', 'created_by', 'created_from', 'clients.created_at', 'clients.updated_at'
            ];
            $clientquery = $this->_model::query();
            if ($withreferral) {
                $fields[] = 'referrals.ref_userid';
                $clientquery = $clientquery->leftJoin('referrals', 'clients.id', '=', 'referrals.userid', 'referral_code');
            }
            $client = $clientquery->select($fields)->where('clients.id', $clientID)
                ->firstOrFail()->toArray();

            if ($withreferral && !is_null($client['ref_userid'])) {
                $referraluser = $this->_model->selectRaw('id, CONCAT(lastname, " ", firstname) as fullname, referral_code, status')
                    ->where('id', $client['ref_userid'])->first();
                $client['refuser'] = $referraluser ?? null;
            }
            $response->data = (object) $client;
        } catch (ModelNotFoundException $error) {
            $response->success = false;
            $response->statuscode = 404;
            $response->message = 'Không thể tìm thấy thông tin người dùng.';
        }

        return $response;
    }

    /**
     * Update client put.
     *
     * @param array $data
     * 
     * @return stdClass
     * 
     */
    public function updateClient(array $data): stdClass
    {
        $response = (object) ['success' => true, 'statuscode' => 200, 'message' => 'Cập nhật khách hàng thành công.', 'warning' => '', 'data' => []];

        try {
            $client = $this->_model->where('id', $data['id'])->firstOrFail();
            $userdata = $this->setupData($data);
            $referralcode = $data['referral_code'] ?? '';
            unset($userdata['referral_code'], $userdata['id'], $userdata['phone']);
            if ($referralcode !== $client->referral_code) {
                $relationstatus = $this->addRelation($referralcode, $client->id);
                if (!$relationstatus->success) {
                    $response->warning = $relationstatus->message;
                }
            }

            $client->update($userdata);

            if ((int) $client->status !== config('constants.user.status.active')) {
                // Revoke all tokens.
                $client->tokens()->delete();
            }
        } catch (ModelNotFoundException $error) {
            $response->success = false;
            $response->statuscode = 404;
            $response->message = 'Không thể tìm thấy thông tin người dùng.';
        } catch (\Throwable $error) {
            makeLog($error, 'updateClient');
            $response->success = false;
            $response->statuscode = 500;
            $response->message = 'Lỗi không xác định.';
        }
        return $response;
    }

    public function authenticated(array $authendata): stdClass
    {
        $response = (object) ['success' => true, 'statuscode' => 200, 'message' => 'Đăng nhập thành công', 'data' => []];
        try {
            $client = $this->_model->where('phone', $authendata['phone'])->firstOrFail();
            if (!Hash::check($authendata['password'], $client->password)) {
                throw new ModelNotFoundException('Sai mật khẩu');
            }
            if ((int) $client->status !== config('constants.user.status.active')) {
                $response->success = false;
                $response->statuscode = 403;
                $response->message = 'Tài khoản bị khóa hoặc chưa kích hoạt.';
                return $response;
            }
            $token = $client->createToken('client-api', [config('constants.user.access.client')])->plainTextToken;
            $response->data = (object) ['token' => $token];
        } catch (ModelNotFoundException $error) {
            $response->success = false;
            $response->statuscode = 404;
            $response->message = 'Đăng nhập không thành công.';
        }

        return $response;
    }

    public function updatePassword(array $data): stdClass
    {
        $response = (object) ['success' => true, 'statuscode' => 200, 'message' => 'Cập nhật mật khẩu thành công.', 'data' => []];
        try {
            $client = $this->_model->where('id', Auth::user()->id)->firstOrFail();
            if (!Hash::check($data['password'], $client->password)) {
                throw new ModelNotFoundException('Sai mật khẩu');
            }
            $client->update(['password' => Hash::make($data['new_password'])]);
        } catch (ModelNotFoundException $error) {
            $response->success = false;
            $response->statuscode = 404;
            $response->message = 'Mật khẩu không đúng.';
        }
        return $response;
    }

    /**
     * Get all realtions of the client.
     *
     * @param array $options
     * 
     * @return stdClass
     * 
     */
    public function getRelations(int $userid): stdClass
    {
        $response = (object) ['success' => true, 'data' => [], 'statuscode' => 200];
        $data = $this->getChilds($userid);
        $response->data = $data;
        return $response;
    }

    public function logout(): void
    {
        request()->user()->currentAccessToken()->delete();
    }

    private function getChilds(int $clientids)
    {
        $parents = [];
        $childs = [];

        $data = Referrals::select(['clients.firstname', 'clients.lastname', 'phone', 'clients.status', 'referrals.userid', 'referrals.ref_userid'])
            ->rightJoin('clients', 'clients.id', 'referrals.userid')
            ->where('referrals.userid', $clientids)->orWhere('referrals.ref_userid', $clientids)->get();

        foreach ($data as $d) {
            if ($d->userid === $clientids) {
                $parent = $this->_model->select(['firstname', 'lastname', 'phone', 'status'])->find($d->ref_userid);
                $parents = [
                    'text' => [
                        'name' => $parent->firstname . ' ' . $parent->lastname,
                        'title' => $parent->phone,
                        'status' => $parent->status == 1 ? 'Kích hoạt' : 'Chưa kích hoạt',
                    ],
                    'image' => asset('assets/images/admin.jpg'),
                    'children' => [],
                ];
                $childs = [
                    'text' => [
                        'name' => $d->firstname . ' ' . $d->lastname,
                        'title' => $d->phone,
                        'current' => "Hiện tại",
                        'status' => $d->status == 1 ? 'Kích hoạt' : 'Chưa kích hoạt',
                    ],
                    'image' => asset('assets/images/admin.jpg'),
                ];
                continue;
            } else if ($d->ref_userid === $clientids) {
                if (!isset($childs['stackChildren'])) {
                    $childs['stackChildren'] = true;
                }
                if (!isset($childs['image'])) {
                    $childs['image'] = asset('assets/images/admin.jpg');
                }
                if (!isset($childs['text'])) {
                    $childs = [
                        'text' => [
                            'name' => $d->firstname . ' ' . $d->lastname,
                            'title' => $d->phone,
                            'status' => $d->status == 1 ? 'Kích hoạt' : 'Chưa kích hoạt',
                        ],
                        'image' => asset('assets/images/admin.jpg'),
                    ];
                }
                $childs['children'][] = [
                    'text' => [
                        'name' => $d->firstname . ' ' . $d->lastname,
                        'title' => $d->phone,
                        'status' => $d->status == 1 ? 'Kích hoạt' : 'Chưa kích hoạt',
                    ],
                    'image' => asset('assets/images/admin.jpg'),
                ];
            }
        }
        if (empty($parents)) {
            $parent = $this->_model->select(['firstname', 'lastname', 'phone'])->find($clientids);
            $parents = [
                'text' => [
                    'name' => $parent->firstname . ' ' . $parent->lastname,
                    'title' => $parent->phone,
                    'current' => "Hiện tại",
                    'status' => $parent->status == 1 ? 'Kích hoạt' : 'Chưa kích hoạt',
                ],
                'image' => asset('assets/images/admin.jpg'),
                'children' => [],
            ];
        }
        if (!empty($childs)) {
            $parents['children'][] = $childs;
        }
        return (object) $parents;
    }

    /**
     * Generate a unique referral code for client.
     *
     * @return String
     * 
     */
    private function generateReferralCode(): string
    {
        return "DOLLAR" . Carbon::now()->timestamp . Str::upper(Str::random(10));
    }


    /**
     * Setup data for user data before saving it.
     *
     * @param array $data Raw user data.
     * @param array $extradata Extra data.
     * @return array User data after adjusted.
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
        if (isset($data['password'])) {
            $data['password'] = Hash::make($data['password']);
        }
        if (empty($data['password'])) {
            unset($data['password']);
        }
        unset($data['province_value'], $data['district_value'], $data['ward_value']);

        if (!empty($extradata)) {
            // Merging it.
            $data = [...$data, ...$extradata];
        }

        if (!isset($data['status'])) {
            $data['status'] = env('CLIENT_STATUS');
        }
        return $data;
    }

    /**
     * Add relation between users by referral code.
     *
     * @param string $referralcode
     * @param int $userid
     * 
     * @return stdClass Response status.
     * 
     */
    private function addRelation(string $referralcode, int $userid): stdClass
    {
        $response = Client::checkReferralCode($referralcode);
        if (!$response->success) {
            return $response;
        }

        try {
            // Delete old relation.
            Referrals::where('userid', $userid)->delete();
            // Add the new one.
            Referrals::create(['userid' => $userid, 'ref_userid' => $response->data['id'], 'status' => "1"]);
        } catch (Throwable $error) {
            makeLog($error, 'addRelation');
            $response->success = false;
            $response->message = 'Không thể thêm mã giới thiệu.';
        }

        return $response;
    }
}
