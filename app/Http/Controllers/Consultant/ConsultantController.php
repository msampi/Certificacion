<?php

namespace App\Http\Controllers\Consultant;

use App\Http\Controllers\AppBaseController;
use App\Http\Requests;
use App\Criteria\ConsultantCriteria;
use App\Repositories\EvaluationUserRepository;
use App\Repositories\TrackingRepository;
use Illuminate\Http\Request;
use App;
use Auth;
use View;
use Session;

class ConsultantController extends AppBaseController
{

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    
    protected $evaluationUserRepository;
    protected $evaluationUser;
    protected $is_primary_consultant;
    protected $partner_consultant_id;
    protected $trackingRepository;
    protected $tracking;
    
    
    public function __construct()
    {
        $this->evaluationUserRepository = App::make(EvaluationUserRepository::class);
        $this->evaluationUserRepository->pushCriteria(new ConsultantCriteria());
        $this->trackingRepository = App::make(TrackingRepository::class);
        $this->evaluationUser = $this->evaluationUserRepository->first();
        $this->is_primary_consultant = $this->isPrimaryConsultant();
        $this->setPartnerConsultant();
        
        
        View::share('is_primary_consultant', $this->is_primary_consultant);
        View::share('partner_consultant_id', $this->partner_consultant_id);
        $client = Auth::user()->client;
        View::share('client',$client);
        Session::put('evaluation_id', $this->evaluationUser->evaluation_id);
        
        $this->tracking = $this->trackingRepository->firstOrCreate(
                                        ['user_id'=>Auth::user()->id, 
                                         'role_id' => Auth::user()->role_id,
                                         'evaluation_id' => Session::get('evaluation_id'), 
                                         'client_id'=>Auth::user()->client_id 
                                        ]);
        
    }
    
    private function isPrimaryConsultant()
    {
        if ($this->evaluationUser->primary_consultant_id == Auth::user()->id)
            return true;
        return false;
    }
    
    private function setPartnerConsultant()
    {
        if ($this->is_primary_consultant)
            $this->partner_consultant_id = $this->evaluationUser->secondary_consultant_id;    
        else
            $this->partner_consultant_id = $this->evaluationUser->primary_consultant_id;
    }
    
    
}
