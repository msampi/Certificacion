<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\AppBaseController;
use App\Http\Requests;
use App\Models\Post;
use App\Http\Requests\CreateCompetitionRequest;
use App\Http\Requests\UpdateCompetitionRequest;
use App\Repositories\CompetitionRepository;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

class CompetitionController extends AdminBaseController
{
    /** @var  CompetitionRepository */
    private $competitionRepository;


    public function __construct(CompetitionRepository $competitionRepo)
    {
        $this->competitionRepository = $competitionRepo;
        parent::__construct();

    }

    /**
     * Display a listing of the Competition.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->competitionRepository->pushCriteria(new RequestCriteria($request));
        $competitions = $this->competitionRepository->all();
        $evaluation = $this->evaRepo->find($request->search);

        return view('admin.competitions.index')->with('competitions', $competitions)
                                               ->with('evaluation', $evaluation);
    }

    /**
     * Show the form for creating a new Competition.
     *
     * @return Response
     */
    public function create(Request $request)
    {
        $post = new Post();
        parent::loadLangScript();
        $languages = $this->languageRepository->all();
        return view('admin.competitions.create')->with('evaluation_id', $request->search)
                                                ->with('posts', $post->listCurrentLang('id', 'name'))
                                                ->with('languages', $languages);
    }

    /**
     * Store a newly created Competition in storage.
     *
     * @param CreateCompetitionRequest $request
     *
     * @return Response
     */
    public function store(CreateCompetitionRequest $request)
    {
        $input = $request->all();

        $competition = $this->competitionRepository->create($input);

        Flash::success($this->dictionary->translate('Competencia guardada correctamente'));

        return redirect()->route('admin.competitions.index','search='.$competition->evaluation_id);
    }

    /**
     * Show the form for editing the specified Competition.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $post = new Post();
        parent::loadLangScript();
        $competition = $this->competitionRepository->findWithoutFail($id);
        $languages = $this->languageRepository->all();
        if (empty($competition)) {
            Flash::error($this->dictionary->translate('Competencia no encontrada'));

            return redirect()->route('admin.competitions.index', 'search='.$competition->evaluation_id);
        }

        return view('admin.competitions.edit')->with('competition', $competition)
                                              ->with('posts', $post->listCurrentLang('id', 'name'))
                                              ->with('evaluation_id', $competition->evaluation_id)
                                              ->with('languages', $languages);
    }

    /**
     * Update the specified Competition in storage.
     *
     * @param  int              $id
     * @param UpdateCompetitionRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateCompetitionRequest $request)
    {
        $competition = $this->competitionRepository->findWithoutFail($id);

        if (empty($competition)) {
            Flash::error($this->dictionary->translate('Competencia no encontrada'));

            return redirect()->route('admin.competitions.index');
        }

        $competition = $this->competitionRepository->update($request->all(), $id);


        Flash::success($this->dictionary->translate('Competencia actualizada correctamente'));

        return redirect()->route('admin.competitions.index', 'search='.$competition->evaluation_id);
    }

    /**
     * Remove the specified Competition from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $competition = $this->competitionRepository->findWithoutFail($id);

        if (empty($competition)) {
            Flash::error($this->dictionary->translate('Competencia no encontrada'));

            return redirect()->route('admin.competitions.index');
        }

        $this->competitionRepository->delete($id);

        Flash::success($this->dictionary->translate('Competencia eliminada correctamente'));

        return redirect()->route('admin.competitions.index','search='.$competition->evaluation_id);
    }
}
