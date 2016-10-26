<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\AppBaseController;
use App\Http\Requests;
use App\Criteria\ClientCriteria;
use App\Http\Requests\CreateEvaluationRequest;
use App\Http\Requests\UpdateEvaluationRequest;
use App\Repositories\UserRepository;
use App\Repositories\PlanRepository;
use App\Repositories\ActionRepository;
use App\Repositories\PostRepository;
use App\Repositories\BehaviourRepository;
use App\Repositories\EvaluationUserEvaluatorRepository;
use App\Repositories\DocumentRepository;
use App\Repositories\CompetitionRepository;
use App\Repositories\ValorationRepository;
use App\Repositories\ObjectiveRepository;
use App\Repositories\MessageRepository;
use App\Models\Document;
use Illuminate\Http\Request;
use Flash;
use App\Models\Client;
use App\Models\Rating;
use App\Library\ExcelImport;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Illuminate\Support\Facades\Input;

class EvaluationController extends AdminBaseController
{
    /** @var  EvaluationRepository */

    private $documentRepository;
    private $userRepository;
    private $competitionRepository;
    private $behaviourRepository;
    private $valorationRepository;
    private $objectiveRepository;
    private $postRepository;
    private $messageRepository;
    private $planRepository;
    private $actionRepository;
    private $evaluationUserEvaluatorRepository;

    public function __construct(DocumentRepository $documentRepo,
                                UserRepository $userRepo,
                                EvaluationUserEvaluatorRepository $evaluationUserEvaluatorRepo,
                                CompetitionRepository $competitionRepo,
                                BehaviourRepository $behaviourRepo,
                                ValorationRepository $valorationRepo,
                                ObjectiveRepository $objectiveRepo,
                                PostRepository $postRepo,
                                PlanRepository $planRepo,
                                ActionRepository $actionRepo,
                                MessageRepository $messageRepo)
    {
        parent::__construct();

        $this->documentRepository = $documentRepo;
        $this->userRepository = $userRepo;
        $this->behaviourRepository = $behaviourRepo;
        $this->evaluationUserEvaluatorRepository = $evaluationUserEvaluatorRepo;
        $this->competitionRepository = $competitionRepo;
        $this->valorationRepository = $valorationRepo;
        $this->objectiveRepository = $objectiveRepo;
        $this->postRepository = $postRepo;
        $this->planRepository = $planRepo;
        $this->actionRepository = $actionRepo;
        $this->messageRepository = $messageRepo;
    }

    /**
     * Display a listing of the Evaluation.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->evaRepo->pushCriteria(new ClientCriteria($this->superadmin));
        $evaluations = $this->evaRepo->all();

        return view('admin.evaluations.index')
            ->with('evaluations', $evaluations);
    }

    /**
     * Show the form for creating a new Evaluation.
     *
     * @return Response
     */
    public function create()
    {
        $languages = $this->languageRepository->all();
        $messages = $this->messageRepository->getRoleUserMessages($this->superadmin);
        return view('admin.evaluations.create')->with('clients', $this->clients)
                                                ->with('ratings', Rating::lists('name', 'id'))
                                                ->with('languages',$languages)
                                                ->with('messages',$messages);
    }

    /**
     * Store a newly created Evaluation in storage.
     *
     * @param CreateEvaluationRequest $request
     *
     * @return Response
     */



