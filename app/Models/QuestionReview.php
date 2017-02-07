<?php

namespace App\Models;

use Eloquent as Model;

/**
 * Class Questionary
 * @package App\Models
 */
class QuestionReview extends Model
{

    public $table = 'question_reviews';
    


    public $fillable = [
        'question_id',
        'competitor_id',
        'exercise_id',
        'evaluation_id',
        'question_option_id',
        'value'
        
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'question_id' => 'integer',
        'competitor_id' => 'integer',
        'exercise_id' => 'integer',
        'evaluation_id' => 'integer',
        'question_option_id' => 'integer',
        'value' => 'string'
        
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        
    ];
    
    
}
