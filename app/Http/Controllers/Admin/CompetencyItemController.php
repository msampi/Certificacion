<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Requests\CreateBehaviourRequest;
use App\Http\Requests\UpdateBehaviourRequest;
use App\Repositories\BehaviourRepository;
use App\Http\Controllers\AppBaseController as InfyOmBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

class BehaviourController extends InfyOmBaseController
{
    /** @var  BehaviourRepository */
    private $behaviourRepository;

    public function __construct(BehaviourRepository $behaviourRepo)
    {
        $this->behaviourRepository = $behaviourRepo;
    }

    /**
     * Display a listing of the Behaviour.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->behaviourRepository->pushCriteria(new RequestCriteria($request));
        $behaviours = $this->behaviourRepository->all();

        return view('behaviours.index')
            ->with('behaviours', $behaviours);
    }

    /**
     * Show the form for creating a new Behaviour.
     *
     * @return Response
     */
    public function create()
    {
        return view('behaviours.create');
    }

    /**
     * Store a newly created Behaviour in storage.
     *
     * @param CreateBehaviourRequest $request
     *
     * @return Response
     */
    public function store(CreateBehaviourRequest $request)
    {
        $input = $request->all();

        $behaviour = $this->behaviourRepository->create($input);

        Flash::success('Behaviour saved successfully.');

        return redirect(route('behaviours.index'));
    }

    /**
     * Display the specified Behaviour.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $behaviour = $this->behaviourRepository->findWithoutFail($id);

        if (empty($behaviour)) {
            Flash::error('Behaviour not found');

            return redirect(route('behaviours.index'));
        }

        return view('behaviours.show')->with('behaviour', $behaviour);
    }

    /**
     * Show the form for editing the specified Behaviour.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $behaviour = $this->behaviourRepository->findWithoutFail($id);

        if (empty($behaviour)) {
            Flash::error('Behaviour not found');

            return redirect(route('behaviours.index'));
        }

        return view('behaviours.edit')->with('behaviour', $behaviour);
    }

    /**
     * Update the specified Behaviour in storage.
     *
     * @param  int              $id
     * @param UpdateBehaviourRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateBehaviourRequest $request)
    {
        $behaviour = $this->behaviourRepository->findWithoutFail($id);

        if (empty($behaviour)) {
            Flash::error('Behaviour not found');

            return redirect(route('behaviours.index'));
        }

        $behaviour = $this->behaviourRepository->update($request->all(), $id);

        Flash::success('Behaviour updated successfully.');

        return redirect(route('behaviours.index'));
    }

    /**
     * Remove the specified Behaviour from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $behaviour = $this->behaviourRepository->findWithoutFail($id);

        if (empty($behaviour)) {
            Flash::error('Behaviour not found');

            return redirect(route('behaviours.index'));
        }

        $this->behaviourRepository->delete($id);

        Flash::success('Behaviour deleted successfully.');

        return redirect(route('behaviours.index'));
    }
}
