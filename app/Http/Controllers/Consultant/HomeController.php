<?php

namespace App\Http\Controllers\Consultant;

use App\Http\Controllers\AppBaseController;
use App\Http\Requests;
use App\Repositories\EvaluationUserRepository;
use App\Repositories\ExerciseRepository;
use App\Repositories\UserRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use Illuminate\Http\Request;
use App\Criteria\ConsultantCriteria;


class HomeController extends ConsultantController
{

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    
    protected $exerciseRepository;
    protected $userRepository;
    
    public function __construct(ExerciseRepository $exerciseRepo, UserRepository $userRepo)
    {
        parent::__construct();
        $this->exerciseRepository = $exerciseRepo;
        $this->userRepository = $userRepo;
        
    }
    
    public function index()
    {
        
        return view('consultant.home')->with('evaluationUser',$this->evaluationUser);
    }
    
    public function progress(Request $request)
    {
        
        $this->exerciseRepository->pushCriteria(new RequestCriteria($request));
        $exercise = $this->exerciseRepository->first();
        $this->evaluationUserRepository->pushCriteria(new ConsultantCriteria($this->evaluationUser->evaluation_id));
        $evaluationUser = $this->evaluationUserRepository->all();
        return view('consultant.progress')->with('evaluationUser',$evaluationUser)
                                          ->with('exercise',$exercise);
    }
    
    public function follow($exercise_id, $competitor_id)
    {
        
        $competitor = $this->userRepository->find($competitor_id);
        $exercise = $this->exerciseRepository->find($exercise_id);
        return view('consultant.follow')->with('competitor',$competitor)
                                        ->with('exercise',$exercise);   
    }
}
