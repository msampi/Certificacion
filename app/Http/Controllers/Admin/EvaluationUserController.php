<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\AppBaseController;
use App\Http\Requests;
use App\Http\Requests\CreateEvaluationUserRequest;
use App\Http\Requests\UpdateEvaluationUserRequest;
use App\Repositories\EvaluationUserRepository;
use App\Repositories\EvaluationRepository;
use App\Repositories\UserRepository;
use App\Criteria\ConsultantCriteria;
use App\Criteria\CompetitorCriteria;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Models\User;
use Illuminate\Http\Request;
use Flash;
use Response;



class EvaluationUserController extends AdminController
{
    /** @var  EvaluationRepository */
    private $evaluationUserRepository;
    private $evaluationRepository;


    public function __construct(EvaluationUserRepository $evaluationUserRepo, 
                                EvaluationRepository $evaluationRepo)
    {
        $this->evaluationUserRepository = $evaluationUserRepo;
        $this->evaluationRepository = $evaluationRepo;
        
       
    }

    /**
     * Display a listing of the Evaluation.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->evaluationUserRepository->pushCriteria(new RequestCriteria($request));
        $this->evaluationRepository->pushCriteria(new RequestCriteria($request));
        $evaluation_users = $this->evaluationUserRepository->all();
        $evaluation = $this->evaluationRepository->first();
        

        return view('admin.evaluationUser.index')->with('evaluation_users', $evaluation_users)
                                                 ->with('evaluation', $evaluation);


    }

    /**
     * Show the form for creating a new Evaluation.
     *
     * @return Response
     */
    public function create(Request $request)
    {
       
        $evaluation = $this->evaluationRepository->find($request->search);
        $consultants = User::where('role_id',4)->where('client_id',$evaluation->client_id)
                                               ->lists('email','id');  
        $competitors = User::where('role_id',3)->where('client_id',$evaluation->client_id)
                                               ->lists('email','id');  
    
        return view('admin.evaluationUser.create')->with('evaluation', $evaluation)
                                                            ->with('competitors', $competitors)
                                                            ->with('consultants', $consultants);
    }

    /**
     * Store a newly created Evaluation in storage.
     *
     * @param CreateEvaluationRequest $request
     *
     * @return Response
     */
    public function store(CreateEvaluationUserRequest $request)
    {

        $input = $request->all();
        
        if ($input['primary_consultant_id'] == $input['secondary_consultant_id'] )
        {
            
            Flash::error('El consultor primario y secundario no puede ser el mismo');
            return redirect(route('evaluationUser.create','search='.$request->get('evaluation_id')));
        
        }

        $evaluation = $this->evaluationUserRepository->create($input);

        Flash::success('Asignación guardada correctamente');

        return redirect(route('evaluationUser.index','search='.$request->get('evaluation_id')));

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
        $evaluationUser = $this->evaluationUserRepository->findWithoutFail($id);
        $evaluation = $evaluationUser->evaluation;
        $consultants = User::where('role_id',4)->where('client_id',$evaluation->client_id)
                                               ->lists('email','id');  
        $competitors = User::where('role_id',3)->where('client_id',$evaluation->client_id)
                                               ->lists('email','id');  
        
        
        if (empty($evaluation)) {
            Flash::error($this->dictionary->translate('Evaluación no encontrada'));

            return redirect(route('admin.evaluationUser.index'));
        }

        return view('admin.evaluationUser.edit')->with('evaluation', $evaluation)
                                                ->with('evaluationUser', $evaluationUser)
                                                          ->with('competitors', $competitors)
                                                          ->with('consultants', $consultants);
    }

    /**
     * Update the specified Evaluation in storage.
     *
     * @param  int              $id
     * @param UpdateEvaluationRequest $request
     *
     * @return Response
     */



    public function update($id, UpdateEvaluationUserRequest $request)
    {
        $evaluation = $this->evaluationUserRepository->findWithoutFail($id);

        if (empty($evaluation)) {

            Flash::error('Evaluación no encontrada');
            return redirect(route('evaluationUser.index','search='.$evaluation->evaluation_id));

        }
        
        


        $input = $request->all();
        
        if ($input['primary_consultant_id'] == $input['secondary_consultant_id'] )
        {
            
            Flash::error('El consultor primario y secundario no puede ser el mismo');
            return redirect(route('evaluationUser.edit', [$evaluation->id]));
        
        }
        
        $evaluation = $this->evaluationUserRepository->update($input,$id);

        Flash::success('Evaluación actualizada correctamente');

        return redirect(route('evaluationUser.index','search='.$evaluation->evaluation_id));
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
        $evaluation = $this->evaluationUserRepository->findWithoutFail($id);

        if (empty($evaluation)) {
            Flash::error('Asignación no encontrada');

            return redirect(route('evaluationUser.index'));
        }

        $this->evaluationUserRepository->delete($id);

        Flash::success('Asignación eliminada correctamente');

        return redirect(route('evaluationUser.index', 'search='.$evaluation->evaluation_id));
    }
}
