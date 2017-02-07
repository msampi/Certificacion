<?php
namespace App\Criteria;

use Prettus\Repository\Contracts\RepositoryInterface;
use Prettus\Repository\Contracts\CriteriaInterface;
use Auth;
use Session;

class ConsultantEvaluationCriteria implements CriteriaInterface {

    /* Encuentra la ultima evaluacion donde el consultor es primario o secundario */
    private $consultant_id;
    
    public function __construct($consultant_id){
        $this->consultant_id = $consultant_id;
    }
    public function apply($model, RepositoryInterface $repository)
    {

         return $model->where(function ($query) {
                        $query->where('primary_consultant_id','=', $this->consultant_id)
                              ->where('evaluation_id', '=', Session::get('evaluation_id'))
                              ->orderBy('created_at','DESC');
                    })->orWhere(function ($query) {
                        $query->where('secondary_consultant_id','=', $this->consultant_id)
                              ->where('evaluation_id', '=', Session::get('evaluation_id'))
                              ->orderBy('created_at','DESC');
                    })->get();
       

    }
}
