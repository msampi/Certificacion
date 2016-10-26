<?php
namespace App\Criteria;

use Prettus\Repository\Contracts\RepositoryInterface;
use Prettus\Repository\Contracts\CriteriaInterface;
use Auth;
use Session;

class EvaluationUserEvaluatorCriteria implements CriteriaInterface {

	
    public function apply($model, RepositoryInterface $repository)
    {
    	
        $model = $model->where('evaluator_id','=', Auth::user()->id )->where('evaluation_id','=', Session::get('evaluation_id')  );
     
        return $model;
        
    }
}
