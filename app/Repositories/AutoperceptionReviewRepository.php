<?php

namespace App\Repositories;

use App\Models\AutoperceptionReview;
use Auth;
use Session;

use InfyOm\Generator\Common\BaseRepository;

class AutoperceptionReviewRepository extends AdminBaseRepository
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
        return AutoperceptionReview::class;
    }
    
    public function isChecked($autoperception_item_id, $competitor_id, $exercise_id, $value)
    {
        $ar = AutoperceptionReview::where('autoperception_item_id', $autoperception_item_id)
                                  ->where('competitor_id', $competitor_id)
                                  ->where('exercise_id', $exercise_id)
                                  ->where('value', $value)
                                  ->where('evaluation_id', Session::get('evaluation_id'))->first();
        if ($ar)
            return true;
        return false;
    }

    
    public function toValue($string)
    {
        $response = explode('[',$string);
        $response = explode(']',$response[1])[0];
        return $response;
    }
    
    public function save($request)
    {
        $exercise_id = $request->get('exercise_id');
        foreach($request->get('form') as $form)
        {
            if ($form['name'] != '_token')
            {
                $autoperceptionReview = AutoperceptionReview::firstOrNew([
                    'autoperception_item_id' => $this->toValue($form['name']),
                    'competitor_id' => Auth::user()->id,
                    'exercise_id' => $exercise_id,
                    'evaluation_id' => Session::get('evaluation_id')
                ]);
                $autoperceptionReview->value = $form['value'];
                $autoperceptionReview->save();
                    
            }
        }
    }
}
