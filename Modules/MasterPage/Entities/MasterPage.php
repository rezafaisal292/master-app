<?php

namespace Modules\MasterPage\Entities;

use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class MasterPage extends Model
{
    use Uuids;
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'master_page';

	protected $primaryKey = 'id';
    protected $keyType = 'string';
    protected $fillable = [
        'nama',
        'url',
        'icon',
        'parent',
        'urutan',
        'status'
    ];
    public $incrementing = false;

    public function scopefetch($query, $request, $export = false)
    {

        $q = $query->select()->where('parent',null)->orderBy('urutan','asc');
                 
        if ($export === false) {
            if ($request->has('per_page')) {
                return $request->per_page === 'All' ? $q->get() : $q->paginate($request->per_page);
            }

            return $q->paginate(10);
        }
        return $q->get();
    }
    public function scopeUsePage($query)
    {
        return $query->where('status', '1')->where('url','!=','#')->get();
    }
    
    public function scopeParent($query)
    {
        return $query->where('status', '1')->where('url','=','#')->get();
    }

   


    public function scopeFindByName($query, string $value)
    {
        return $query->where('nama', $value)->first();
    }


    public function parentPage()
    {
        return $this->hasOne(MasterPage::class, 'id', 'parent');
    }
    public function childPage()
    {
        return $this->hasMany(MasterPage::class, 'parent', 'id')->orderby('urutan','asc');
    }
}