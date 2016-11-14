<?php

namespace App\Models;

use Eloquent as Model;

/**
 * Class Questionary
 * @package App\Models
 */
class Question extends Model
{

    public $table = 'questions';
    


    public $fillable = [
        'question',
        
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'question' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        
    ];
    
    public function options()
    {
        return $this->hasMany('App\Models\QuestionOption');
    }
}
