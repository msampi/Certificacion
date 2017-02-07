<?php

namespace App\Models;

use Eloquent as Model;

/**
 * Class Behaviour
 * @package App\Models
 */
class AutoperceptionItem extends BaseModel
{

    public $fillable = [
        'description',
        'autoperception_id'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'description' => 'text',
        'autoperception_id' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [

    ];

    

}
