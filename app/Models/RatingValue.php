<?php

namespace App\Models;

use Eloquent as Model;

/**
 * Class Value
 * @package App\Models
 */
class RatingValue extends BaseModel
{


    public $fillable = [
        'value',
        'rating_id'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'value' => 'array',
        'rating_id' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'value' => 'required'
    ];
}
