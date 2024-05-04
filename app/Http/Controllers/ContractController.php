<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Interfaces\Contract\ContractRepositoryInterface;

class ContractController extends Controller
{
    private $_contractinterface;
    public function __construct(ContractRepositoryInterface $contractinterface)
    {
        $this->_contractinterface = $contractinterface;
    }
    //
    public function index()
    {
        $data = $this->_contractinterface->getContracts();
        if ($data->success) {
            return view('contract.index', ['contracts' => $data->data]);
        }

        return view('contract.index', ['contracts' => [], 'generalerrors' => $data->message]);
    }
    public function add()
    {
        $data = $this->_contractinterface->getInitData();
        return view('contract.add', $data->data);
    }
    public function store(\App\Http\Requests\Contract $request)
    {
        $data = $request->only([
            'name',
            'client_id_value',
            'property_id',
            'price',
            'note',
            'status',
            'active_date',
        ]);
        $response = $this->_contractinterface->storeContract($data);
        if ($response->success) {
            return redirect()->route('contract.index')->with([
                'message' => $response->message, 'warning' => $response->warning,
                'contractid' => $response->data['id']
            ]);
        }

        return redirect()->back()->withInput()->withErrors(['general_errors' => $response->message, ...$response->data]);
    }
    public function confirmTransaction(Request $request, $contractid)
    {
        $response = $this->_contractinterface->confirmTransaction($contractid, $request->submit === 'ok');
        if ($response->success) {
            return redirect()->back()->with([
                'message' => $response->message, 'warning' => $response->warning,
            ]);
        }
        return redirect()->back()->withInput()->withErrors(['general_errors' => $response->message]);
    }
    public function edit()
    {
        return 'ok';
    }
    public function update()
    {
        return 'ok';
    }
    public function delete($id)
    {
        $this->_contractinterface->deleteContract($id);
        return redirect()->route('contract.index')->with([
            'message' => 'Xóa hợp đồng thành công.',
        ]);
    }
    public function view($contractid)
    {
        $response = $this->_contractinterface->getContract($contractid);

        if ($response->success) {
            return view('contract.view', ['contract' => $response->data]);
        }

        return redirect()->back()->withInput()->withErrors(['general_errors' => $response->message]);
    }
}
