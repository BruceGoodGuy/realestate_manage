<?php

namespace App\Services;

use Illuminate\Support\Str;
use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Models\Client as ClientModel;
use stdClass;

class Client
{
    public static function getAllowedFields(array $excludefields = [], array $extrafields = [])
    {
        $fields = [
            'lastname', 'firstname', 'phone', 'password', 'email',
            'birthday', 'address', 'province_value', 'district_value', 'ward_value', 'referral_code', 'note', 'status'
        ];

        if (!empty($excludefields)) {
            $fields = array_diff($fields, $excludefields);
        }

        return [
            ...$fields,
            ...$extrafields
        ];
    }


    public static function checkReferralCode(string $referralcode, array $extrafields = [], int $userid = -1): stdClass
    {
        $response = (object) ['success' => false, 'message' => '', 'data' => null, 'statuscode' => 200];
        if (empty($referralcode)) {
            $response->success = true; // NOTE - No need to show warning.
            return $response;
        }

        $fields = ['id', 'status'];

        if (!empty($extrafields)) {
            $fields = [...$fields, ...$extrafields];
        }

        try {
            $referraldata = ClientModel::select($fields)
                ->where([
                    ['referral_code', '=', $referralcode],
                    ['id', '<>', $userid],
                ])
                ->firstOrFail();
        } catch (ModelNotFoundException $error) {
            $response->statuscode = 404;
            $response->message = 'Mã giới thiệu không tồn tại.';
            return $response;
        }

        if ((int) $referraldata->status !== config('constants.user.status.active')) {
            $response->message = 'Mã giới thiệu không hợp lệ.';
            return $response;
        }

        // Everything is ok.
        $response->success = true;
        $response->data = $referraldata->toArray();

        return $response;
    }
}
