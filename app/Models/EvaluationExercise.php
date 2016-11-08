<?php

namespace App\Models;

use Eloquent as Model;

/**
 * Class Evaluation
 * @package App\Models
 */
class EvaluationExercise extends BaseModel
{

   

    public $dates = ['date_from', 'date_to'];



    public $fillable = [
        'evaluation_id',
        'exercise_id',
        'number',
        'date_from',
        'date_to',
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'evaluation_id' => 'integer',
        'exercise_id' => 'integer',
        'number' => 'integer'
        
    ];
    
    public function exercise()
    {
        return $this->belongsTo('App\Models\Exercise');
        
    }
    
    

    


   

    

}
