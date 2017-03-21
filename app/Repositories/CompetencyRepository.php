<?php

namespace App\Repositories;

use App\Models\Competency;
use App\Models\CompetencyItem;
use App\Models\CompetencyGroup;

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
    
    public function getCompetencyGroupId($name, $client_id)
    {
        $compGroup = CompetencyGroup::firstOrCreate(['name' => $name, 'client_id' => $client_id]);
        return $compGroup->id;
    }

    public function saveFromExcel($row, $client_id)
    {
        if (!$client_id) $client_id = NULL;
        $competency = $this->model->firstOrNew(['import_id' => $row->id_competencia, 'client_id' => $client_id]);
        $competency->name = $row->competencia;
        $competency->import_id = $row->id_competencia;
        $competency->description = $row->descripcion;
        $competency->reference = $row->referencia;
        $competency->competency_group_id = $this->getCompetencyGroupID($row->grupo, $client_id);
        $competency->save();
        
        
        $competencyItem = CompetencyItem::firstOrCreate(['competency_id' => $competency->id, 
                                                      'positive' => $row->indicador_colum_derecha,
                                                      'negative' => $row->indicador_colum_izquierda]);
        
        
        return $competency;

    }
    
    public function saveNewGroup(array $input)
    {
        if (!empty($input['new_group'])) :

            $group = CompetencyGroup::firstOrNew(['name' => $input['new_group'], 'client_id' => $input['client_id']]);
            $group->name = $input['new_group'];
            $group->client_id = $input['client_id'];
            $group->save();
            return $group->id;

        else:
            return false;
        endif;
    }

    public function create(array $input)
    {
        if ($new_group_id = $this->saveNewGroup($input))
            $input['competency_group_id'] = $new_group_id;
        
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
        if ($new_group_id = $this->saveNewGroup($input))
            $input['competency_group_id'] = $new_group_id; 
        
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
