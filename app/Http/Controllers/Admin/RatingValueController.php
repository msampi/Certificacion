<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\AppBaseController;
use App\Http\Requests;
use App\Http\Requests\CreateValueRequest;
use App\Http\Requests\UpdateValueRequest;
use App\Repositories\ValueRepository;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

class ValueController extends AppBaseController
{
    /** @var  ValueRepository */
    private $valueRepository;

    public function __construct(ValueRepository $valueRepo)
    {
        $this->valueRepository = $valueRepo;
    }

    /**
     * Display a listing of the Value.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->valueRepository->pushCriteria(new RequestCriteria($request));
        $values = $this->valueRepository->all();

        return view('admin.values.index')
            ->with('values', $values);
    }

    /**
     * Show the form for creating a new Value.
     *
     * @return Response
     */
    public function create()
    {
        return view('admin.values.create');
    }

    /**
     * Store a newly created Value in storage.
     *
     * @param CreateValueRequest $request
     *
     * @return Response
     */
    public function store(CreateValueRequest $request)
    {
        $input = $request->all();

        $value = $this->valueRepository->create($input);

        Flash::success('Value saved successfully.');

        return redirect(route('values.index'));
    }

    /**
     * Show the form for editing the specified Value.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $value = $this->valueRepository->findWithoutFail($id);

        if (empty($value)) {
            Flash::error('Value not found');

            return redirect(route('values.index'));
        }

        return view('admin.values.edit')->with('value', $value);
    }

    /**
     * Update the specified Value in storage.
     *
     * @param  int              $id
     * @param UpdateValueRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateValueRequest $request)
    {
        $value = $this->valueRepository->findWithoutFail($id);

        if (empty($value)) {
            Flash::error('Value not found');

            return redirect(route('values.index'));
        }

        $value = $this->valueRepository->update($request->all(), $id);

        Flash::success('Value updated successfully.');

        return redirect(route('values.index'));
    }

    /**
     * Remove the specified Value from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $value = $this->valueRepository->findWithoutFail($id);

        if (empty($value)) {
            Flash::error('Value not found');

            return redirect(route('values.index'));
        }

        $this->valueRepository->delete($id);

        Flash::success('Value deleted successfully.');

        return redirect(route('values.index'));
    }

    /**
     * Remove the specified Value from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function delete($id)
    {
        $value = $this->valueRepository->findWithoutFail($id);
        $this->valueRepository->delete($id);

    }
}
