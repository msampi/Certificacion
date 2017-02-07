<?php
namespace App\Criteria;

use Prettus\Repository\Contracts\RepositoryInterface;
use Prettus\Repository\Contracts\CriteriaInterface;
use Auth;

class CompetitorEvaluationCriteria implements CriteriaInterface {

    /* Encuentra la ultima evaluacion donde el consultor es primario o secundario */
    
    public function apply($model, RepositoryInterface $repository)
    {

        return $model->where('competitor_id', Auth::user()->id)
                     ->orderBy('created_at','DESC');

    }
}
