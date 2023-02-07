<?php

namespace Modules\MasterRoles\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Modules\MasterRoles\Entities\MasterRole;
use Modules\MasterRoles\Entities\MasterPermission;
use DB;
use Modules\MasterPage\Entities\MasterPage;

class MasterRolesController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    function __construct()
    {
         $this->middleware('permission:masterroles.index', ['only' => ['index']]);
         $this->middleware('permission:masterroles.create', ['only' => ['create','store']]);
         $this->middleware('permission:masterroles.edit', ['only' => ['edit','update']]);
         $this->middleware('permission:masterroles.destroy', ['only' => ['destroy']]);
         $this->middleware('permission:masterroles.show', ['only' => ['show']]);
    }
    public function index(Request $request)
    {
        $roles = MasterRole::fetch($request);
        
        $page = MasterPage::where('url','!=','#')->get();
        return view('masterroles::index',compact('roles','page'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        $permission = Permission::get();
        $rolePermissions =[];
        $role = new Role;

        $page = MasterPage::where('url','!=','#')->get();

        return view('masterroles::form',compact('permission','role','rolePermissions','page'));
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
        // $this->validate($request, [
        //     'name' => 'required|unique:roles,name',
        //     'permission' => 'required',
        // ]);
    
        $role = Role::create(['name' => $request->input('name')]);
 
        $role->syncPermissions($request->input('permission'));

        return redirect('masterroles') ->with('success','Role created successfully');
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        // $role = Role::find($id);
        // $rolePermissions = Permission::join("role_has_permissions","role_has_permissions.permission_id","=","permissions.id")
        //     ->where("role_has_permissions.role_id",$id)
        //     ->get();
    
        // return view('roles.show',compact('role','rolePermissions'));
        // return view('masterroles::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        $role = Role::find($id);
        $permission = Permission::get();
        $rolePermissions = DB::table("role_has_permissions")->where("role_has_permissions.role_id",$id)
            ->pluck('role_has_permissions.permission_id','role_has_permissions.permission_id')
            ->all();

        $page = MasterPage::where('url','!=','#')->get();
    
        return view('masterroles::form',compact('role','permission','rolePermissions','page'));
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, $id)
    {
        // $this->validate($request, [
        //     'name' => 'required',
        //     'permission' => 'required',
        // ]);
    
        $role = Role::find($id);
        $role->name = $request->input('name');
        $role->save();
        $role->syncPermissions($request->input('permission'));
        return redirect('masterroles') ->with('success','Role updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        DB::table("roles")->where('id',$id)->delete();
        return redirect('masterroles') ->with('success','Role deleted successfully');
    }
}
