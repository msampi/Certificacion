<?php

namespace App\Http\Controllers\Competitor;

use App\Http\Controllers\AppBaseController;
use App\Http\Requests;
use App\Repositories\EvaluationUserRepository;
use App\Criteria\CompetitorEvaluationCriteria;
use Illuminate\Http\Request;
use App;
use Auth;
use View;
use Session;

class CompetitorController extends AppBaseController
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
        $this->evaluationUserRepository->pushCriteria(new CompetitorEvaluationCriteria());
        $this->evaluationUser = $this->evaluationUserRepository->first();
        $client = Auth::user()->client;
        Session::put('evaluation_id', $this->evaluationUser->evaluation_id);
        View::share('client',$client);
        
    }
    
    
    
    
}
