<?php

namespace App\Repositories;

use App\Models\Evaluation;
use App\Criteria\EqualCriteria;
use InfyOm\Generator\Common\BaseRepository;
use Session;
use Carbon\Carbon;
use Auth;

class EvaluationRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Evaluation::class;
    }


    /**
     * Gets the evaluation count.
     *
     * @return     <type>  The evaluation count.
     */
    public function getEvaluationCount() {
        return $this->all()->count();
    }

    public function getObjectivesRating() {
        return $this->model->where('id', Session::get('evaluation_id'))->first()->objectivesRating;
    }

    public function getCompetitionsRating() {
        return $this->model->where('id', Session::get('evaluation_id'))->first()->competitionsRating;
    }

    public function getValorationsRating() {
        return $this->model->where('id', Session::get('evaluation_id'))->first()->valorationsRating;
    }


    public function getCurrentStage()
    {

        $evaluation = $this->model->where('id',Session::get('evaluation_id'))->first();

        $now = Carbon::now();

        if ($evaluation->start_year_end->gt($now))
            return 1;
        else
        if ($evaluation->half_year_end->gt($now))
            return 2;
        else
            return 3;

        return 2;


    }

    public function getEvaluationsList($client = NULL)
    {
      if (!$client)
        $evaluations = $this->all();
      else
        $evaluations = $this->findWhere(['client_id' => $client->id]);


      $result = array();
      foreach ($evaluations as $evaluation) {
          $result[$evaluation->id] = $evaluation->name;

      }

      return $result;
    }

    public function userVisibility()
    {
      $this->pushCriteria(new EqualCriteria('id',Session::get('evaluation_id')));
      $evaluation = $this->first();

      $now = Carbon::now();
      $current_stage = $this->getCurrentStage();

      if (!$evaluation->visualization)
        return false;
      if ($current_stage == 1)
        return false;
      if ($current_stage == 2)
          if ($evaluation->vis_half_year_start->lt($now) && $evaluation->vis_half_year_end->gt($now))
            return true;
          else
            return false;
      if ($current_stage == 3)
          if ($evaluation->vis_end_year_start->lt($now) && $evaluation->vis_end_year_end->gt($now))
            return true;
          else
            return false;

      return false;

    }


}
