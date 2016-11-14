<?php

namespace App\Repositories;

use App\Models\Questionary;
use App\Models\Question;
use App\Models\QuestionOption;
use InfyOm\Generator\Common\BaseRepository;

class QuestionaryRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Questionary::class;
    }
    
    
    public function create(array $input)
    {

        $questionary = parent::create($input);
        if (isset($input['question']))
            foreach ($input['question'] as $key => $question) {
                
                $q = Question::firstOrNew(['id' => $key]);
                $q->question = $question['question'];
                $q->questionary_id = $questionary->id;
                $q->save();
                if (isset($question['option']))
                    foreach($question['option'] as $key => $option) :

                        $qo = QuestionOption::firstOrNew(['id' => $key]);
                        $qo->option = $option;
                        $qo->question_id = $q->id;
                        $qo->save();

                    endforeach;
                
                
            }
        return $questionary;

    }
    
    public function update(array $input, $id)
    {

        $questionary = parent::update($input, $id);
        if (isset($input['question']))
            foreach ($input['question'] as $key => $question) {
                
                $q = Question::firstOrNew(['id' => $key]);
                $q->question = $question['question'];
                $q->questionary_id = $questionary->id;
                $q->save();
                if (isset($question['option'])) 
                foreach($question['option'] as $key => $option) :
                
                    $qo = QuestionOption::firstOrNew(['id' => $key]);
                    $qo->option = $option;
                    $qo->question_id = $q->id;
                    $qo->save();
                
                endforeach;
                
                $deleteInput = explode(',',$input['remove-item-list']);
                foreach ($deleteInput as $value) 
                    if ($value)
                        Question::where('id',$value)->delete();
                $deleteInput = explode(',',$input['remove-option-list']);
                foreach ($deleteInput as $value) 
                    if ($value)
                        QuestionOption::where('id',$value)->delete();
                
            }
        return $questionary;
        
    
    }
}
