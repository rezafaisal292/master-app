<?php

namespace Modules\MasterRoles\Entities;

use Illuminate\Database\Eloquent\Model;


class MasterRolePermission extends Model
{
    
    protected $table = 'role_has_permissions';

    public function permission()
    {
        return $this->hasOne(MasterPermission::class,'id','permission_id');
    }

}
