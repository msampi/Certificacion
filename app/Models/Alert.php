<?php

namespace App\Models;

use Eloquent as Model;
use Auth;

/**
 * Class Alert
 * @package App\Models
 */
class Alert extends BaseModel
{

    public $table = 'alerts';

    public $fillable = [
        'name',
        'description',
        'evaluation_id',
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'name' => 'array',
        'description' => 'array',
        'evaluation_id' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        
    ];

    public function evaluation()
    {
        return $this->belongsTo('App\Models\Evaluation');
    }


}
