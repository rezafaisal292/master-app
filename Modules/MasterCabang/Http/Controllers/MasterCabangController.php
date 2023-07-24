<?php

namespace Modules\MasterCabang\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\MasterCabang\Http\Requests\MasterCabangStoreUpdateRequest;
use Modules\MasterCabang\Entities\MasterCabang;

class MasterCabangController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */

    function __construct()
    {
         $this->middleware('permission:mastercabang.index', ['only' => ['index']]);
         $this->middleware('permission:mastercabang.create', ['only' => ['create','store']]);
         $this->middleware('permission:mastercabang.edit', ['only' => ['edit','update']]);
         $this->middleware('permission:mastercabang.destroy', ['only' => ['destroy']]);
         $this->middleware('permission:mastercabang.show', ['only' => ['show']]);
    }

    public function index(Request $request)
    {
        $data = MasterCabang::fetch($request);
        $listInduk = to_dropdown(MasterCabang::ListInduk()->get(),'kodecabang','nama');
        $listKanwil=to_dropdown(MasterCabang::ListKanwil()->get(),'kodecabang','nama');

        return view('mastercabang::index',compact('data','listInduk','listKanwil'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        $d= new MasterCabang();
        $listInduk = to_dropdown(MasterCabang::ListInduk()->get(),'kodecabang','nama');
        $listKanwil=to_dropdown(MasterCabang::ListKanwil()->get(),'kodecabang','nama');

        return view('mastercabang::form',compact('d','listInduk','listKanwil'));
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(MasterCabangStoreUpdateRequest $request)
    {
        $values = $request->except(['_token', 'save']);

        $add = MasterCabang::create($values);
        
        $message = ['key' => 'Master Cabang', 'value' => '`'.$values['kodecabang'].'-'.$values['kodecabang'].'`'];
        $status = 'error';
        $response = trans('message.create_failed', $message);
        if ($add) 
        {
            $status = 'success';
            $response = trans('message.create_success', $message);
        }   
        if ($request->only('save'))
            return redirect()->route('mastercabang.create')->with($status, $response);      
            
        return redirect('mastercabang')->with($status, $response);
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        return view('mastercabang::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit(MasterCabang $mastercabang)
    {
        $d=$mastercabang;

        $listInduk = to_dropdown(MasterCabang::ListInduk()->get(),'kodecabang','nama');
        $listKanwil=to_dropdown(MasterCabang::ListKanwil()->get(),'kodecabang','nama');
        return view('mastercabang::form',compact('d','listInduk','listKanwil'));
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(MasterCabangStoreUpdateRequest $request, MasterCabang $mastercabang)
    {
        $values = $request->except(['_token', '_method']);

        foreach ($values as $key => $value) {
            $mastercabang->$key = $value;
        }

        $message = ['key' => 'Master Cabang', 'value' => '`'.$mastercabang->kodecabang.'-'.$mastercabang->namacabang.'`'];
        $status = 'error';
        $response = trans('message.update_failed', $message);

        if ($mastercabang->save()) {
            $status = 'success';
            $response = trans('message.update_success', $message);
        }

        if ($request->ajax()) {
            return response()->json(['message' => $response, 'status' => $status]);
        }

        return redirect('mastercabang')->with($status, $response);
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy(Request $request,MasterCabang $mastercabang)
    {
        // dd('s');
        $message = ['key' => 'Master Cabang', 'value' => '`'.$mastercabang->kodecabang.'-'.$mastercabang->namacabang.'`'];
        $status = 'error';
        $response = trans('message.delete_failed', $message);
        if ($mastercabang->update(['status'=>'2'])) {    
            $status = 'success';
            $response = trans('message.delete_success', $message);
        }

        if ($request->ajax()) {
            return response()->json(['message' => $response, 'status' => $status]);
        }


        return redirect('mastercabang')->with($status, $response);
    }

    public function export(Request $request)
    {

        ini_set('memory_limit', -1);
        ini_set('max_execution_time', -1);
        
        $filename ='mastercabang';
        if($request->type == 'xls')
        {
           return (new \Modules\MasterCabang\Exports\MasterCabangExport($request))
           ->download($filename . '.xlsx', \Maatwebsite\Excel\Excel::XLSX);
        }
        else{
           
        }

        return redirect('mastercabang')->with('success','Data Berhasil Diexport');
    }

}
