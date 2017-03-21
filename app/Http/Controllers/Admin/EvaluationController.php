<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\AppBaseController;
use App\Http\Requests;
use App\Criteria\ClientCriteria;
use App\Http\Requests\CreateEvaluationRequest;
use App\Http\Requests\UpdateEvaluationRequest;
use App\Repositories\UserRepository;
use App\Repositories\CompetencyRepository;
use App\Repositories\DocumentRepository;
use App\Repositories\MessageRepository;
use App\Repositories\EvaluationRepository;
use App\Repositories\EvaluationUserRepository;
use App\Models\Client;
use Illuminate\Http\Request;
use Flash;
use App\Models\Rating;
use App\Models\Exercise;
use App\Models\Message;
use App\Library\ExcelImport;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Illuminate\Support\Facades\Input;

class EvaluationController extends AdminController
{
    /** @var  EvaluationRepository */

    private $userRepository;
    private $competencyRepository;
    private $evaluationUserRepository;
    private $evaluationRepository;
    private $documentRepository;

    public function __construct(UserRepository $userRepo,
                                EvaluationRepository $evaluationRepo,
                                EvaluationUserRepository $evaluationUserRepo,
                                CompetencyRepository $competencyRepo,
                                DocumentRepository $documentRepo)
    {
        //parent::__construct();

        $this->userRepository = $userRepo;
        $this->evaluationUserRepository = $evaluationUserRepo;
        $this->evaluationRepository = $evaluationRepo;
        $this->competencyRepository = $competencyRepo;
        $this->documentRepository = $documentRepo;
        
    }

    /**
     * Display a listing of the Evaluation.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        
        $evaluations = $this->evaluationRepository->all();

        return view('admin.evaluations.index')->with('evaluations', $evaluations);
    }

    /**
     * Show the form for creating a new Evaluation.
     *
     * @return Response
     */
    public function create()
    {
        
        return view('admin.evaluations.create')->with('clients', Client::lists('name','id'))
                                                ->with('ratings', Rating::lists('name', 'id'))
                                                ->with('messages', Message::lists('subject', 'id'))
                                                ->with('exercises',Exercise::lists('name', 'id'));
                                                
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

        $evaluation = $this->evaluationRepository->create($input);

        $excel = new ExcelImport($this->userRepository,
                                 $this->evaluationUserRepository);



        $excel->setClientId($evaluation->client_id);
        $excel->setEvaluationId($evaluation->id);
        $excel->importUsers($request->file('users_excel'));
        
        $upload_status = $this->uploadFiles($request->file('docs'), $evaluation->id);
        

         if ($request->get('start'))
            $this->evaluationUserRepository->startEvaluation($evaluation);

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
            Flash::success('Evaluacion creada correctamente.');
            return redirect(route('evaluations.index'));
        }


    }
    
    public function getExercises(Request $request)
    {
         return Exercise::where('client_id', $request->get('client_id'))->orWhere('client_id', 0)->get()->toJson();
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
        $evaluation = $this->evaluationRepository->findWithoutFail($id);

        if (empty($evaluation)) {
            Flash::error('Evaluacion no encontrada');

            return redirect(route('evaluations.index'));
        }

        return view('admin.evaluations.edit')->with('evaluation', $evaluation)
                                                ->with('clients', Client::lists('name','id'))
                                                ->with('ratings', Rating::lists('name', 'id'))
                                                ->with('messages', Message::lists('subject', 'id'))
                                                ->with('exercises',Exercise::lists('name', 'id'));
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
        $evaluation = $this->evaluationRepository->findWithoutFail($id);

        if (empty($evaluation)) {
            Flash::error('Evaluacion no encontrada');

            return redirect(route('evaluations.index'));
        }

        $evaluation = $this->evaluationRepository->update($request->all(), $id);

        //$upload_status = $this->uploadFiles($request->file('docs'), $evaluation->id);

        $excel = new ExcelImport( $this->userRepository,
                                 $this->evaluationUserRepository);
        
        $excel->setClientId($evaluation->client_id);
        $excel->setEvaluationId($evaluation->id);
        $excel->importUsers($request->file('users_excel'));
        
        $upload_status = $this->uploadFiles($request->file('docs'), $evaluation->id);
        
        if ($request->get('start'))
          $this->evaluationUserRepository->startEvaluation($evaluation);
           
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
            Flash::success('Evaluacion actualizada correctamente');
            return redirect(route('evaluations.index'));
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
        $evaluation = $this->evaluationRepository->findWithoutFail($id);

        if (empty($evaluation)) {
            Flash::error('Evaluacion no encontrada');

            return redirect(route('evaluations.index'));
        }

        $this->evaluationRepository->delete($id);

        Flash::success('Evaluacion eliminada correctamente');

        return redirect(route('evaluations.index'));
    }
}
