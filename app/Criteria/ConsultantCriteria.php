<?php
namespace App\Criteria;

use Prettus\Repository\Contracts\RepositoryInterface;
use Prettus\Repository\Contracts\CriteriaInterface;
use Auth;
use Session;

class ConsultantCriteria implements CriteriaInterface {


    
    public function apply($model, RepositoryInterface $repository)
    {

        
        return $model->where('primary_consultant_id','=', Auth::user()->id)
                     ->orWhere('secondary_consultant_id','=', Auth::user()->id);
                    

    }
}
