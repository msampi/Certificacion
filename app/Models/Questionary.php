<?php

namespace App\Models;

use Eloquent as Model;

/**
 * Class Questionary
 * @package App\Models
 */
class Questionary extends Model
{

    public $table = 'questionaries';
    


    public $fillable = [
        'name',
        'type'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'name' => 'string',
        'type' => 'boolean'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        
    ];
    
    public function questions()
    {
        return $this->hasMany('App\Models\Question');
    }
}
