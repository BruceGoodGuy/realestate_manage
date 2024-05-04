<?php

namespace App\Http\Controllers;

use App\Http\Controllers\APIController;
use Illuminate\Http\Request;
use App\Services\Client;
use App\Interfaces\Client\ClientRepositoryInterface;

class ClientAPIController extends APIController
{
    private $_clientinterface;
    public function __construct(ClientRepositoryInterface $clientinterface)
    {
        $this->_clientinterface = $clientinterface;
    }
    //
    public function store(\App\Http\Requests\ClientCreateRequest $request)
    {
        $clientdata = $request->only(Client::getAllowedFields([], ['province', 'district', 'ward']));
        // Not allowed to add status.
        unset($clientdata['status']);
        $clientdata['created_from'] = config('constants.platform.mobile');
        $clientdata['created_by'] = config('constants.user.kind.guest');
        $response = $this->_clientinterface->storeClient($clientdata);
        return $this->api_response($response->data, $response->statuscode, $response->success, $response->message, $response->warning);
    }

    public function login(\App\Http\Requests\ClientLoginRequest $request)
    {
        $authendata = $request->only(['phone', 'password']);
        $data = $this->_clientinterface->authenticated($authendata);
        return $this->api_response($data->data, $data->statuscode, $data->success, $data->message);
    }

    public function index(Request $request)
    {
        $clientid = $request->user()->id;
        $data = $this->_clientinterface->getClient($clientid);
        return $this->api_response($data->data, $data->statuscode, $data->success);
    }

    /**
     * Update client.
     *
     * @param \App\Http\Requests\ClientUpdateRequest $request
     * 
     * @return [type]
     * 
     */
    public function update(\App\Http\Requests\ClientUpdateRequest $request)
    {
        $fields = Client::getAllowedFields(['password', 'status'], ['province', 'district', 'ward']);
        $clientdata = $request->only($fields);
        $clientdata['id'] = $request->user()->id;
        $client = $this->_clientinterface->updateClient($clientdata);

        return $this->api_response($client->data, $client->statuscode, $client->success, $client->message);
    }

    public function updatePassword(\App\Http\Requests\ClientUpdatePasswordRequest $request) {
        $password = $request->only(['new_password', 'password']);
        $response = $this->_clientinterface->updatePassword($password);

        return $this->api_response($response->data, $response->statuscode, $response->success, $response->message);
    }

    public function logout() {
        $this->_clientinterface->logout();
        return $this->api_response([], 201);
    }

    public function getRelations() {
        // return $this->_clientinterface->getRelations([]);
    }
}
