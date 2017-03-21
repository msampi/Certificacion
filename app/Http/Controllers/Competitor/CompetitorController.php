<?php

namespace App\Http\Controllers\Competitor;

use App\Http\Controllers\AppBaseController;
use App\Http\Requests;
use App\Repositories\EvaluationUserRepository;
use App\Repositories\TrackingRepository;
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
    protected $trackingRepository;
    protected $tracking;

    
    public function __construct()
    {
        $this->evaluationUserRepository = App::make(EvaluationUserRepository::class);
        $this->trackingRepository = App::make(TrackingRepository::class);
        $this->evaluationUserRepository->pushCriteria(new CompetitorEvaluationCriteria());
        $this->evaluationUser = $this->evaluationUserRepository->first();
        $client = Auth::user()->client;
        Session::put('evaluation_id', $this->evaluationUser->evaluation_id);
        
        $this->tracking = $this->trackingRepository->firstOrCreate(
                                        ['user_id'=>Auth::user()->id, 
                                         'role_id' => Auth::user()->role_id,
                                         'evaluation_id' => Session::get('evaluation_id'), 
                                         'client_id'=>Auth::user()->client_id 
                                        ]);
        
        View::share('client',$client);
        
    }
    
    
    
    
}
