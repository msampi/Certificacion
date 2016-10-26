<?php

namespace App\Repositories;
use App\Models\Post;
use Auth;

use InfyOm\Generator\Common\BaseRepository;

class AdminBaseRepository extends BaseRepository
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
        return Document::class;
    }

    public function saveNewPost(array $input)
    {
        if (!empty($input['new_post'])) :

            $post = new Post();
            $post->name = [Auth::user()->language_id => $input['new_post']];
            $post->save();
            return $post->id;

        else:
            return false;
        endif;
    }

    public function create(array $input)
    {
        if ($new_post_id = $this->saveNewPost($input))
            $input['post_id'] = $new_post_id;

        return parent::create($input);
    }


    public function update(array $input, $id)
    {
        if ($new_post_id = $this->saveNewPost($input))
            $input['post_id'] = $new_post_id;

        return parent::update($input, $id);

    }
    public function unicodeEscape($word)
    {
        $word = str_replace('á','\u00e1', $word);
        $word = str_replace('é','\u00e9', $word);
        $word = str_replace('í','\u00ed', $word);
        $word = str_replace('ó','\u00f3', $word);
        $word = str_replace('ú','\u00fa', $word);
        $word = str_replace('Á','\u00c1', $word);
        $word = str_replace('É','\u00c9', $word);
        $word = str_replace('Í','\u00cd', $word);
        $word = str_replace('Ó','\u00d3', $word);
        $word = str_replace('Ú','\u00da', $word);
        $word = str_replace('ñ','\u00f1', $word);
        $word = str_replace('Ñ','\u00d1', $word);
        return $word;
    }


    public function saveArrayField($array_field,$index, $value)
    {
        if ($array_field)
            $array_field[$index] = $value;
        else
            $array_field = [$index => $value];

        return $array_field;

    }



}
