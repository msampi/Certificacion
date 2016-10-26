<?php

namespace App\Repositories;

use App\Models\Behaviour;
use InfyOm\Generator\Common\BaseRepository;

class CompetencyItemRepository extends AdminBaseRepository
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
        return Behaviour::class;
    }

    public function saveFromExcel($row, $competition_id, $lang)
    {

        $attributes = $row->all();
        foreach ($attributes as $attr => $value) {
            if (strpos($attr, 'comportamiento') !== false) {
                $data = explode('_', $attr);
                if (isset($data[1]) && is_numeric($data[1])){
                    if ($value != '') :
                        $behaviour = $this->model->firstOrCreate(array('import_id' => $data[1], 'competition_id' => $competition_id));
                        $behaviour->import_id = $data[1];
                        $behaviour->description = $this->saveArrayField($behaviour->description, $lang, $value);
                        $behaviour->save();
                    endif;
                }
            }


        }
    }
}
