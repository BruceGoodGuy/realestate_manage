<?php

namespace App\Http\Controllers;

use App\Http\Controllers\APIController;
use Illuminate\Http\Request;
use App\Services\Client;
use Illuminate\Support\Facades\Storage;

class AjaxController extends APIController
{
    /**
     * Check referral.
     *
     * @return [type]
     * 
     */
    public function checkReferral(Request $request)
    {
        if (!$request->has('code')) {
            return $this->api_response([], 404, false, 'Data not found');
        }
        $response = Client::checkReferralCode($request->code, ['firstname', 'lastname'], $request->id ?? -1);
        $data = [];
        if ($response->success) {
            $data['firstname'] = $response->data['firstname'];
            $data['lastname'] = $response->data['lastname'];
        }

        return $this->api_response($data, $response->statuscode, $response->success, $response->message);
    }

    public function draftUpload(\App\Http\Requests\UploadFileRequest $request)
    {
        $path = Storage::disk('public')->put('draft/images', $request->file('file'));
        return response(['location' => asset('storage/' . $path), 'path' => $path]);
    }

    public function deleteDraftFile(Request $request)
    {

        if (!$request->has('path') || strpos($request->path, "draft/images/") !== 0) {
            return "not ok";
        }
        Storage::disk('public')->delete($request->path);
        return "ok";
    }

    public function getDraftFile(Request $request)
    {
        if (!$request->has('path') || strpos($request->path, "draft/images/") !== 0 || !Storage::disk('public')->exists($request->path)) {
            return $this->api_response([], 404, false);
        }

        return $this->api_response(Storage::disk('public')->get($request->path), 200, false);
    }
}
