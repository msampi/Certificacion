<?php

namespace App\Models;

use Eloquent as Model;

/**
 * Class Behaviour
 * @package App\Models
 */
class CompetencyItem extends BaseModel
{

    public $fillable = [
        'description',
        'competition_id',
        'number',
        'import_id'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'description' => 'array',
        'competition_id' => 'integer',
        'number' => 'integer',
        'import_id' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [

    ];

    public function behaviourRatings()
    {
        return $this->hasMany('App\Models\BehaviourRating');
    }

    public function getBehaviourRating($stage, $entry, $user_id)
    {
        foreach ($this->behaviourRatings as $bh) {
            if ($bh->stage == $stage && $bh->entry == $entry && $bh->user_id == $user_id)
                return $bh;
        }
        return new BehaviourRating();
    }

}
