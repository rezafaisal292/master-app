<?php

namespace Modules\MasterRoles\Entities;


use Spatie\Permission\Models\Role;

class MasterRole extends Role
{
    
    public $guarded = [];

	protected 	$primaryKey = 'id';
    public $incrementing = false;
    public function scopefetch($query, $request, $export = false)
    {

        $q = $query->select();
        if($request->name)
            $q->where('name',$request->name);
              
        if ($export === false) {
            if ($request->has('per_page')) {
                return $request->per_page === 'All' ? $q->get() : $q->paginate($request->per_page);
            }

            return $q->orderBy('id','DESC')->paginate(10);
        }
        return $q->get();
    }
    public function scopeFindByName($query, string $value)
    {
        return $query->where('name', $value)->first();
    }

    public function rolePermissions()
    {
        return $this->hasMany(MasterRolePermission::class,'role_id','id');
    }
}
