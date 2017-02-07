<?php

namespace App\Models;

use Eloquent as Model;

/**
 * Class Competition
 * @package App\Models
 */
class ConsultantReview extends BaseModel
{

    public $fillable = [
        'evaluation_id',
        'exercise_id',
        'consultant_id',
        'competitor_id',
        'consultant_type'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'evaluation_id' => 'integer',
        'exercise_id' => 'integer',
        'consultant_id' => 'integer',
        'competitor_id' => 'integer',
        'consultant_type' => 'integer'
    ];
    
    public function competencyReviews()
    {
        return $this->hasMany('App\Models\CompetencyReview');
    }
    
    public function isChecked($competency_id, $item_id, $value)
    {
        foreach ($this->competencyReviews as $cr)
            if ($cr->competency_id == $competency_id && $cr->competency_item_id == $item_id && $cr->value == $value)
                return true;
        return false;
    }

    
   

    

}
