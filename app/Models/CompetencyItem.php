<?php

namespace App\Models;

use Eloquent as Model;

/**
 * Class Behaviour
 * @package App\Models
 */
class CompetencyItem extends BaseModel
{

    public $fillable = [
        'positive',
        'negative',
        'competency_id',
        
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'competency_id' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [

    ];

    

}
