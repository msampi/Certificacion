<?php

namespace App\Repositories;

use App\Models\Rating;
use App\Models\Value;
use InfyOm\Generator\Common\BaseRepository;

class RatingRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Rating::class;
    }

    /**
     * Gets the rating count.
     *
     * @return     <type>  The rating count.
     */
    public function getRatingCount() {
        return $this->all()->count();
    }    


    public function create(array $input)
    {

        $rating = parent::create($input);

        if (isset($input['values']))
            foreach ($input['values'] as $v) {
                $value = new Value();
                $value->rating_id = $rating->id;
                $value->value = $v;
                $value->save();
            }
        return $rating;

    }

    public function update(array $input, $id)
    {

        $rating = parent::update($input, $id);
       
        if (isset($input['values']))
            foreach ($input['values'] as $key => $v) {
                $value = Value::firstOrNew(['id' => $key]);
                $value->rating_id = $rating->id;
                $value->value = $v;
                $value->save();
            }

        $deleteInput = explode(',',$input['remove-item-list']);
        foreach ($deleteInput as $value) {
            if ($value)
                Value::where('id',$value)->delete();
        }

        return $rating;
    }
}
