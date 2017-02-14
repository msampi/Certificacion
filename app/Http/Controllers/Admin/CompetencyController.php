<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\AppBaseController;
use App\Http\Requests;
use App\Models\Post;
use App\Http\Requests\CreateCompetencyRequest;
use App\Http\Requests\UpdateCompetencyRequest;
use App\Repositories\CompetencyRepository;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use App\Models\CompetencyGroup;
use App\Models\Client;

class CompetencyController extends AdminController
{
    /** @var  CompetencyRepository */
    private $competencyRepository;


    public function __construct(competencyRepository $competencyRepo)
    {
        $this->competencyRepository = $competencyRepo;
    
    }

    /**
     * Display a listing of the competency.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->competencyRepository->pushCriteria(new RequestCriteria($request));
        $competencies = $this->competencyRepository->all();
        

        return view('admin.competencies.index')->with('competencies', $competencies);
    }

    /**
     * Show the form for creating a new Competency.
     *
     * @return Response
     */
    public function create(Request $request)
    {
        
        return view('admin.competencies.create')
                            ->with('competency_groups',CompetencyGroup::lists('name','id'))
                            ->with('clients',Client::lists('name','id')->prepend('Todos',0));
    }

    /**
     * Store a newly created competency in storage.
     *
     * @param CreateCompetencyRequest $request
     *
     * @return Response
     */
    public function store(CreatecompetencyRequest $request)
    {
        $input = $request->all();

        $competency = $this->competencyRepository->create($input);

        Flash::success('Competencia guardada correctamente');

        return redirect()->route('competencies.index');
    }

    /**
     * Show the form for editing the specified Competency.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        
        $competency = $this->competencyRepository->findWithoutFail($id);
       
        if (empty($competency)) {
            Flash::error('Competencia no encontrada');

            return redirect()->route('admin.competencies.index', 'search='.$competency->evaluation_id);
        }

        return view('admin.competencies.edit')->with('competency', $competency)
                                    ->with('competency_groups',CompetencyGroup::lists('name','id'))
                                    ->with('clients',Client::lists('name','id')->prepend('Todos',0));
    }
    
    public function getClientGroups(Request $request)
    {
        return CompetencyGroup::where('client_id', $request->get('client_id'))->get()->toJson();
    }

    /**
     * Update the specified competency in storage.
     *
     * @param  int              $id
     * @param UpdatecompetencyRequest $request
     *
     * @return Response
     */
    public function update($id, UpdatecompetencyRequest $request)
    {
        $competency = $this->competencyRepository->findWithoutFail($id);

        if (empty($competency)) {
            Flash::error('Competencia no encontrada');

            return redirect()->route('competencies.index');
        }

        $competency = $this->competencyRepository->update($request->all(), $id);


        Flash::success('Competencia actualizada correctamente');

        return redirect()->route('competencies.index');
    }

    /**
     * Remove the specified competency from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $competency = $this->competencyRepository->findWithoutFail($id);

        if (empty($competency)) {
            Flash::error('Competencia no encontrada');

            return redirect()->route('competencies.index');
        }

        $this->competencyRepository->delete($id);

        Flash::success('Competencia eliminada correctamente');

        return redirect()->route('competencies.index');
    }
}
