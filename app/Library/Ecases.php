<?php

namespace App\Library;
use App\Models\User;
use DB;

class Ecases
{
  

  private function createUser($user)
  {
      
      \DB::connection('ecases')->table('users')->insert(
                        ['first_name' => $user->name, 
                         'last_name' => $user->last_name, 
                         'email' => $user->email,
                         'password' => $user->password,
                         'id_idiom' => 1,
                         'id_rol' => 3]
            );
      
      
      
      
      return \DB::connection('ecases')->Query('SELECT LAST_INSERT_ID()');
      
  }
    
  private function assignSimulationUser($user, $userID, $simulation_name)
  {
      $simulation = \DB::on('ecases')->table('simulacion')->where('nombre',$simulation_name)->first();
      if ($simulation)
      {
          \DB::on('ecases')->table('simulacion_usuario')->insert(
                        ['id_simulacion' => $simulation->id, 
                         'id_usuario' => $userID, 
                         'mail_bienvenida' => 0,
                         'estado' => 0]
            );
          return true;
      }
      return false;
      
          
  }
    
  public function createAndAssignUser($user, $exercise)
  {
      $userId = $this->createUser($user);
      if ($this->assignSimulationUser($user, $userID, $exercise->simulation_name))
          return true;
      return false;
  }
    
  
}

?>
