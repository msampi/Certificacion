<?php

namespace App\Repositories;

use App\Models\ConsultantReview;
use App\Models\CompetencyReview;
use InfyOm\Generator\Common\BaseRepository;
use Session;
class ConsultantReviewRepository extends BaseRepository
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
        return ConsultantReview::class;
    }
    
    public function toObject($string)
    {
        $data = explode('[',$string);
        $competency = new \stdClass();
        $competency->competency_id = explode(']',$data[1])[0];
        $competency->competency_item_id = explode(']',$data[2])[0];
        return $competency;
    }
    
    public function save($request)
    {
        
        $data = $request->get('data');
        $consultantReview = ConsultantReview::firstOrNew([
            'evaluation_id' => Session::get('evaluation_id'),
            'exercise_id'   => $data['exercise_id'],
            'consultant_id' => $data['consultant_id'],
            'competitor_id' => $data['competitor_id']
        ]);
        $consultantReview->consultant_type = $data['consultant_type'];
        
        foreach ($request->get('form') as $form_data)
            if ($form_data['name'] == 'feedback')
                $consultantReview->feedback = $form_data['value'];
        $consultantReview->save();
        
        foreach ($request->get('form') as $form_data)
                if ($form_data['name'] != '' && $form_data['name'] != '_token' && $form_data['name'] != '_wysihtml5_mode' &&  $form_data['name'] != 'feedback' &&  $form_data['name'] != 'feedback_1')
                {
                    $competency = $this->toObject($form_data['name']);
                    $competencyReview = CompetencyReview::firstOrNew([
                        'consultant_review_id' => $consultantReview->id,
                        'competency_id' => $competency->competency_id,
                        'competency_item_id' => $competency->competency_item_id
                    ]);
                    $competencyReview->value = $form_data['value'];
                    $competencyReview->save();
                    
                }
    }
    
    
    
   
}
