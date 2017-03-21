<?php

namespace App\Http\Controllers\Competitor;

use App\Http\Controllers\AppBaseController;
use App\Repositories\EvaluationExerciseRepository;
use App\Repositories\AutoperceptionReviewRepository;
use App\Repositories\ConsultantReviewRepository;
use App\Repositories\ExerciseRepository;
use App\Repositories\UserRepository;
use App\Repositories\QuestionReviewRepository;
use App\Criteria\EvaluationExerciseCriteria;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\Models\AutoperceptionReview;
use App\Library\Ecases;
use Auth;

class HomeController extends CompetitorController
{


    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    protected $exerciseRepository;
    protected $userRepository;
    protected $evaluationExerciseRepository; 
    protected $autoperceptionReviewRepository; 
    protected $questionReviewRepository; 
    protected $consultantReviewRepository;
    
    public function __construct(ExerciseRepository $exerciseRepo, 
                                UserRepository $userRepo,
                                EvaluationExerciseRepository $evaluationExerciseRepo,
                                AutoperceptionReviewRepository $autoperceptionReviewRepo,
                                QuestionReviewRepository $questionReviewRepo,
                                ConsultantReviewRepository $consultantReviewRepo)
    {
        parent::__construct();
        $this->exerciseRepository = $exerciseRepo;
        $this->userRepository = $userRepo;
        $this->evaluationExerciseRepository = $evaluationExerciseRepo;
        $this->autoperceptionReviewRepository = $autoperceptionReviewRepo;
        $this->questionReviewRepository = $questionReviewRepo;
        $this->consultantReviewRepository = $consultantReviewRepo;
        
    }
    

    
    public function index()
    {
        $this->trackingRepository->saveTrackingAction($this->tracking->id,'Ingreso al Dashboard');
        return view('competitor.home')->with('evaluationUser',$this->evaluationUser);
    }
    
    public function view(Request $request)
    {
        $exercise = $this->exerciseRepository->find($request->id);
        $this->evaluationExerciseRepository->pushCriteria(new EvaluationExerciseCriteria($exercise->id));
        $evaluation_exercise = $this->evaluationExerciseRepository->first();
        $evaluation_exercise->status_competitor = 1;
        $evaluation_exercise->save(); 
        $view = 'competitor.'.$exercise->getExerciseView();
        $this->trackingRepository->saveTrackingAction($this->tracking->id,'Ingreso a "'.$exercise->name.'"');
        return view($view)->with('exercise',$exercise)
                          ->with('autoperceptionReviewRepository', $this->autoperceptionReviewRepository)
                          ->with('questionReviewRepository', $this->questionReviewRepository);
    }
    
    
    
    public function autoperceptionSave(Request $request)
    {
        $this->autoperceptionReviewRepository->save($request);
        echo 1;
    }
    
    public function knowledgeSave(Request $request)
    {
        $this->questionReviewRepository->save($request);
        echo 1;
    }
    
    public function connectEcase(Request $request)
    {
        $exercise = $this->exerciseRepository->find($request->id);
        $ecase = new Ecases(Auth::user(),$exercise->simulation_id);
        $ecase->createAndAssignUser();
        $this->trackingRepository->saveTrackingAction($this->tracking->id,'Registro en plataforma E-case');
        return redirect()->away('http://www.ecases-pe.com');
    }
        
    
   
}
