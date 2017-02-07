<?php

namespace App\Models;

use Eloquent as Model;

/**
 * Class Competition
 * @package App\Models
 */
class CompetencyReview extends BaseModel
{

    public $fillable = [
        'consultant_review_id',
        'competency_id',
        'competency_item_id',
        'value'
        
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'consultant_review_id' => 'integer',
        'competency_id' => 'integer',
        'competency_item_id' => 'integer',
        'value' => 'integer'
    ];

    

   

    

}
