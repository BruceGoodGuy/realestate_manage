<?php

namespace App\Http\Controllers;

use App\Http\Controllers\APIController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class PublicAPIController extends APIController
{
    //
    public function getProvinces()
    {
        $response = Http::get('https://api.ghsv.vn/v1/address/provinces');
        if ($response->ok()) {
            return $this->api_response($response->json('provinces'));
        }

        return $this->api_response([], $response->status(), false, 'Something went wrong');
    }

    public function getDistricts(Request $request, int $provincecode)
    {
        if (!$provincecode) {
            return $this->api_response([], 404, false, 'Data not found');
        }

        $response = Http::withBody('{"province_code": ' . $provincecode . '}')->get('https://api.ghsv.vn/v1/address/districts');
        if (!$response->ok() || !$response->json('success')) {
            return $this->api_response([], $response->status(), false, 'Something went wrong');
        }

        return $this->api_response($response->json('districts'));
    }

    public function getWards(Request $request, $districtcode)
    {
        if (!$districtcode) {
            return $this->api_response([], 404, false, 'Data not found');
        }

        $response = Http::withBody('{"district_code": ' . $districtcode . '}')->get('https://api.ghsv.vn/v1/address/wards');
        if (!$response->ok() || !$response->json('success')) {
            return $this->api_response([], $response->status(), false, 'Something went wrong');
        }

        return $this->api_response($response->json('wards'));
    }
}
