<?php

namespace App\Repositories;

use App\Models\QuestionReview;
use Auth;
use Session;

use InfyOm\Generator\Common\BaseRepository;

class QuestionReviewRepository extends AdminBaseRepository
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
        return QuestionReview::class;
    }
    
    public function isOptionChecked($question_id, $competitor_id, $exercise_id, $question_option_id, $value)
    {
        $ar = QuestionReview::where('question_id', $question_id)
                                  ->where('competitor_id', $competitor_id)
                                  ->where('exercise_id', $exercise_id)
                                  ->where('value', $value)
                                  ->where('question_option_id', $question_option_id)
                                  ->where('evaluation_id', Session::get('evaluation_id'))->first();
        if ($ar)
            return true;
        return false;
    }
    
    public function getAnswer($question_id, $competitor_id, $exercise_id)
    {
        $ar = QuestionReview::where('question_id', $question_id)
                                  ->where('competitor_id', $competitor_id)
                                  ->where('exercise_id', $exercise_id)
                                  ->where('evaluation_id', Session::get('evaluation_id'))->first();
        if ($ar)
            return $ar->value;
        return false;
    }

    
    public function getQuestionID($string)
    {
        $response = explode('[',$string);
        $response = explode(']',$response[1])[0];
        return $response;
    }
    
    public function getQuestionOptionID($string)
    {
        $response = explode('[',$string);
        $response = explode(']',$response[2])[0];
        if (!$response)
            return NULL;
        return $response;
    }
    
    public function save($request)
    {
        $checked = array();
        $exercise_id = $request->get('exercise_id');
        
        foreach($request->get('form') as $form)
        {
            if ($form['name'] != '_token')
            {
                $question_option_id = $this->getQuestionOptionID($form['name']);
                if ($question_option_id)
                    $questionReview = QuestionReview::firstOrNew([
                        'question_id' => $this->getQuestionID($form['name']),
                        'competitor_id' => Auth::user()->id,
                        'exercise_id' => $exercise_id,
                        'question_option_id' => $question_option_id,
                        'evaluation_id' => Session::get('evaluation_id')
                    ]);
                else
                    $questionReview = QuestionReview::firstOrNew([
                        'question_id' => $this->getQuestionID($form['name']),
                        'competitor_id' => Auth::user()->id,
                        'exercise_id' => $exercise_id,
                        'evaluation_id' => Session::get('evaluation_id')
                    ]);
                $checked[] = $questionReview->id;    
                $questionReview->question_option_id = $question_option_id;
                $questionReview->value = $form['value'];
                $questionReview->save();
                    
            }
        }
        
        QuestionReview::whereNotIn('id', $checked)->delete();
        
    }
}
