<?php

namespace App\Models;

use Eloquent as Model;

/**
 * Class Competition
 * @package App\Models
 */
class QuestionaryType extends BaseModel
{

    public $fillable = [
        'name'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'name' => 'string',
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'name' => 'required'
    ];

    

}
