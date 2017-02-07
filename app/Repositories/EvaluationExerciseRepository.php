<?php

namespace App\Repositories;

use App\Models\EvaluationExercise;
use InfyOm\Generator\Common\BaseRepository;

class EvaluationExerciseRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return EvaluationExercise::class;
    }
    
    
    
   
}
