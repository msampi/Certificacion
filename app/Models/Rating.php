<?php

namespace App\Models;

use Eloquent as Model;

/**
 * Class Rating
 * @package App\Models
 */
class Rating extends BaseModel
{

    public $table = 'ratings';
    


    public $fillable = [
        'name'
        
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'name' => 'string'
        
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'name' => 'required'
    ];

    public function values(){
        return $this->hasMany('App\Models\Value');
    }
}
