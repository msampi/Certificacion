<?php

namespace App\Models;

use Eloquent as Model;

/**
 * Class Evaluation
 * @package App\Models
 */
class Evaluation extends BaseModel
{

    public $table = 'evaluations';

    public $dates = [];



    public $fillable = [
        'name',
        'instructions',
        'client_id',
        'rating_id',
        'welcome_message_id',
        'register_message_id',
        'recovery_message_id'

    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'name' => 'string',
        'instructions' => 'string',
        'client_id' => 'integer',
        'welcome_message_id' => 'integer',
        'register_message_id' => 'integer',
        'recovery_message_id' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'name' => 'required',
        'excel' => 'mimes:xls,xlsx',
        'rating_id' => 'required',
    ];

   

    public function client()
    {
        return $this->belongsTo('App\Models\Client');
    }


    public function rating()
    {
        return $this->belongsTo('App\Models\Rating');
    }
    
    public function exercises()
    {
        return $this->hasMany('App\Models\EvaluationExercise')->orderBy('number');
        
    }
    
    public function documents()
    {
        return $this->hasMany('App\Models\Document')->orderBy('name');
        
    }
    
    public function hasEcaseExercise()
    {
        foreach ($this->exercises as $exercise)
            if ($exercise->exercise_type_id == 5)
                return $exercise;
        return false;
    }

   

    

}
