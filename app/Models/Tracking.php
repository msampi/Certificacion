<?php

namespace App\Models;

use Eloquent as Model;

/**
 * Class Tracking
 * @package App\Models
 */
class Tracking extends Model
{

    public $table = 'trackings';



    public $fillable = [
        'user_id',
        'evaluation_id',
        'client_id'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [

    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [

    ];

    public function user(){
        return $this->belongsTo('App\Models\User');
    }
    public function evaluation(){
        return $this->belongsTo('App\Models\Evaluation');
    }

    public function actions(){
        return $this->hasMany('App\Models\TrackingAction');
    }
}
