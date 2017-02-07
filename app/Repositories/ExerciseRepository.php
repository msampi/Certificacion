<?php

namespace App\Repositories;

use App\Models\Exercise;
use App\Models\ExerciseCompetency;
use App\Models\ExerciseQuestionary;
use App\Models\ExerciseAutoperception;
use InfyOm\Generator\Common\BaseRepository;

class ExerciseRepository extends AdminBaseRepository
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
        return Exercise::class;
    }
    
    public function create(array $input)
    {

        $exercise = parent::create($input);
        $number = 1;
        if (isset($input['competency']))
            foreach ($input['competency'] as $key => $competency) {
                $e = ExerciseCompetency::firstOrNew(['id' => $competency['id']]);
                $e->exercise_id = $exercise->id;
                $e->competency_group_id = $competency['competency_id'];
                $e->number = $number;
                $e->save();
                $number++;
            }
        $number = 1;
        if (isset($input['questionary']))
            foreach ($input['questionary'] as $key => $questionary) {
                $e = ExerciseQuestionary::firstOrNew(['id' => $questionary['id']]);
                $e->exercise_id = $exercise->id;
                $e->questionary_id = $questionary['questionary_id'];
                $e->number = $number;
                $e->save();
                $number++;
            }
        $number = 1;
        if (isset($input['autoperception']))
            foreach ($input['autoperception'] as $key => $autoperception) {
                $e = ExerciseAutoperception::firstOrNew(['id' => $autoperception['id']]);
                $e->exercise_id = $exercise->id;
                $e->autoperception_id = $autoperception['autoperception_id'];
                $e->number = $number;
                $e->save();
                $number++;
            }
        return $exercise;

    }
    
    public function update(array $input, $id)
    {

        $exercise = parent::update($input, $id);
        $number = 1;
        if (isset($input['competency'])) :
            
            foreach ($input['competency'] as $key => $competency) {
                $e = ExerciseCompetency::firstOrNew(['id' => $competency['id']]);
                $e->exercise_id = $exercise->id;
                $e->competency_group_id = $competency['competency_id'];
                $e->number = $number;
                $e->save();
                $number++;
            }

            $deleteInput = explode(',',$input['remove-item-list']);
            foreach ($deleteInput as $value) 
                if ($value)
                    ExerciseCompetency::where('id',$value)->delete();
        endif;
        $number = 1;
        if (isset($input['questionary'])) :
            
            foreach ($input['questionary'] as $key => $questionary) {
                $e = ExerciseQuestionary::firstOrNew(['id' => $questionary['id']]);
                $e->exercise_id = $exercise->id;
                $e->questionary_id = $questionary['questionary_id'];
                $e->number = $number;
                $e->save();
                $number++;
            }

            $deleteInput = explode(',',$input['remove-question-list']);
            foreach ($deleteInput as $value) 
                if ($value)
                    ExerciseQuestionary::where('id',$value)->delete();
        endif;
        $number = 1;
        if (isset($input['autoperception'])) :
            
            foreach ($input['autoperception'] as $key => $autoperception) {
                $e = ExerciseAutoperception::firstOrNew(['id' => $autoperception['id']]);
                $e->exercise_id = $exercise->id;
                $e->autoperception_id = $autoperception['autoperception_id'];
                $e->number = $number;
                $e->save();
                $number++;
            }

            $deleteInput = explode(',',$input['remove-autoperception-list']);
            foreach ($deleteInput as $value) 
                if ($value)
                    ExerciseAutoperception::where('id',$value)->delete();
        endif;
        

        return $exercise;
    }
}
