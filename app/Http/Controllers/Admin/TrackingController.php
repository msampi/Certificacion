<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Requests\CreateTrackingRequest;
use App\Criteria\ClientCriteria;
use App\Http\Requests\UpdateTrackingRequest;
use App\Repositories\TrackingRepository;
use App\Http\Controllers\AppBaseController as InfyOmBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

class TrackingController extends AdminBaseController
{
    /** @var  TrackingRepository */
    private $trackingRepository;


    public function __construct(TrackingRepository $trackingRepo)
    {
        parent::__construct();

        $this->trackingRepository = $trackingRepo;
    }

    /**
     * Display a listing of the Tracking.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->trackingRepository->pushCriteria(new ClientCriteria($this->superadmin));
        $trackings = $this->trackingRepository->all();

        return view('admin.trackings.index')
            ->with('trackings', $trackings);
    }

    /**
     * Store a newly created Tracking in storage.
     *
     * @param CreateTrackingRequest $request
     *
     * @return Response
     */
    public function store(CreateTrackingRequest $request)
    {
        $input = $request->all();

        $tracking = $this->trackingRepository->create($input);

        Flash::success('Tracking saved successfully.');

        return redirect(route('admin.trackings.index'));
    }

    /**
     * Display the specified Tracking.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $tracking = $this->trackingRepository->findWithoutFail($id);

        if (empty($tracking)) {
            Flash::error('Tracking not found');

            return redirect(route('admin.trackings.index'));
        }

        return view('admin.trackings.show')->with('tracking', $tracking);
    }



    /**
     * Update the specified Tracking in storage.
     *
     * @param  int              $id
     * @param UpdateTrackingRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateTrackingRequest $request)
    {
        $tracking = $this->trackingRepository->findWithoutFail($id);

        if (empty($tracking)) {
            Flash::error('Tracking not found');

            return redirect(route('admin.trackings.index'));
        }

        $tracking = $this->trackingRepository->update($request->all(), $id);

        Flash::success('Tracking updated successfully.');

        return redirect(route('admin.trackings.index'));
    }

    /**
     * Remove the specified Tracking from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $tracking = $this->trackingRepository->findWithoutFail($id);

        if (empty($tracking)) {
            Flash::error('Tracking not found');

            return redirect(route('admin.trackings.index'));
        }

        $this->trackingRepository->delete($id);

        Flash::success('Tracking deleted successfully.');

        return redirect(route('admin.trackings.index'));
    }
}
