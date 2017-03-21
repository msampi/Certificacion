<?php

namespace App\Http\Controllers\Consultant;

use App\Http\Controllers\AppBaseController;
use App\Http\Requests;
use App\Repositories\AutoperceptionReviewRepository;
use App\Repositories\EvaluationUserRepository;
use App\Repositories\EvaluationExerciseRepository;
use App\Repositories\ConsultantReviewRepository;
use App\Repositories\ExerciseRepository;
use App\Repositories\QuestionReviewRepository;
use App\Repositories\UserRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use Illuminate\Http\Request;
use App\Criteria\ConsultantEvaluationCriteria;
use App\Criteria\ConsultantCriteria;
use App\Criteria\EvaluationExerciseCriteria;
use App\Models\EvaluationUser;
use App\Library\Ecases;
use Session;
use Auth;


class HomeController extends ConsultantController
{

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    
    protected $exerciseRepository;
    protected $userRepository;
    protected $questionReviewRepository; 
    protected $autoperceptionReviewRepository; 
    protected $evaluationExerciseRepository;
    protected $consultantReviewRepository;
    
    public function __construct(ExerciseRepository $exerciseRepo, 
                                UserRepository $userRepo,
                                EvaluationExerciseRepository $evaluationExerciseRepo,
                                ConsultantReviewRepository $consultantReviewRepo,
                                AutoperceptionReviewRepository $autoperceptionReviewRepo,
                                QuestionReviewRepository $questionReviewRepo)
    {
        parent::__construct();
        $this->exerciseRepository = $exerciseRepo;
        $this->userRepository = $userRepo;
        $this->evaluationExerciseRepository = $evaluationExerciseRepo;
        $this->consultantReviewRepository = $consultantReviewRepo;
        $this->autoperceptionReviewRepository = $autoperceptionReviewRepo;
        $this->questionReviewRepository = $questionReviewRepo;
    }
    
    public function index()
    {
        $this->trackingRepository->saveTrackingAction($this->tracking->id,'Ingreso al Dashboard');
        return view('consultant.home')->with('evaluationUser',$this->evaluationUser);
    }
    
    
    
    public function progress(Request $request)
    {
       
        $exercise = $this->exerciseRepository->find($request->id);
       
        
        $this->evaluationExerciseRepository->pushCriteria(new EvaluationExerciseCriteria($exercise->id));
        $evaluation_exercise = $this->evaluationExerciseRepository->first();
        $evaluation_exercise->status = 1;
        $evaluation_exercise->save(); // Se habilita el ejercicio para todos los usuarios
        
        $this->evaluationUserRepository->pushCriteria(new ConsultantEvaluationCriteria($request->get('consultant_id')));
        $evaluationUser = $this->evaluationUserRepository->all();
    
        $view = $exercise->getExerciseView();
          
        return view('consultant.progress')->with('evaluationUser',$evaluationUser)
                                          ->with('exercise',$exercise)
                                          ->with('view',$view)
                                          ->with('evaluation_exercise',$evaluation_exercise);
    }
    
    public function changeStatus(Request $request)
    {
       
        $exercise = $this->exerciseRepository->find($request->id);
       
        $this->evaluationUserRepository->pushCriteria(new ConsultantCriteria($this->evaluationUser->evaluation_id));
        $this->evaluationExerciseRepository->pushCriteria(new EvaluationExerciseCriteria($exercise->id));
        $evaluation_exercise = $this->evaluationExerciseRepository->first();
        $evaluation_exercise->status = $request->status;
        if ($request->status == 1)
            $this->trackingRepository->saveTrackingAction($this->tracking->id,'Comienzo del ejercicio "'.$exercise->name.'"');
        if ($request->status == 2)
            $this->trackingRepository->saveTrackingAction($this->tracking->id,'Finalización del ejercicio "'.$exercise->name.'"');
            
        $evaluation_exercise->save(); 
        $evaluationUser = $this->evaluationUserRepository->all();
        
        return view('consultant.home')->with('evaluationUser',$this->evaluationUser);
    }
    
    public function getAltConsultantLabel($consultant_id)
    {
        if (Auth::user()->id != $consultant_id)
            if ($this->is_primary_consultant)
                return 'primario';
            else
                return 'secundario';
        else
            if ($this->is_primary_consultant)
                return 'secundario';
            else
                return 'primario';
            
        
    }
    
    public function getAltConsultantId($consultant_id)
    {
        if (Auth::user()->id != $consultant_id)
            return Auth::user()->id;
        else
            return $this->partner_consultant_id;
            
    }
    
    public function view($exercise_id, $competitor_id, $consultant_id)
    {
        
        $competitor = $this->userRepository->find($competitor_id);
        $exercise = $this->exerciseRepository->find($exercise_id);
        $consultantReview = $this->consultantReviewRepository->findWhere(
                                    ['evaluation_id' => Session::get('evaluation_id'),
                                     'exercise_id'   => $exercise_id,
                                     'competitor_id' => $competitor->id,
                                     'consultant_id' => $consultant_id]
                            )->first();
        $ecaseCompetencies = NULL;
        $ecaseDecision = NULL;
        $ecaseDiary = NULL;
        $ecaseWrite = NULL;
        
        $this->trackingRepository->saveTrackingAction($this->tracking->id,'Ingreso al ejercicio "'.$exercise->name.'" de '.$competitor->name.' '.$competitor->last_name);
        
        if ($exercise->simulation_id) : // Indica que es un ejercicio de tipo E-cases
            $ecase = new Ecases($competitor,$exercise->simulation_id);
            $ecaseDecision = $ecase->getDecisions();
            $ecaseDiary = $ecase->getDiary();
            $ecaseWrite = $ecase->getDirectorWrite();
        endif;
        
        
        
        $view = 'consultant.'.$exercise->getExerciseView();
        $disabled = '';
        
        if (Auth::user()->id != $consultant_id)
            $disabled='disabled';        
        
        return view($view)->with('competitor',$competitor)
                          ->with('exercise',$exercise)
                          ->with('consultant_id',$consultant_id)
                          ->with('consultantReview',$consultantReview)
                          ->with('disabled',$disabled)
                          ->with('consultant_label',$this->getAltConsultantLabel($consultant_id))
                          ->with('alt_consultant_id',$this->getAltConsultantId($consultant_id))
                          ->with('consultantReview',$consultantReview)
                          ->with('ecaseDecision',$ecaseDecision)
                          ->with('ecaseDiary',$ecaseDiary)
                          ->with('ecaseWrite',$ecaseWrite)
                          ->with('autoperceptionReviewRepository', $this->autoperceptionReviewRepository)
                          ->with('questionReviewRepository', $this->questionReviewRepository); 
    }


    public function save(Request $request)
    {
        $this->consultantReviewRepository->save($request);
        echo 1;
    }
}