    public function store(CreateEvaluationRequest $request)
    {


        $input = $request->all();
        $input['start_year_start'] = $this->transformToEnglishDate($request->input('first_stage'),0);
        $input['start_year_end'] = $this->transformToEnglishDate($request->input('first_stage'),1);
        $input['half_year_start'] = $this->transformToEnglishDate($request->input('second_stage'),0);
        $input['half_year_end'] = $this->transformToEnglishDate($request->input('second_stage'),1);
        $input['end_year_start'] = $this->transformToEnglishDate($request->input('third_stage'),0);
        $input['end_year_end'] = $this->transformToEnglishDate($request->input('third_stage'),1);
        $input['vis_half_year_start'] = $this->transformToEnglishDate($request->input('vis_half_year'),0);
        $input['vis_half_year_end'] = $this->transformToEnglishDate($request->input('vis_half_year'),1);
        $input['vis_end_year_start'] = $this->transformToEnglishDate($request->input('vis_end_year'),0);
        $input['vis_end_year_end'] = $this->transformToEnglishDate($request->input('vis_end_year'),1);


        $request->replace($input);

        $input = $request->all();

        $evaluation = $this->evaRepo->create($input);

        $upload_status = $this->uploadFiles($request->file('docs'), $evaluation->id);

        $excel = new ExcelImport($this->userRepository,
                                 $this->evaluationUserEvaluatorRepository,
                                 $this->competitionRepository,
                                 $this->behaviourRepository,
                                 $this->valorationRepository,
                                 $this->objectiveRepository,
                                 $this->postRepository,
                                 $this->planRepository,
                                 $this->actionRepository);



        $excel->setClientId($evaluation->client_id);
        $excel->setLanguage($request->get('import_lang'));
        $excel->setEvaluationId($evaluation->id);
        $excel->importUsers($request->file('users_excel'));
        $excel->importEvaluation($request->file('evaluation_excel'));

        if (isset($input['start']))
          $this->evaluationUserEvaluatorRepository->startEvaluation($evaluation);

        if ($upload_status == 2) {

            Flash::error('Uno o varios archivos que desea importar ya existen en la base de datos. Por favor cambie el/los nombre/s e intente nuevamente');
            return redirect(route('admin.evaluations.edit', [$evaluation->id]));

        }

        if ($upload_status == 2) {

            Flash::error('Uno o varios archivos que desea importar ya existen en la base de datos. Por favor cambie el/los nombre/s e intente nuevamente');

            return redirect(route('admin.evaluations.edit', [$evaluation->id]));

        }

        if ($excel->hasErrors()){
            Flash::error('Problemas encontrados en archivos de importacion:<br>'.$excel->getErrors());
            return redirect(route('admin.evaluations.edit', [$evaluation->id]));
        }
        else
        {
            Flash::success($this->dictionary->translate('Evaluacion actualizada correctamente'));
            return redirect(route('admin.evaluations.index'));
        }


    }



    /**
     * Show the form for editing the specified Evaluation.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $evaluation = $this->evaRepo->findWithoutFail($id);
        $evaluation->first_stage = $this->transformToSpanishDate($evaluation->start_year_start, $evaluation->start_year_end);
        $evaluation->second_stage = $this->transformToSpanishDate($evaluation->half_year_start, $evaluation->half_year_end);
        $evaluation->third_stage = $this->transformToSpanishDate($evaluation->end_year_start, $evaluation->end_year_end);
        $evaluation->vis_half_year = $this->transformToSpanishDate($evaluation->vis_half_year_start, $evaluation->vis_half_year_end);
        $evaluation->vis_end_year = $this->transformToSpanishDate($evaluation->vis_end_year_start, $evaluation->vis_end_year_end);
        $messages = $this->messageRepository->getRoleUserMessages($this->superadmin);
        $languages = $this->languageRepository->all();

        if (empty($evaluation)) {
            Flash::error($this->dictionary->translate('Evaluacion no encontrada'));

            return redirect(route('evaluations.index'));
        }

        return view('admin.evaluations.edit')->with('evaluation', $evaluation)
                                             ->with('clients', $this->clients)
                                             ->with('ratings', Rating::lists('name', 'id'))
                                             ->with('languages', $languages)
                                             ->with('messages', $messages);
    }

    /**
     * Update the specified Evaluation in storage.
     *
     * @param  int              $id
     * @param UpdateEvaluationRequest $request
     *
     * @return Response
     */

    private function transformToEnglishDate($date,$i)
    {
        if ($date) :
          $date = explode('-', $date);
          if (isset($date[$i]))
              $date = explode('/', $date[$i]);
          if ($date[0] && $date[1] && $date[2])
              return trim($date[2]).'-'.trim($date[1]).'-'.trim($date[0]).' 00:00:00';
          else
              return NULL;
        else:
          return NULL;
        endif;
    }

    private function transformToSpanishDate($start_date, $end_date)
    {

        $date_st = explode(' ', $start_date);
        $date_st = explode('-', $date_st[0]);
        $date_en = explode(' ', $end_date);
        $date_en = explode('-', $date_en[0]);

        return trim($date_st[2]).'/'.trim($date_st[1]).'/'.trim($date_st[0]).' - '.trim($date_en[2]).'/'.trim($date_en[1]).'/'.trim($date_en[0]);
    }

