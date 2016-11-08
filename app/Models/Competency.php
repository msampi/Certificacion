<?php

namespace App\Models;

use Eloquent as Model;

/**
 * Class Competition
 * @package App\Models
 */
class Competency extends BaseModel
{

    public $fillable = [
        'name',
        'post_id',
        'evaluation_id',
        'description',
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'name' => 'array',
        'description' => 'array',
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'name' => 'required'
    ];

    public function items()
    {
        return $this->hasMany('App\Models\CompetencyItem');
    }

    

}
