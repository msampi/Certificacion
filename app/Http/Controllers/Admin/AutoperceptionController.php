<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\AppBaseController;
use App\Http\Requests;
use App\Models\Post;
use App\Http\Requests\CreateAutoperceptionRequest;
use App\Http\Requests\UpdateAutoperceptionRequest;
use App\Repositories\AutoperceptionRepository;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use App\Models\Rating;
use App\Models\Client;

class AutoperceptionController extends AdminController
{
    /** @var  CompetencyRepository */
    private $autoperceptionRepository;


    public function __construct(autoperceptionRepository $autoperceptionRepo)
    {
        $this->autoperceptionRepository = $autoperceptionRepo;
    
    }

    /**
     * Display a listing of the competency.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->autoperceptionRepository->pushCriteria(new RequestCriteria($request));
        $autoperceptions = $this->autoperceptionRepository->all();
        

        return view('admin.autoperceptions.index')->with('autoperceptions', $autoperceptions);
    }

    /**
     * Show the form for creating a new Competency.
     *
     * @return Response
     */
    public function create(Request $request)
    {
        
        return view('admin.autoperceptions.create')->with('ratings',Rating::lists('name','id'))
                                                   ->with('clients',Client::lists('name','id')->prepend('Todos',0));
    }

    /**
     * Store a newly created competency in storage.
     *
     * @param CreateCompetencyRequest $request
     *
     * @return Response
     */
    public function store(CreateAutoperceptionRequest $request)
    {
        $input = $request->all();

        $competency = $this->autoperceptionRepository->create($input);

        Flash::success('Cuestionario guardado correctamente');

        return redirect()->route('autoperceptions.index');
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
        
        $autoperception = $this->autoperceptionRepository->findWithoutFail($id);
       
        if (empty($autoperception)) {
            Flash::error('Cuestionario no encontrado');

            return redirect()->route('admin.autoperceptions.index');
        }

        return view('admin.autoperceptions.edit')->with('autoperception', $autoperception)
                                                 ->with('ratings',Rating::lists('name','id'))
                                                 ->with('clients',Client::lists('name','id')->prepend('Todos',0));
    }

    /**
     * Update the specified competency in storage.
     *
     * @param  int              $id
     * @param UpdatecompetencyRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateAutoperceptionRequest $request)
    {
        $autoperception = $this->autoperceptionRepository->findWithoutFail($id);

        if (empty($autoperception)) {
            Flash::error('Cuestionario no encontrado');

            return redirect()->route('autoperceptions.index');
        }

        $autoperception = $this->autoperceptionRepository->update($request->all(), $id);


        Flash::success('Cuestionario actualizado correctamente');

        return redirect()->route('autoperceptions.index');
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
        $autoperception = $this->autoperceptionRepository->findWithoutFail($id);

        if (empty($autoperception)) {
            Flash::error('Cuestionario no encontrado');

            return redirect()->route('autoperceptions.index');
        }

        $this->autoperceptionRepository->delete($id);

        Flash::success('Cuestionario eliminado correctamente');

        return redirect()->route('autoperceptions.index');
    }
}
