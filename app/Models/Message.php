<?php

namespace App\Models;

use Eloquent as Model;

/**
 * Class Message
 * @package App\Models
 */
class Message extends BaseModel
{

    public $table = 'messages';



    public $fillable = [
        'subject',
        'from',
        'message',
        'client_id'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'subject' => 'string',
        'from' => 'string',
        'message' => 'text'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'subject' => 'required',

    ];
    
    public function setClientIdAttribute($value)
    {
        $this->attributes['client_id'] = $value ?: null;
    }


    
}
