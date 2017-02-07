<?php

namespace App\Repositories;

use App\Models\Autoperception;
use App\Models\AutoperceptionItem;
use App\Models\Rating;
use InfyOm\Generator\Common\BaseRepository;

class AutoperceptionRepository extends AdminBaseRepository
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
        return Autoperception::class;
    }


    public function create(array $input)
    {

        $autoperception = parent::create($input);

        if (isset($input['items']))
            foreach ($input['items'] as $value) {
                $item = new AutoperceptionItem();
                $item->autoperception_id = $autoperception->id;
                $item->description = $value;
                $item->save();
            }
        return $autoperception;

    }

    public function update(array $input, $id)
    {

        $autoperception = parent::update($input, $id);

        if (isset($input['items']))
            foreach ($input['items'] as $key => $value) {
                $item = AutoperceptionItem::firstOrNew(['id' => $key]);
                $item->autoperception_id = $autoperception->id;
                $item->description = $value;
                $item->save();
            }

        $deleteInput = explode(',',$input['remove-item-list']);
        foreach ($deleteInput as $value) {
            if ($value)
                AutoperceptionItem::where('id',$value)->delete();
        }

        return $autoperception;
    }
    
    
    public function getRatingId($name)
    {
        $rating = Rating::where('name',$name)->first();
        return $rating->id;
    }
    
    public function saveFromExcel($row, $client_id)
    {

        $autoperception = $this->model->firstOrNew(['import_id' => $row->id_autopercepcion, 'client_id' => $client_id]);
        $autoperception->name = $row->nombre;
        $autoperception->instructions = $row->instrucciones;
        $autoperception->reference = $row->referencia;
        $autoperception->rating_id = $this->getRatingId($row->rating);
        $autoperception->save();
    
        if ($row->item)
            $item = AutoperceptionItem::firstOrCreate(['autoperception_id' => $autoperception->id, 
                                             'description' => $row->item]);
        
        
        
        return $autoperception;

    }
    
}
