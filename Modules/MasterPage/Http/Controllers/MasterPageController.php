<?php

namespace Modules\MasterPage\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\MasterPage\Entities\MasterPage;

class MasterPageController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    function __construct()
    {
         $this->middleware('permission:masterpage.index', ['only' => ['index']]);
         $this->middleware('permission:masterpage.create', ['only' => ['create','store']]);
         $this->middleware('permission:masterpage.edit', ['only' => ['edit','update']]);
         $this->middleware('permission:masterpage.destroy', ['only' => ['destroy']]);
         $this->middleware('permission:masterpage.show', ['only' => ['show']]);
    }
    public function index(Request $request)
    {
        $data=MasterPage::fetch($request);
        return view('masterpage::index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        $d = new MasterPage();

        $parent = to_dropdown(MasterPage::parent(), 'id', 'nama');
        return view('masterpage::form',compact('d','parent'));
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
        $values = $request->except(['_token', 'save']);

        $add = MasterPage::create($values);
        
        $message = ['key' => 'Master Page', 'value' => '`'.$values['nama'].'`'];
        $status = 'error';
        $response = trans('message.create_failed', $message);
        if ($add) 
        {
            $status = 'success';
            $response = trans('message.create_success', $message);
        }   
        if ($request->only('save'))
            return redirect()->route('masterpage.create')->with($status, $response);      
            
        return redirect('masterpage')->with($status, $response);
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {

        return redirect('masterpage')->with('success','show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit(MasterPage $masterpage)
    {
        $d = $masterpage;
        return view('masterpage::form',compact('d'));
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
       return  redirect('masterpage')->with('success','Data berhasil dihapus');
    }
}
