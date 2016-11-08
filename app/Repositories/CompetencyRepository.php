<?php

namespace App\Repositories;

use App\Models\Competency;
use App\Models\CompetencyItem;

use InfyOm\Generator\Common\BaseRepository;

class CompetencyRepository extends AdminBaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
       
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Competency::class;
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

        $competency = parent::create($input);

        if (isset($input['items']))
            foreach ($input['items'] as $value) {
                $item = new CompetencyItem();
                $item->competency_id = $competency->id;
                $item->positive = $value['positivo'];
                $item->negative = $value['negativo'];
                $item->save();
            }
        return $competency;

    }

    public function update(array $input, $id)
    {

        $competency = parent::update($input, $id);

        if (isset($input['items']))
            foreach ($input['items'] as $key => $value) {
                $item = CompetencyItem::firstOrNew(['id' => $key]);
                $item->competency_id = $competency->id;
                $item->positive = $value['positivo'];
                $item->negative = $value['negativo'];
                $item->save();
            }

        $deleteInput = explode(',',$input['remove-item-list']);
        foreach ($deleteInput as $value) {
            if ($value)
                CompetencyItem::where('id',$value)->delete();
        }

        return $competency;
    }
}
