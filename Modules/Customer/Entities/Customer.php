<?php

namespace Modules\Customer\Entities;

use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class Customer extends Model
{
    
    use Uuids, LogsActivity;  
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected static $logFillable = true;
    protected static $logUnguarded = true;

    protected $table = 'app_customer';
	protected $primaryKey = 'id';
    protected $keyType = 'string';
    protected $hidden = [];
    public $timestamps = true;
    protected $fillable = [
        'id',
        'nama',
        'status',
        'created_at',
        'updated_at',
    ];
    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()->logOnly(['nama', 'status'])->useLogName('customer');
    }
  
    
    public function scopefetch($query, $request, $export = false)
    {

        if($request->nama)
        $query->where('nama','ilike','%'.$request->nama.'%');

        if($request->status)
        $query->where('status',$request->status);

        $q = $query->select()->orderby('updated_at');
                 
        
        if ($export === false) {
            if ($request->has('per_page')) {
                return $request->per_page === 'All' ? $q->get() : $q->paginate($request->per_page);
            }

            return $q->paginate(10);
        }
        return $q->get();
    }
    
}
