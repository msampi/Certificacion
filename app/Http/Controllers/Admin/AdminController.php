<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\AppBaseController;
use App\Models\Client;
use View;
use App;
use Auth;

class AdminController extends AppBaseController
{

    public function __construct()
    {
        //$this->languageRepository = App::make(LanguageRepository::class);

        //parent::__construct();
    }


    public function uploadImage($request, $field_name)
    {
        $imageName = NULL;
        if ($request->file($field_name)) :
            $imageName = $this->random(50).'.'.$request->file($field_name)->getClientOriginalExtension();
            $request->file($field_name)->move(base_path() . '/public/uploads/', $imageName);
        endif;

        return $imageName;
    }


}
