<?php

namespace App\Repositories;

use App\Models\Competition;
use App\Models\Behaviour;

use InfyOm\Generator\Common\BaseRepository;

class CompetencyRepository extends AdminBaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'evaluation_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Competition::class;
    }

    public function saveFromExcel($row, $evaluation_id, $post_id, $lang)
    {

        $competition = $this->model->firstOrCreate(['import_id' => $row->id_competencia, 'evaluation_id' => $evaluation_id,'post_id' => $post_id]);
        $competition->import_id = $row->id_competencia;
        $competition->weight = $row->peso.'%';
        $competition->description = $this->saveArrayField($competition->description, $lang, $row->descripcion);
        $competition->name = $this->saveArrayField($competition->name, $lang, $row->competencia);
        $competition->post_id = $post_id;
        $competition->evaluation_id = $evaluation_id;
        $competition->save();
        return $competition;

    }

    public function create(array $input)
    {

        $competition = parent::create($input);

        if (isset($input['behaviours']))
            foreach ($input['behaviours'] as $value) {
                $behaviour = new Behaviour();
                $behaviour->competition_id = $competition->id;
                $behaviour->description = $value;
                $behaviour->save();
            }
        return $competition;

    }

    public function update(array $input, $id)
    {

        $competition = parent::update($input, $id);

        if (isset($input['behaviours']))
            foreach ($input['behaviours'] as $key => $value) {
                $behaviour = Behaviour::firstOrNew(['id' => $key]);
                $behaviour->competition_id = $competition->id;
                $behaviour->description = $value;
                $behaviour->save();
            }

        $deleteInput = explode(',',$input['remove-item-list']);
        foreach ($deleteInput as $value) {
            if ($value)
                Behaviour::where('id',$value)->delete();
        }

        return $competition;
    }
}
