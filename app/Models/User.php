<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Eloquent as Model;
use Crypt;

/**
 * Class User
 * @package App\Models
 */
class User extends Authenticatable
{

    public $table = 'users';

    public $fillable = ['name','last_name','email','password','dni','client_id','code','role_id',
        'image','category','country','city','area','department','register_message_id'];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'name' => 'string',
        'last_name' => 'string',
        'email' => 'string',
        'password' => 'string',
        'dni' => 'string',
        'client_id' => 'integer',
        'code' => 'string',
        'role_id' => 'integer',
        'image' => 'string',
        'category' => 'string',
        'country' => 'string',
        'city' => 'string',
        'area' => 'string',
        'department' => 'string',
    ];


    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
            'name' => 'required',
            'last_name' => 'required',
            'image' => 'image|mimes:jpeg,png'
        ];

    public function client()
    {
        return $this->belongsTo('App\Models\Client');
    }


    public function setPasswordAttribute($value)
    {
        if ($value)
            $this->attributes['password'] = bcrypt($value);
        else
            $this->attributes['password'] = $this->password;

    }

    public function role()
    {
        return $this->belongsTo('App\Models\Role');
    }


    public function getImageAttribute($value)
    {
        if (!$value)
            return 'user.png';
        return $value;
    }

    public function evaluation()
    {
        return $this->hasMany('App\Models\EvaluationUserEvaluator');
    }

    public function getEvaluationById($id)
    {
        foreach ($this->evaluation as $ev) {
            if ($ev->evaluation_id == $id)
                return $ev;
        }
        return NULL;
    }



}
