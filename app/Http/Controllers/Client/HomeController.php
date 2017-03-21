<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\AppBaseController;
use App\Repositories\EvaluationRepository;
use App\Repositories\ClientRepository;
use App\Http\Requests;
use Illuminate\Http\Request;
use Auth;

class HomeController extends AppBaseController
{


    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    
    protected $evaluationRepository;
    protected $clientRepository;

    
    
    public function __construct(EvaluationRepository $evaluationRepo, 
                                ClientRepository $clientRepo)
    {
        $this->evaluationRepository = $evaluationRepo;
        $this->clientRepository = $clientRepo;
       
        
    }
    
    public function index()
    {
        $evaluations = $this->evaluationRepository->findWhere(['client_id' => Auth::user()->client_id]);
        $client = $this->clientRepository->findWhere(['id' => Auth::user()->client_id])->first();
        
        return view('client.home')->with('evaluations', $evaluations)
                                  ->with('client', $client);
        
    }
    
    public function competitors($id) 
    {
        $evaluation = $this->evaluationRepository->findWithoutFail($id);
        $client = $this->clientRepository->findWhere(['id' => Auth::user()->client_id])->first();
        
        return view('client.competitors')->with('competitors', $evaluation->competitors)
                                         ->with('client', $client);
        
    }
}
