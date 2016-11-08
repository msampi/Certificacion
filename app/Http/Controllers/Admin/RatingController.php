<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\AppBaseController;
use App\Http\Requests;
use App\Http\Requests\CreateRatingRequest;
use App\Http\Requests\UpdateRatingRequest;
use App\Repositories\RatingRepository;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;



class RatingController extends AdminController
{
    private $ratingRepository;

    public function __construct( RatingRepository $rating )
    {
        $this->ratingRepository = $rating;
    }

    /**
     * Display a listing of the Rating.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request, RatingRepository $ratingRepository)
    {
        $ratingRepository->pushCriteria(new RequestCriteria($request));
        $ratings = $ratingRepository->all();

        return view('admin.ratings.index')->with('ratings', $ratings);
    }

    /**
     * Show the form for creating a new Rating.
     *
     * @return Response
     */
    public function create()
    {
        return view('admin.ratings.create');
    }

    /**
     * Store a newly created Rating in storage.
     *
     * @param CreateRatingRequest $request
     *
     * @return Response
     */
    public function store(CreateRatingRequest $request, RatingRepository $ratingRepository)
    {
        $input = $request->all();

        $rating = $ratingRepository->create($input);

        Flash::success('Rating guardado correctamente');

        return redirect()->route('ratings.index');
    }

    /**
     * Show the form for editing the specified Rating.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id, RatingRepository $ratingRepository)
    {
        $rating = $ratingRepository->findWithoutFail($id);
        
       
        if (empty($rating)) {
            Flash::error('Rating no encontrado');

            return redirect()->route('ratings.index');
        }

        return view('admin.ratings.edit')->with('rating', $rating);
    }

    /**
     * Update the specified Rating in storage.
     *
     * @param  int              $id
     * @param UpdateRatingRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateRatingRequest $request, RatingRepository $ratingRepository)
    {
        $rating = $ratingRepository->findWithoutFail($id);

        if (empty($rating)) {
            Flash::error('Rating no encontrado');

            return redirect()->route('ratings.index');
        }

        $rating = $ratingRepository->update($request->all(), $id);

        Flash::success('Rating actualizado correctamente');

        return redirect()->route('ratings.index');
    }

    /**
     * Remove the specified Rating from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id, RatingRepository $ratingRepository)
    {
        $rating = $ratingRepository->findWithoutFail($id);

        if (empty($rating)) {
            Flash::error('Rating no encontrado');

            return redirect()->route('ratings.index');
        }

        $ratingRepository->delete($id);

        Flash::success('Rating eliminado correctamente');

        return redirect()->route('ratings.index');
    }
}
