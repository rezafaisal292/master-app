<?php

namespace Modules\Customer\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Customer\Entities\Customer;
use Modules\Customer\Http\Requests\CustomerStoreUpdateRequest;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */

    function __construct()
    {
         $this->middleware('permission:customer.index', ['only' => ['index']]);
         $this->middleware('permission:customer.create', ['only' => ['create','store']]);
         $this->middleware('permission:customer.edit', ['only' => ['edit','update']]);
         $this->middleware('permission:customer.destroy', ['only' => ['destroy']]);
         $this->middleware('permission:customer.show', ['only' => ['show']]);
    }

    public function index(Request $request)
    {

        $data = Customer::fetch($request);

        return view('customer::index',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        $d= new Customer();
        return view('customer::form',compact('d'));
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(CustomerStoreUpdateRequest $request)
    {
        $values = $request->except(['_token', 'save']);

        $add = Customer::create($values);
        
        $message = ['key' => 'Customer', 'value' => '`'.$values['nama'].'`'];
        $status = 'error';
        $response = trans('message.create_failed', $message);
        if ($add) 
        {
            $status = 'success';
            $response = trans('message.create_success', $message);
        }   
        if ($request->only('save'))
            return redirect()->route('customer.create')->with($status, $response);      
            
        return redirect('customer')->with($status, $response);
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        return view('customer::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit(Customer $customer)
    { 
        $d=$customer;
        return view('customer::form',compact('d'));
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(CustomerStoreUpdateRequest $request, Customer $customer)
    {
        $values = $request->except(['_token', '_method']);

        foreach ($values as $key => $value) {
           $customer->$key = $value;
        }

        $message = ['key' => 'Customer', 'value' => ''];
        $status = 'error';
        $response = trans('message.update_failed', $message);

        if ($customer->save()) {
            $status = 'success';
            $response = trans('message.update_success', $message);
        }

        if ($request->ajax()) {
            return response()->json(['message' => $response, 'status' => $status]);
        }

        return redirect('customer')->with($status, $response);
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy(Request $request,Customer $customer)
    {
        $message = ['key' => 'Customer', 'value' => ''];
        $status = 'error';
        $response = trans('message.delete_failed', $message);
        // if ($customer->delete()) {    
        //     $status = 'success';
        //     $response = trans('message.delete_success', $message);
        // }
        if ($customer->update(['status'=>'2'])) {    
            $status = 'success';
            $response = trans('message.delete_success', $message);
        }
        if ($request->ajax()) {
            return response()->json(['message' => $response, 'status' => $status]);
        }


        return redirect('customer')->with($status, $response);
    }

    public function export(Request $request)
    {

        ini_set('memory_limit', -1);
        ini_set('max_execution_time', -1);
        
        //$filename ='customer';
        //if($request->type == 'xls')
        //{
        //    return (new \Modules\Customer\Exports\CustomerExport($request))
        //    ->download($filename . '.xlsx', \Maatwebsite\Excel\Excel::XLSX);
        //}
        //else{
        //    
        //}

        return redirect('customer')->with('success','Data Berhasil Diexport');
    }

}
