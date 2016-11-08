<?php
namespace App\Criteria;

use Prettus\Repository\Contracts\RepositoryInterface;
use Prettus\Repository\Contracts\CriteriaInterface;


class CompetitorCriteria implements CriteriaInterface {


    public function apply($model, RepositoryInterface $repository)
    {

        return $model->where('role_id','=', 3);

    }
}
