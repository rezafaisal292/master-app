<?php

namespace Modules\MasterRoles\Entities;


use Spatie\Permission\Models\Permission;

class MasterPermission extends Permission
{

    public $guarded = [];
	protected 	$primaryKey = 'id';

    public $incrementing = false;
    public function scopeFindById($query, string $value)
    {
        return $query->where('id', $value)->first();
    }
}
