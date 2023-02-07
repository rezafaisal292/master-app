<?php

namespace Modules\MasterCabang\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB as FacadesDB;

class MasterCabang extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */

    protected $table = 'app_master_cabang';

	protected $primaryKey = 'kodecabang';

    protected $keyType = 'string';

    protected $hidden = [];
    // public $incrementing = false;
    protected $fillable = [
        'kodecabang',
        'namacabang',
        'kodeinduk',
        'kodekanwil',
        'status'
    ];

    // /**
    //  * The attributes that should be hidden for serialization.
    //  *
    //  * @var array<int, string>
    //  */
    // protected $hidden = [
    //     'password',
    //     'remember_token',
    // ];

    // /**
    //  * The attributes that should be cast.
    //  *
    //  * @var array<string, string>
    //  */
    // protected $casts = [
    //     'email_verified_at' => 'datetime',
    // ];

    public function scopefetch($query, $request, $export = false)
    {

        if($request->kodecabang)
        $query->where('kodecabang','ilike','%'.$request->kodecabang.'%');

        if($request->namacabang)
        $query->where('namacabang','ilike','%'.$request->namacabang.'%');

        if($request->kodeinduk)
        $query->where('kodeinduk',$request->kodeinduk);

        if($request->kodekanwil)
        $query->where('kodekanwil',$request->kodekanwil);

        $q = $query->select()->orderby('kodekanwil')->orderby('kodecabang');
                 
        
        if ($export === false) {
            if ($request->has('per_page')) {
                return $request->per_page === 'All' ? $q->get() : $q->paginate($request->per_page);
            }

            return $q->paginate(10);
        }
        return $q->get();
    }

    public function scopeFindByName($query, string $value)
    {
        return $query->where('name', $value)->first();
    }

    public function scopeListInduk($query)
    {
        return $query->select('kodecabang',FacadesDB::raw("kodecabang || '-' ||namacabang as nama"))->wherecolumn('kodecabang','kodeinduk')->where('kodecabang','not like','K%')->orderby('nama');
 
    }
    public function scopeListKanwil($query)
    {
        return $query->select('kodecabang',FacadesDB::raw("namacabang as nama"))->wherecolumn('kodecabang','kodekanwil')->orderby('nama');
 
    }
    public function scopeListCabangKanwil($query)
    {
        return $query->select('kodecabang','namacabang','kodekanwil')->wherecolumn('kodecabang','kodeinduk')->where('kodecabang','not like','K%')->orderby('kodekanwil')->orderby('kodecabang');
 
    }

    public function induk()
    {
        return $this->hasOne(MasterCabang::class, 'kodecabang', 'kodeinduk');
    }
    public function wilayah()
    {
        return $this->hasOne(MasterCabang::class, 'kodecabang', 'kodekanwil');
    }
    
}
