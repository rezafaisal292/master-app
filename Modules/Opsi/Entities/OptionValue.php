<?php

namespace Modules\Opsi\Entities;
use Illuminate\Database\Eloquent\Model;

class OptionValue extends Model
{
    /**
     * @var string
     */
    protected $table = 'master_option_value';

    /**
     * @var array
     */
    protected $fillable = [
        'option_group_id', 'key', 'value', 'sequence',
    ];

    /**
     * @var array
     */
    protected $hidden = [
        'id',
    ];
    public $incrementing = false;
}