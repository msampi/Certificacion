<?php

namespace App\Repositories;

use App\Models\Evaluation;
use App\Models\EvaluationExercise;
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
        'id'
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
    
    
    public function create(array $input)
    {

        $evaluation = parent::create($input);
        $order = 1;
        if (isset($input['exercise']))
            foreach ($input['exercise'] as $key => $exercise) {
                $e = EvaluationExercise::firstOrNew(['id' => $exercise['id']]);
                $e->evaluation_id = $evaluation->id;
                $e->exercise_id = $exercise['exercise_id'];
                if ($exercise['from'] && $exercise['from_hour'])
                    $e->date_from = Carbon::createFromFormat('d/m/Y H:i:s', $exercise['from'].' '.$exercise['from_hour'].':00')->toDateString();
                if ($exercise['to'] && $exercise['to_hour'])
                    $e->date_to = Carbon::createFromFormat('d/m/Y H:i:s', $exercise['to'].' '.$exercise['to_hour'].':00')->toDateString();
                $e->number = $key;
                $e->save();
                $order++;
            }
        return $evaluation;

    }
    
    public function update(array $input, $id)
    {

        $evaluation = parent::update($input, $id);
        $order = 1;
        if (isset($input['exercise'])) :
            foreach ($input['exercise'] as $key => $exercise) {
                $e = EvaluationExercise::firstOrNew(['id' => $exercise['id']]);
                $e->evaluation_id = $evaluation->id;
                $e->exercise_id = $exercise['exercise_id'];
                if ($exercise['from'] && $exercise['from_hour'])
                    $e->date_from = Carbon::createFromFormat('d/m/Y H:i:s', $exercise['from'].' '.$exercise['from_hour'].':00')->toDateString();
                if ($exercise['to'] && $exercise['to_hour'])
                    $e->date_to = Carbon::createFromFormat('d/m/Y H:i:s', $exercise['to'].' '.$exercise['to_hour'].':00')->toDateString();
                $e->number = $order;
               
                $e->save();
                $order++;
            }

            $deleteInput = explode(',',$input['remove-item-list']);
            foreach ($deleteInput as $value) 
                if ($value)
                    EvaluationExercise::where('id',$value)->delete();
        endif;
        

        return $evaluation;
    }




}
