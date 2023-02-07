<?php

namespace Modules\Opsi\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Opsi\Entities\OptionGroup;

class OpsiController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    function __construct()
    {
         $this->middleware('permission:opsi.index', ['only' => ['index']]);
         $this->middleware('permission:opsi.create', ['only' => ['create','store']]);
         $this->middleware('permission:opsi.edit', ['only' => ['edit','update']]);
         $this->middleware('permission:opsi.destroy', ['only' => ['destroy']]);
         $this->middleware('permission:opsi.show', ['only' => ['show']]);
    }
    public function index(Request $request)
    {
        $data = OptionGroup::fetch($request);

        return view('opsi::index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {

        $d = new OptionGroup;
        return view('opsi::form',compact('d'));
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        return view('opsi::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit(OptionGroup $opsi)
    {
        $d=$opsi;
        return view('opsi::form',compact('d'));
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
        dd($id);
    }
}
