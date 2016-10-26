<?php

namespace App\Models;
use App\Models\CompetitionComment;

use Eloquent as Model;

/**
 * Class Competition
 * @package App\Models
 */
class Competency extends BaseModel
{

    public $fillable = [
        'name',
        'post_id',
        'evaluation_id',
        'description',
        'weight'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'name' => 'array',
        'description' => 'array',
        'weight' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'name' => 'required'
    ];

    public function behaviours()
    {
        return $this->hasMany('App\Models\Behaviour');
    }

    public function comments()
    {
        return $this->hasMany('App\Models\CompetitionComment');
    }

    public function getComment($stage, $entry, $user_id)
    {
        foreach ($this->comments as $comment) {

            if ($comment->entry == $entry && $comment->stage == $stage && $comment->user_id == $user_id)
                return $comment;
        }
        return new CompetitionComment();
    }

    public function post()
    {
        return $this->belongsTo('App\Models\Post');
    }

}