    public function uploadFiles($files, $evaluation_id)
    {
        $uploaded = 0;
        if ($files):

            foreach ($files as $file) :
                $file = $file['value'];

                if ($file) :

                    $document = $this->documentRepository->findByField('name',$file->getClientOriginalName());
                    if ($this->documentRepository->findByField('name',$file->getClientOriginalName())->isEmpty()) :
                        $file->move(base_path() . '/public/uploads/', $file->getClientOriginalName());

                        $data = ['name' => $file->getClientOriginalName(), 'evaluation_id' => $evaluation_id];
                        $document = $this->documentRepository->create($data);
                        $uploaded = 1;
                    else:

                        $uploaded = 2;
                    endif;

                endif;


            endforeach;

            return $uploaded;

        else:
            return 0;
        endif;


    }



    public function update($id, UpdateEvaluationRequest $request)
    {
        $evaluation = $this->evaRepo->findWithoutFail($id);

        if (empty($evaluation)) {
            Flash::error($this->dictionary->translate('Evaluacion no encontrada'));

            return redirect(route('admin.evaluations.index'));
        }



        $input = $request->all();
        $input['start_year_start'] = $this->transformToEnglishDate($request->input('first_stage'),0);
        $input['start_year_end'] = $this->transformToEnglishDate($request->input('first_stage'),1);
        $input['half_year_start'] = $this->transformToEnglishDate($request->input('second_stage'),0);
        $input['half_year_end'] = $this->transformToEnglishDate($request->input('second_stage'),1);
        $input['end_year_start'] = $this->transformToEnglishDate($request->input('third_stage'),0);
        $input['end_year_end'] = $this->transformToEnglishDate($request->input('third_stage'),1);
        $input['vis_half_year_start'] = $this->transformToEnglishDate($request->input('vis_half_year'),0);
        $input['vis_half_year_end'] = $this->transformToEnglishDate($request->input('vis_half_year'),1);
        $input['vis_end_year_start'] = $this->transformToEnglishDate($request->input('vis_end_year'),0);
        $input['vis_end_year_end'] = $this->transformToEnglishDate($request->input('vis_end_year'),1);


        $upload_status = $this->uploadFiles($request->file('docs'), $evaluation->id);

        $excel = new ExcelImport( $this->userRepository,
                                 $this->evaluationUserEvaluatorRepository,
                                 $this->competitionRepository,
                                 $this->behaviourRepository,
                                 $this->valorationRepository,
                                 $this->objectiveRepository,
                                 $this->postRepository,
                                 $this->planRepository,
                                 $this->actionRepository);

        $excel->setClientId($evaluation->client_id);
        $excel->setLanguage($request->get('import_lang'));
        $excel->setEvaluationId($evaluation->id);
        $excel->importUsers($request->file('users_excel'));
        $excel->importEvaluation($request->file('evaluation_excel'));

        if ($upload_status == 2) {

            Flash::error('Uno o varios archivos que desea importar ya existen en la base de datos. Por favor cambie el/los nombre/s e intente nuevamente');
            return redirect(route('admin.evaluations.edit', [$evaluation->id]));

        }

        $request->replace($input);


        $evaluation = $this->evaRepo->update($request->all(), $id);
        if (isset($input['start']))
          $this->evaluationUserEvaluatorRepository->startEvaluation($evaluation);

        $deleteInput = explode(',',$input['remove-item-list']);
        foreach ($deleteInput as $value) {
            if ($value){
                $document = Document::where('id',$value)->first();
                unlink(base_path() . '/public/uploads/' . $document->name );
                $document->delete();

            }
        }

        if ($excel->hasErrors()){
            Flash::error('Problemas encontrados en archivos de importacion:<br>'.$excel->getErrors());
            return redirect(route('admin.evaluations.edit', [$evaluation->id]));
        }
        else
        {
            Flash::success($this->dictionary->translate('Evaluacion actualizada correctamente'));
            return redirect(route('admin.evaluations.index'));
        }


    }

    /**
     * Remove the specified Evaluation from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $evaluation = $this->evaRepo->findWithoutFail($id);

        if (empty($evaluation)) {
            Flash::error($this->dictionary->translate('Evaluacion no encontrada'));

            return redirect(route('admin.evaluations.index'));
        }

        $this->evaRepo->delete($id);

        Flash::success($this->dictionary->translate('Evaluacion eliminada correctamente'));

        return redirect(route('admin.evaluations.index'));
    }
}
