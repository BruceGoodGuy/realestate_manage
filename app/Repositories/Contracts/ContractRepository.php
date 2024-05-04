<?php

namespace App\Repositories\Contracts;

use App\Repositories\EloquentRepository;
use App\Interfaces\Contract\ContractRepositoryInterface;
use Illuminate\Contracts\Cache\Store;
use Illuminate\Support\Facades\Storage;
use App\Models\Client;
use App\Models\Property;
use App\Models\Setting;
use stdClass;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Throwable;
use App\Models\Transaction;
use App\Models\Wallet;

class ContractRepository extends EloquentRepository implements ContractRepositoryInterface
{
    /**
     * get model
     * @return string
     */
    public function getModel()
    {
        return \App\Models\Contract::class;
    }

    public function getInitData(): stdClass
    {
        $response = (object) ['success' => true, 'statuscode' => 200, 'message' => 'ok', 'warning' => '', 'data' => []];
        try {
            $properties = Property::select(['properties.id as pid', 'contracts.id', 'contracts.status', 'properties.name', 'properties.province', 'properties.price'])
                ->leftjoin('contracts', 'properties.id', 'contracts.property_id')
                ->where('properties.status', 1)
                ->get();
            $invalidid = [];
            $properties = $properties->filter(function ($value, $key) use (&$invalidid) {
                if (($value->status !== 'done' && $value->status !== 'ready' && !in_array($value->pid, $invalidid))) {
                    return true;
                } else {
                    $invalidid[] = $value->pid;
                    return false;
                }
            })->filter(function ($value) use ($invalidid) {
                return !in_array($value->pid, $invalidid);
            })->unique('name');
            $properties = $properties->groupBy('province');
            $clients = Client::select(['firstname', 'lastname', 'phone', 'id'])->where('status', '1')->get();
            $setting = Setting::where('name', 'ratio')->select(['values'])->first();

            $response->data = [
                'properties' => $properties,
                'clients' => $clients,
                'setting' => $setting,
            ];
        } catch (Throwable $error) {
            makeLog($error, 'getInitData');
            $response->success = false;
            $response->statuscode = 500;
            $response->message = 'Lỗi không xác định.';
        }

        return $response;
    }

    public function storeContract(array $data): stdClass
    {
        $response = (object) ['success' => true, 'statuscode' => 200, 'message' => 'Đã thêm hợp đồng thành công', 'warning' => '', 'data' => []];
        $data = $this->setUpdata($data);
        $client = Client::where([
            [
                'id', '=', $data['client_id'],
            ],
            [
                'status', '=', '1',
            ]
        ])->count();
        $errors = [];
        if ($client === 0) {
            $errors['client_id_value'] = 'Không tồn tại.';
        }

        $property = Property::where([
            [
                'id', '=', $data['property_id'],
            ],
            [
                'status', '=', '1',
            ]
        ])->count();
        if ($property === 0) {
            $errors['property_id_value'] = 'Không tồn tại.';
        }

        if (!empty($errors)) {
            $response->success = false;
            $response->statuscode = 422;
            $response->message = 'Có lỗi xảy ra';
            $response->data = $errors;
            return $response;
        }

        try {
            $setting = Setting::whereIn('name', ['ratio', 'earn1', 'earn2', 'earn3', 'earn4', 'earn5'])
                ->where('values', '!=', 0)
                ->select(['name', 'values'])->get();
            $ratioearn = 0;
            if ($setting[0]->name === 'ratio') {
                $ratioearn = $setting[0]->values;
                unset($setting[0]);
            }
            $data['earn_price'] = $ratioearn * $data['price'];
            $contract = $this->_model->create($data);
        } catch (Throwable $error) {
            makeLog($error, 'storeContract');
            $response->success = false;
            $response->statuscode = 500;
            $response->message = 'Lỗi không xác định.';
            return $response;
        }

        try {
            $this->makeTransaction($contract, $setting);
        } catch (Throwable $error) {
            makeLog($error, 'makeTransaction');
            $response->warning = 'Không thể tạo giao dịch';
        }

        $response->data['id'] = $contract->id;

        return $response;
    }

    public function getContracts(): stdClass
    {
        $response = (object) ['success' => true, 'statuscode' => 200, 'message' => 'Lấy danh sách hợp đồng thành công', 'warning' => '', 'data' => []];
        try {
            $contracts = $this->_model->select(['contracts.id', 'contracts.active_date', 'contracts.name', 'contracts.price', 'clients.firstname', 'clients.lastname', 'contracts.status', 'properties.name as pname'])
                ->join('clients', 'clients.id', 'contracts.client_id')
                ->join('properties', 'properties.id', 'contracts.property_id')
                ->orderBy('active_date', 'DESC')
                ->get();
        } catch (Throwable $error) {
            makeLog($error, 'getContracts');
            $response->success = false;
            $response->statuscode = 500;
            $response->message = 'Lỗi không xác định.';
        }
        $response->data = $contracts;
        return $response;
    }

