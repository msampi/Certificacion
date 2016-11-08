<?php

namespace App\Http\Controllers\Consultant;

use App\Http\Controllers\AppBaseController;
use App\Http\Requests;
use App\Criteria\ConsultantEvaluationCriteria;
use App\Repositories\EvaluationUserRepository;
use Illuminate\Http\Request;
use App;

class ConsultantController extends AppBaseController
{

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    
    protected $evaluationUserRepository;
    protected $evaluationUser;
    
    
    public function __construct()
    {
        $this->evaluationUserRepository = App::make(EvaluationUserRepository::class);
        $this->evaluationUserRepository->pushCriteria(new ConsultantEvaluationCriteria());
        $this->evaluationUser = $this->evaluationUserRepository->first();
       
    }
    
    
}
