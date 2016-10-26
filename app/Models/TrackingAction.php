<?php

namespace App\Models;

use Eloquent as Model;

/**
 * Class Tracking
 * @package App\Models
 */
class TrackingAction extends BaseModel
{

    public $table = 'tracking_actions';



    public $fillable = [
        'tracking_id',
        'browser',
        'country',
        'ip',
        'action',
        'stage'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'tracking_id' => 'integer',
        'browser' => 'string',
        'country'=> 'string',
        'ip' => 'string',
        'action' => 'array',
        'stage' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [

    ];
}
