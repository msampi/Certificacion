<?php

namespace App\Models;

use Eloquent as Model;

/**
 * Class Competition
 * @package App\Models
 */
class AutoperceptionReview extends BaseModel
{

    public $fillable = [
        'autoperception_item_id',
        'competitor_id',
        'exercise_id',
        'evaluation_id',
        'value'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'autoperception_item_id' => 'integer',
        'competitor_id' => 'integer',
        'exercise_id' => 'integer',
        'evaluation_id' => 'integer',
        'value' => 'integer'
    ];


}
