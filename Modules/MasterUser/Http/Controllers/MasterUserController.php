<?php

namespace Modules\MasterUser\Http\Controllers;

use App\Models\User;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Spatie\Permission\Models\Role;
use DB;
use Hash;
use Illuminate\Support\Arr;

class MasterUserController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    function __construct()
    {
         $this->middleware('permission:masteruser.index', ['only' => ['index']]);
         $this->middleware('permission:masteruser.create', ['only' => ['create','store']]);
         $this->middleware('permission:masteruser.edit', ['only' => ['edit','update']]);
         $this->middleware('permission:masteruser.destroy', ['only' => ['destroy']]);
         $this->middleware('permission:masteruser.show', ['only' => ['show']]);
    }

    public function index(Request $request)
    {
        $data=User::fetch($request);
        return view('masteruser::index',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {

        $roles = Role::pluck('name','name')->all();
        $userRole=[];
        $d=new User;
        return view('masteruser::form',compact('d','roles','userRole'));
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
        $input = $request->all();
        $input['username'] = $input['name'];
        $input['password'] = Hash::make('12345678');
        $user = User::create($input);
        $user->assignRole($request->input('roles'));

    
    
        return redirect('masteruser') ->with('success','User created successfully');
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        return view('masteruser::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        $d = User::find($id);
        $roles = Role::pluck('name','name')->all();
        $userRole = $d->roles->pluck('name','name')->all();
        return view('masteruser::form',compact('d','roles','userRole'));
    }
    

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, $id)
    {
        $input = $request->all();
        if(!empty($input['password'])){ 
            $input['password'] = Hash::make($input['password']);
        }else{
            $input = Arr::except($input,array('password'));    
        }
    
        $user = User::find($id);
        $user->update($input);
        DB::table('model_has_roles')->where('model_id',$id)->delete();
    
        $user->assignRole($request->input('roles'));
    
        return redirect('masteruser')  ->with('success','User updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        User::find($id)->delete();
                       
        return redirect('masteruser') ->with('success','User deleted successfully');
    }
}
