<?php

namespace Modules\Profile\Http\Controllers;

use App\Models\User;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Hash;
use Modules\Profile\Http\Requests\ProfileUpdateRequest;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */

    public function index(Request $request)
    {
        
        return view('profile::form');
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('profile::form');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
        
        return redirect('profile');
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        return view('profile::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        return view('profile::form');
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(ProfileUpdateRequest $request, $id)
    {
        $user=User::find($id);
        if(Hash::check($request->old_password, $user->password))
        {
            if($request->npassword !=$request->kpassword)
            {
                return redirect('profile')->with('error','`Password Baru` tidak sama dengan `Konfirmasi Password Baru`');
            }
            else{
               $user->update(['password'=>Hash::make($request->npassword )] );

                return redirect('profile')->with('success','Password berhasil diubah');
            }
        }
        else
        {
            return redirect('profile')->with('error','`Password Lama` tidak sesuai');
        }
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        //

        return redirect('profile');
    }

    public function export(Request $request)
    {

        ini_set('memory_limit', -1);
        ini_set('max_execution_time', -1);
        
        //$filename ='profile';
        //if($request->type == 'xls')
        //{
        //    return (new \Modules\Profile\Exports\ProfileExport($request))
        //    ->download($filename . '.xlsx', \Maatwebsite\Excel\Excel::XLSX);
        //}
        //else{
        //    
        //}

        return redirect('profile')->with('success','Data Berhasil Diexport');
    }

}
