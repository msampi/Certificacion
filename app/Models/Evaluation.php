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

    public $dates = ['start_year_start', 'start_year_end', 'half_year_start', 'half_year_end', 'end_year_start', 'end_year_end'];



    public $fillable = [
        'name',
        'instructions',
        'client_id',
        'objectives_rating_id',
        'competitions_rating_id',
        'valorations_rating_id',
        'start_year_start',
        'start_year_end',
        'half_year_start',
        'half_year_end',
        'end_year_start',
        'end_year_end',
        'vis_end_year_start',
        'vis_end_year_end',
        'vis_half_year_start',
        'vis_half_year_end',
        'visualization',
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
        'client_id' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'name' => 'required',
        'excel' => 'mimes:xls,xlsx',
        'first_stage' => 'required',
        'second_stage' => 'required',
        'third_stage' => 'required',
        'objectives_rating_id' => 'required',
        'competitions_rating_id' => 'required',
        'valorations_rating_id' => 'required',
    ];

    public function messages()
    {
        return [
            'objectives_rating_id'  => 'El campo Rating Objetivos es obligatorio',
        ];
    }


    public function client()
    {
        return $this->belongsTo('App\Models\Client');
    }

    public function evaluationDate()
    {
        return $this->belongsTo('App\Models\EvaluationDate');
    }

    public function objectivesRating()
    {
        return $this->belongsTo('App\Models\Rating', 'objectives_rating_id', 'id');
    }

    public function competitionsRating()
    {
        return $this->belongsTo('App\Models\Rating', 'competitions_rating_id', 'id');
    }

    public function valorationsRating()
    {
        return $this->belongsTo('App\Models\Rating', 'valorations_rating_id', 'id');
    }

    public function documents()
    {
        return $this->hasMany('App\Models\Document');
    }

    

}
