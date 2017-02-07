<?php namespace App\Http\ViewComposers;

use Response;
use App\Http\Requests;
use Illuminate\Contracts\View\View;
use App\Repositories\UserRepository;
use App\Repositories\ClientRepository;
use App\Repositories\EvaluationRepository;
use App\Repositories\RatingRepository;
use App\Repositories\CompetencyRepository;
use App\Repositories\ExerciseRepository;
use App\Repositories\MessageRepository;



class GlobalComposer
{

    private $userRepo;
    private $clientRepo;
    private $evaluationRepo;
    private $ratingRepo;
    private $competencyRepo;
    private $exerciseRepo;
    private $messageRepo;

    public function __construct(UserRepository $userRepo, 
                                ClientRepository $clientRepo, 
                                EvaluationRepository $evaluationRepo, 
                                RatingRepository $ratingRepo,
                                CompetencyRepository $competencyRepo,
                                ExerciseRepository $exerciseRepo,
                                MessageRepository $messageRepo)
    {
        $this->userRepo = $userRepo;
        $this->clientRepo = $clientRepo;
        $this->evaluationRepo = $evaluationRepo;
        $this->ratingRepo = $ratingRepo;
        $this->competencyRepo = $competencyRepo;
        $this->exerciseRepo = $exerciseRepo;
        $this->messageRepo = $messageRepo;
    }
    /**
     * Bind data to the view.
     *
     * @param  View $view
     * @return void
     */
    public function compose(View $view)
    {
        $view->with('userCount',  $this->userRepo->countRecords());
        $view->with('clientCount',  $this->clientRepo->countRecords());
        $view->with('evaluationCount',  $this->evaluationRepo->countRecords());
        $view->with('ratingCount',  $this->ratingRepo->countRecords());
        $view->with('competencyCount',  $this->competencyRepo->countRecords());
        $view->with('exerciseCount',  $this->exerciseRepo->countRecords());
        $view->with('messageCount',  $this->messageRepo->countRecords());
    }
}
