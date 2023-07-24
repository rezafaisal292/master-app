<?php

namespace Modules\Kategori\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class KategoriController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */

    function __construct()
    {
         $this->middleware('permission:kategori.index', ['only' => ['index']]);
         $this->middleware('permission:kategori.create', ['only' => ['create','store']]);
         $this->middleware('permission:kategori.edit', ['only' => ['edit','update']]);
         $this->middleware('permission:kategori.destroy', ['only' => ['destroy']]);
         $this->middleware('permission:kategori.show', ['only' => ['show']]);
    }

    public function index(Request $request)
    {

        $data = Kategori::fetch($request);

        return view('kategori::index',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        $d= new Kategori();
        return view('kategori::form',compact('d'));
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(KategoriStoreUpdateRequest $request)
    {
        $values = $request->except(['_token', 'save']);

        $add = Kategori::create($values);
        
        $message = ['key' => 'Kategori', 'value' => '``'];
        $status = 'error';
        $response = trans('message.create_failed', $message);
        if ($add) 
        {
            $status = 'success';
            $response = trans('message.create_success', $message);
        }   
        if ($request->only('save'))
            return redirect()->route('kategori.create')->with($status, $response);      
            
        return redirect('kategori')->with($status, $response);
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        return view('kategori::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit(Kategori $kategori)
    {
        $d=$kategori;
        return view('kategori::form',compact('d'));
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(KategoriStoreUpdateRequest $request, Kategori $kategori)
    {
        $values = $request->except(['_token', '_method']);

        foreach ($values as $key => $value) {
           $kategori->$key = $value;
        }

        $message = ['key' => 'Kategori', 'value' => ''];
        $status = 'error';
        $response = trans('message.update_failed', $message);

        if ($kategori->save()) {
            $status = 'success';
            $response = trans('message.update_success', $message);
        }

        if ($request->ajax()) {
            return response()->json(['message' => $response, 'status' => $status]);
        }

        return redirect('kategori')->with($status, $response);
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy(Request $request,Kategori $kategori)
    {
        $message = ['key' => 'Kategori', 'value' => ''];
        $status = 'error';
        $response = trans('message.delete_failed', $message);
        if ($kategori->delete()) {    
            $status = 'success';
            $response = trans('message.delete_success', $message);
        }

        if ($request->ajax()) {
            return response()->json(['message' => $response, 'status' => $status]);
        }


        return redirect('kategori')->with($status, $response);
    }

    public function export(Request $request)
    {

        ini_set('memory_limit', -1);
        ini_set('max_execution_time', -1);
        
        //$filename ='kategori';
        //if($request->type == 'xls')
        //{
        //    return (new \Modules\Kategori\Exports\KategoriExport($request))
        //    ->download($filename . '.xlsx', \Maatwebsite\Excel\Excel::XLSX);
        //}
        //else{
        //    
        //}

        return redirect('kategori')->with('success','Data Berhasil Diexport');
    }

}
