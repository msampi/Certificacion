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
        'subject' => 'array',
        'from' => 'array',
        'message' => 'array'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'subject' => 'required',

    ];


    //where('client_id', Auth::user()->client_id)->orWhere('client_id', '0')->
}
