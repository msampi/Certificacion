<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\AppBaseController;
use App\Models\Client;
use View;
use App;
use Auth;

class AdminController extends AppBaseController
{
    public function random($length)
    {
        $key = '';
        $keys = array_merge(range(0, 9), range('a', 'z'));

        for ($i = 0; $i < $length; $i++) {
            $key .= $keys[array_rand($keys)];
        }

        return $key;
    }
    
    public function uploadFile($request, $field_name)
    {
        
        $imageName = NULL;
        if ($request->file($field_name)) :
            $imageName = $this->random(50).'.'.$request->file($field_name)->getClientOriginalExtension();
            $request->file($field_name)->move(base_path() . '/public/uploads/', $imageName);
        endif;

        return $imageName;
    }

    public function fileManager() {
    }
}
