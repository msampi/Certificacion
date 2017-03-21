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
    
    public function getCorrectOrNot($value){
        
        if (strtolower($value) == 'si')
            return 1;
        return 0;
                    
    }
    
    public function saveFromExcel($row, $client_id)
    {
        if (!$client_id) $client_id = NULL;
        $questionary = $this->model->firstOrNew(['import_id' => $row->id_conocimiento, 'client_id' => $client_id]);
        $questionary->name = $row->nombre;
        $questionary->instructions = $row->instrucciones;
        $questionary->reference = $row->referencia;
        $questionary->save();
    
        $question = Question::firstOrCreate(['questionary_id' => $questionary->id, 
                                             'question' => $row->pregunta]);
        
        if ($row->opcion){
            $questionOption = QuestionOption::firstOrNew(['question_id' => $question->id, 
                                             'option' => $row->opcion]);
            $questionOption->correct = $this->getCorrectOrNot($row->correcta);
            $questionOption->save();
        }
        
        return $questionary;

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
                        $qo->option = $option['option'];
                        $qo->question_id = $q->id;
                        if (isset($option['correct']))
                            $qo->correct = 1;
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
                    $qo->option = $option['option'];
                    $qo->question_id = $q->id;
                    if (isset($option['correct']))
                        $qo->correct = 1;
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
