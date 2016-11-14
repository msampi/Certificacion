<?php

namespace App\Models;

use Eloquent as Model;

/**
 * Class Questionary
 * @package App\Models
 */
class QuestionOption extends Model
{

    public $table = 'question_options';
    


    public $fillable = [
        'option',
        
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'option' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        
    ];
    
    
}
