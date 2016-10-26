<?php
namespace App\Criteria;

use Prettus\Repository\Contracts\RepositoryInterface;
use Prettus\Repository\Contracts\CriteriaInterface;
use Auth;

class ClientEmptyCriteria implements CriteriaInterface {

    private $superadmin;

    public function __construct($superadmin)
    {
        $this->superadmin = $superadmin;
    }
    public function apply($model, RepositoryInterface $repository)
    {
        if (!$this->superadmin)
          $model = $model->orWhere('client_id','=', '');
        return $model;

    }
}
