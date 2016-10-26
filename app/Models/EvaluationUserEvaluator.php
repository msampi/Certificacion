<?php

namespace App\Models;


use Eloquent as Model;

/**
 * Class EvaluationUserEvaluator
 * @package App\Models
 */
class EvaluationUserEvaluator extends BaseModel
{

    public $table = 'evaluation_user_evaluators';



    public $fillable = [
        'evaluation_id',
        'evaluator_id',
        'user_id',
        'post_id',
        'category'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'evaluation_id' => 'integer',
        'evaluator_id' => 'integer',
        'user_id' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [

    ];


    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function post()
    {
        return $this->belongsTo('App\Models\Post');
    }

    public function evaluator()
    {
        return $this->belongsTo('App\Models\User','evaluator_id');
    }

    public function childrenEUA()
    {
        return $this->hasMany($this, 'evaluator_id', 'user_id');
    }

    public function allChildrenEUA()
    {
        return $this->childrenEUA()->with('allChildrenEUA');
    }




}
