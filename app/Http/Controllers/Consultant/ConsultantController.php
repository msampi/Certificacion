<?php

namespace App\Http\Controllers\Consultant;

use App\Http\Controllers\AppBaseController;
use App\Http\Requests;
use App\Criteria\ConsultantCriteria;
use App\Repositories\EvaluationUserRepository;
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
    
    
    public function __construct()
    {
        $this->evaluationUserRepository = App::make(EvaluationUserRepository::class);
        $this->evaluationUserRepository->pushCriteria(new ConsultantCriteria());
        $this->evaluationUser = $this->evaluationUserRepository->first();
        $this->is_primary_consultant = $this->isPrimaryConsultant();
        $this->setPartnerConsultant();
        
        
        View::share('is_primary_consultant', $this->is_primary_consultant);
        View::share('partner_consultant_id', $this->partner_consultant_id);
        $client = Auth::user()->client;
        View::share('client',$client);
        Session::put('evaluation_id', $this->evaluationUser->evaluation_id);
        
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
