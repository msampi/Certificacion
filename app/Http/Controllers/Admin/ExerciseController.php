<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Requests\CreateExerciseRequest;
use App\Http\Requests\UpdateExerciseRequest;
use App\Repositories\ExerciseRepository;
use App\Http\Controllers\AppBaseController as InfyOmBaseController;
use Illuminate\Http\Request;
use Flash;
use App\Models\ExerciseType;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use App\Models\Client;

class ExerciseController extends AdminController
{
    /** @var  ExerciseRepository */
    private $exerciseRepository;

    public function __construct(ExerciseRepository $exerciseRepo)
    {
        $this->exerciseRepository = $exerciseRepo;
    }

    /**
     * Display a listing of the Exercise.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->exerciseRepository->pushCriteria(new RequestCriteria($request));
        $exercises = $this->exerciseRepository->all();

        return view('admin.exercises.index')
            ->with('exercises', $exercises);
    }

    /**
     * Show the form for creating a new Exercise.
     *
     * @return Response
     */
    public function create()
    {
        return view('admin.exercises.create')
            ->with('exercise_types', ExerciseType::lists('name','id'))
            ->with('clients', Client::lists('name','id')->prepend('Todos',NULL));     
    }

    /**
     * Store a newly created Exercise in storage.
     *
     * @param CreateExerciseRequest $request
     *
     * @return Response
     */
    public function store(CreateExerciseRequest $request)
    {
        $input = $request->all();
        
        $input['pdf_consultant'] = $this->uploadFile($request, 'pdf_consultant');
        $input['pdf_competitor'] = $this->uploadFile($request, 'pdf_competitor');

        $exercise = $this->exerciseRepository->create($input);

        Flash::success('Exercise creado correctamente.');

        return redirect(route('exercises.index'));
    }

   

    /**
     * Show the form for editing the specified Exercise.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $exercise = $this->exerciseRepository->findWithoutFail($id);

        if (empty($exercise)) {
            Flash::error('Ejercicio no encontrado.');

            return redirect(route('exercises.index'));
        }

        return view('admin.exercises.edit')->with('exercise', $exercise)
                                          ->with('exercise_types', ExerciseType::lists('name','id'))
                                          ->with('clients', Client::lists('name','id')->prepend('Todos',NULL));
    }

    /**
     * Update the specified Exercise in storage.
     *
     * @param  int              $id
     * @param UpdateExerciseRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateExerciseRequest $request)
    {
        $exercise = $this->exerciseRepository->findWithoutFail($id);
        
        $input = $request->all();
        
        $input['pdf_consultant'] = $this->uploadFile($request, 'pdf_consultant');
        $input['pdf_competitor'] = $this->uploadFile($request, 'pdf_competitor');

        if (empty($exercise)) {
            Flash::error('Ejercicio no encontrado.');

            return redirect(route('exercises.index'));
        }

        $exercise = $this->exerciseRepository->update($input, $id);

        Flash::success('Ejercicio actualizado correctamente.');

        return redirect(route('exercises.index'));
    }

    /**
     * Remove the specified Exercise from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $exercise = $this->exerciseRepository->findWithoutFail($id);

        if (empty($exercise)) {
            Flash::error('Ejercicio no encontrado.');

            return redirect(route('exercises.index'));
        }

        $this->exerciseRepository->delete($id);

        Flash::success('Ejercicio eliminado correctamente.');

        return redirect(route('exercises.index'));
    }
}