    public function getContract(int $contractid): stdClass
    {
        $response = (object) ['success' => true, 'statuscode' => 200, 'message' => 'Cập nhật khách hàng thành công.', 'warning' => '', 'data' => []];
        try {
            $contract = $this->_model->where('id', $contractid)->with(['transactions.client', 'client', 'property'])->firstOrFail();
            $response->data = $contract;
        } catch (ModelNotFoundException $error) {
            $response->success = false;
            $response->statuscode = 404;
            $response->message = 'Không thể tìm thấy hợp đồng.';
        }

        return $response;
    }

    public function confirmTransaction(int $contractid, bool $isaccept): stdClass
    {
        $response = (object) ['success' => true, 'statuscode' => 200, 'message' => 'Cập nhật khách hàng thành công.', 'warning' => '', 'data' => []];
        try {
            $contract = $this->_model->where('id', $contractid)->firstOrFail();
            $contract->status = 'done';
            $contract->save();
            $time = now();
            $transactiondata = Transaction::where('contract_id', $contractid)->get();
            foreach ($transactiondata as $key => $transaction) {
                $data = ['status' => $isaccept ? 'approval' : 'reject', 'approve_date' => $time];
                $transaction->update($data);
                if ($isaccept) {
                    $wallet = Wallet::where('client_id', $transaction->to)->first();
                    if (is_null($wallet)) {
                        Wallet::create(['client_id' => $transaction->to, 'point' => $transaction->amount, 'dinamond' => 0, 'status' => 1]);
                    } else {
                        $wallet->point += $transaction->amount;
                        $wallet->save();
                    }
                }
            }
            $response->message = $isaccept ? 'Đã xác nhận giao dịch' : 'Đã hủy giao dịch';
        } catch (ModelNotFoundException $error) {
            $response->success = false;
            $response->statuscode = 404;
            $response->message = 'Không thể tìm thấy hợp đồng.';
        }

        return $response;
    }

    public function updateContract(array $data): stdClass
    {
        $response = (object) ['success' => true, 'statuscode' => 200, 'message' => 'Cập nhật khách hàng thành công.', 'warning' => '', 'data' => []];
        return $response;
    }
    public function deleteContract(int $contractid): stdClass
    {
        $time = now();
        $response = (object) ['success' => true, 'statuscode' => 200, 'message' => 'Xóa hợp đồng thành công.', 'warning' => '', 'data' => []];
        $contract = $this->_model::where([['id', '=', $contractid], ['status', '!=', 'done']])->first();
        if ($contract) {
            $transactiondata = Transaction::where('contract_id', $contract->id)->get();
            foreach ($transactiondata as $key => $transaction) {
                $data = ['status' => 'reject', 'approve_date' => $time];
                $transaction->update($data);
            }
            $contract->status = 'cancel';
            $contract->save();
        }
        return $response;
    }

    private function setUpdata(array $data): array
    {
        if (isset($data['client_id_value'])) {
            $data['client_id'] = $data['client_id_value'];
        }
        if (isset($data['property_id_value'])) {
            $data['property_id'] = $data['property_id_value'];
        }
        if (is_null($data['active_date'])) {
            $data['active_date'] = now();
        }
        $data['status'] = 'ready';

        unset($data['client_id_value'], $data['property_id_value']);
        return $data;
    }

    private function makeTransaction($contract, $setting)
    {
        $clientid = $contract->client_id;
        $amount = $contract->earn_price;
        $contractid = $contract->id;
        $transactiondata = [
            [
                'type' => 'commission',
                'message' => 'Tiền hoa hồng sau khi mua bất động sản.',
                'from' => auth()->user()->id,
                'to' => (int) $clientid,
                'amount' => $amount,
                'status' => 'watingforapproval',
                'contract_id' => $contractid,
            ]
        ];

        $parent = null;
        $lastlevel = 0;

        $setting->each(function ($data, $key) use ($clientid, $parent, $lastlevel, $amount, $contractid, &$transactiondata) {
            $level = (int) preg_replace("/[^0-9]/", "", $data->name);
            if (is_null($parent)) {
                $lastlevel = $level;
                $parent = $this->findParentByLevel($level, $clientid);
            } else {
                $level = $level - $lastlevel;
                $parent = $this->findParentByLevel($level, $parent->id);
            }

            if ($parent === false) {
                return;
            }

            $transactiondata[] =
                [
                    'type' => 'commission',
                    'message' => 'Tiền hoa hồng sau khi mua bất động sản.',
                    'from' => auth()->user()->id,
                    'to' => $parent,
                    'amount' => $amount * $data->values,
                    'status' => 'watingforapproval',
                    'contract_id' => $contractid,
                ];
        });
        Transaction::insert($transactiondata);
    }

    private function findParentByLevel($level, $userid)
    {
        $level--;
        $parent = Client::join('referrals', 'referrals.userid', 'clients.id')
            ->where('clients.id', $userid)
            ->select(['referrals.ref_userid as id'])
            ->first();

        if (is_null($parent)) {
            return false;
        }

        if ($level < 1) {
            return $parent->id;
        }

        return $this->findParentByLevel($level, $parent->id);
    }
}
