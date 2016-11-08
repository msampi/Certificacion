<?php
namespace App\Criteria;

use Prettus\Repository\Contracts\RepositoryInterface;
use Prettus\Repository\Contracts\CriteriaInterface;
use Auth;

class ConsultantCriteria implements CriteriaInterface {


    private $evaluation_id;
    
    public function __construct($evaluation_id)
    {
        $this->evaluation_id = $evaluation_id;
    }
    public function apply($model, RepositoryInterface $repository)
    {

        return $model->where('primary_consultant_id','=', Auth::user()->id)->orWhere('secondary_consultant_id','=', Auth::user()->id);

    }
}
