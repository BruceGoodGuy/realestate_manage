<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\View;
use Auth;

class APIController extends Controller
{
    public function api_response($data = [], $statuscode = 200, $issuccess = true, $message = 'ok', $warning = '')
    {
        return response(['success' => $issuccess, 'message' => $message, 'warning' => $warning, 'data' => $data, 'statuscode' => $statuscode], $statuscode);
    }
}
