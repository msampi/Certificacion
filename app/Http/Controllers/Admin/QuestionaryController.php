<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Requests\CreateQuestionaryRequest;
use App\Http\Requests\UpdateQuestionaryRequest;
use App\Repositories\QuestionaryRepository;
use App\Models\Client;
use App\Http\Controllers\AppBaseController as InfyOmBaseController;
use Illuminate\Http\Request;
use App\Models\QuestionaryType;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

class QuestionaryController extends InfyOmBaseController
{
    /** @var  QuestionaryRepository */
    private $questionaryRepository;

    public function __construct(QuestionaryRepository $questionaryRepo)
    {
        $this->questionaryRepository = $questionaryRepo;
    }

    /**
     * Display a listing of the Questionary.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->questionaryRepository->pushCriteria(new RequestCriteria($request));
        $questionaries = $this->questionaryRepository->all();

        return view('admin.questionaries.index')
            ->with('questionaries', $questionaries);
    }

    /**
     * Show the form for creating a new Questionary.
     *
     * @return Response
     */
    public function create()
    {
        return view('admin.questionaries.create')->with('types', QuestionaryType::lists('name','id'))
                                                ->with('clients',Client::lists('name','id')->prepend('Todos',0));
    }

    /**
     * Store a newly created Questionary in storage.
     *
     * @param CreateQuestionaryRequest $request
     *
     * @return Response
     */
    public function store(CreateQuestionaryRequest $request)
    {
        $input = $request->all();

        $questionary = $this->questionaryRepository->create($input);

        Flash::success('Cuestionario guardado correctamente.');

        return redirect(route('questionaries.index'));
    }

    
    /**
     * Show the form for editing the specified Questionary.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $questionary = $this->questionaryRepository->findWithoutFail($id);
        
        if (empty($questionary)) {
            Flash::error('Cuestionario no encontrado');

            return redirect(route('questionaries.index'));
        }

        return view('admin.questionaries.edit')->with('questionary', $questionary)
                                                ->with('types', QuestionaryType::lists('name','id'))
                                                ->with('clients',Client::lists('name','id')->prepend('Todos',0));
    }

    /**
     * Update the specified Questionary in storage.
     *
     * @param  int              $id
     * @param UpdateQuestionaryRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateQuestionaryRequest $request)
    {
        $questionary = $this->questionaryRepository->findWithoutFail($id);

        if (empty($questionary)) {
            Flash::error('Cuestionario no encontrado');

            return redirect(route('questionaries.index'));
        }

        $questionary = $this->questionaryRepository->update($request->all(), $id);

        Flash::success('Cuestionario actualizado correctamente.');

        return redirect(route('questionaries.index'));
    }

    /**
     * Remove the specified Questionary from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $questionary = $this->questionaryRepository->findWithoutFail($id);

        if (empty($questionary)) {
            Flash::error('Cuestionario no encontrado');

            return redirect(route('questionaries.index'));
        }

        $this->questionaryRepository->delete($id);

        Flash::success('Cuestionario eliminado correctamente.');

        return redirect(route('questionaries.index'));
    }
}
