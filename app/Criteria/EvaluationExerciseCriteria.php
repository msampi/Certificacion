<?php
namespace App\Criteria;

use Prettus\Repository\Contracts\RepositoryInterface;
use Prettus\Repository\Contracts\CriteriaInterface;
use Session;

class EvaluationExerciseCriteria implements CriteriaInterface {

	private $exercise_id;
    
    public function __construct($exercise_id)
    {
        $this->exercise_id = $exercise_id;
    }
    public function apply($model, RepositoryInterface $repository)
    {
    	
        $model = $model->where('exercise_id','=', $this->exercise_id )->where('evaluation_id','=', Session::get('evaluation_id'));
     
        return $model;
        
    }
}
