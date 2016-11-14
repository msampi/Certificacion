<?php

namespace App\Models;

use Eloquent as Model;

/**
 * Class Competition
 * @package App\Models
 */
class ExerciseCompetency extends BaseModel
{

    public $fillable = [
        'exercise_id',
        'competency_id',
        'number'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'exercise_id' => 'integer',
        'competency_id' => 'integer',
        'number'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    
    public function competency()
    {
        return $this->belongsTo('App\Models\Competency');
    }
   


    

}
