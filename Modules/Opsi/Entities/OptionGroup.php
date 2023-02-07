<?php

namespace Modules\Opsi\Entities;

use Illuminate\Database\Eloquent\Model;

class OptionGroup extends Model
{
    /**
     * @var string
     */
    protected $table = 'master_option_group';

    /**
     * @var array
     */
    protected $fillable = [
        'name','created_at','updated_at'
    ];

    /**
     * @var array
     */
    protected $hidden = [
        'id',
    ];

    public $incrementing = false;
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function optionValues()
    {
        return $this->hasMany(OptionValue::class)->orderBy('key');
    }

    /**
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function scopeFetch($query, $request)
    {
        if ($request->name) {
            $query->where('name', 'like', '%' . $request->name . '%');
        }

        $q = $query->select(array_merge($this->fillable, ['id']))
            ->orderBy('name');
        if ($request->has('per_page')) {
            return $request->per_page === 'All' ? $q->get() : $q->paginate($request->per_page);
        }

        return $q->Paginate(10);
    }
}