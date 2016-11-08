<?php
namespace App\Criteria;

use Prettus\Repository\Contracts\RepositoryInterface;
use Prettus\Repository\Contracts\CriteriaInterface;
use Auth;

class ConsultantEvaluationCriteria implements CriteriaInterface {

    /* Encuentra la ultima evaluacion donde el consultor es primario o secundario */
    
    public function apply($model, RepositoryInterface $repository)
    {

        return $model->where('primary_consultant_id', Auth::user()->id)
                     ->orWhere('secondary_consultant_id', Auth::user()->id)
                     ->orderBy('created_at','DESC');

    }
}
