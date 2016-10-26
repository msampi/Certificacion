<?php
namespace App\Criteria;

use Prettus\Repository\Contracts\RepositoryInterface;
use Prettus\Repository\Contracts\CriteriaInterface;
use Auth;

class EqualCriteria implements CriteriaInterface {

		private $field;
		private $value;

		public function __construct($field, $value)
		{
				$this->field = $field;
				$this->value = $value;

		}
    public function apply($model, RepositoryInterface $repository)
    {

        return $model->where($this->field,'=', $this->value);

    }
}
