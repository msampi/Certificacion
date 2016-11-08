<?php

namespace App\Models;

use Eloquent as Model;

/**
 * Class Exercise
 * @package App\Models
 */
class Exercise extends Model
{

    public $table = 'exercises';
    


    public $fillable = [
        'name',
        'instructions',
        'competitor_pdf',
        'consultant_pdf',
        'exercise_type_id',
        'client_id'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'name' => 'text',
        'instructions' => 'string',
        'competitor_pdf' => 'string',
        'consultant_pdf' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'name' => 'required'
        /*'competitor_pdf' => 'mimes:application/pdf',
        'cosultant_pdf' => 'mimes:application/pdf',*/
    ];
    
    public function type()
    {
        return $this->belongsTo('App\Models\ExerciseType','exercise_type_id');
    }
}
