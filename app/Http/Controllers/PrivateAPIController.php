<?php

namespace App\Http\Controllers;

use App\Http\Controllers\APIController;
use Illuminate\Http\Request;

class PrivateAPIController extends APIController
{
    /**
     * Check referral.
     *
     * @return [type]
     * 
     */
    public function checkReferral(Request $request) {

        return $this->api_response([]);
    }
}
