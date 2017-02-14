<?php

namespace App\Library;
use App\Models\User;
use DB;

class Ecases
{
  private $user;
  private $simulation_id;
  private $userIdInEcase;
    
    
  public function __construct($user, $simulation_id){
      $this->user = $user;
      $this->simulation_id = $simulation_id;
      $this->userIdInEcase = $this->getUserIdInEcase();
  }    
    
  private function existsUser()
  {
      
      $user_account = \DB::connection('ecases')->table('users')->where('email', $this->user->email)->first();
      
      if (!$user_account)
          return false;
      return true;
      
      
  }
    
  private function createUser()
  {
      
      $id = \DB::connection('ecases')->table('users')->insertGetId(
                        ['first_name' => $this->user->name, 
                         'last_name' => $this->user->last_name, 
                         'email' => $this->user->email,
                         'password' => $this->user->password,
                         'state' => 1, 
                         'id_cliente' => 15,
                         'id_idiom' => 1,
                         'id_rol' => 3]
            );
      
      return $id;
         
  }
    
    
  /*
    
   ordenadores:1
   tablets:2
   toma_decision: 3
  
  */

    
  private function getUserIdInEcase(){
      $user = \DB::connection('ecases')->table('users')->where('email',$this->user->email)->first();
      if ($user)
        return $user->ID;
      return NULL;
  }
    
  public function getDecisions(){
    
    
      $decisiones = \DB::connection('ecases')->table('simulacion')
                                              ->select('decision.id','decision.nombre')
                                              ->join('caso_objeto', 'simulacion.caso_id', '=', 'caso_objeto.id_caso')
                                              ->join('toma_decision', 'caso_objeto.id_objeto', '=', 'toma_decision.ID')
                                              ->join('toma_decision_decision', 'toma_decision.ID', '=', 'toma_decision_decision.id_toma_decision')
                                              ->join('decision', 'toma_decision_decision.id_decision', '=', 'decision.id')
                                              ->where('simulacion.id', $this->simulation_id)
                                              ->where('caso_objeto.tipo', 3)->get(); 
      foreach ($decisiones as $decision){
          $decision->questions = \DB::connection('ecases')->table('decision_pregunta')
                                              ->where('id_decision',$decision->id)->get();
          foreach($decision->questions as $question){
              $question->titulo = $this->decode($question->titulo);
              $question->answer = \DB::connection('ecases')->table('decision_respuesta')
                                ->where('id_usuario',$this->userIdInEcase)
                                ->where('id_simulacion',$this->simulation_id)
                                ->where('id_decision_pregunta',$question->id)
                            ->first();
          }
      }
      return $decisiones;
    
  }
    
    
  public function getDiary(){
        return \DB::connection('ecases')->table('agenda')
                                          ->where('id_simulacion',$this->simulation_id)
                                          ->where('id_usuario',$this->userIdInEcase)->get();
      
  }
    
  public function getDirectorWrite(){
        return \DB::connection('ecases')->table('tablet_escritura')
                                          ->where('id_simulacion',$this->simulation_id)
                                          ->where('id_usuario',$this->userIdInEcase)->first();
      
  }
    
  private function assignSimulationUser()
  {
      $simulation = \DB::connection('ecases')->table('simulacion')->where('ID',$this->simulation_id)->first();
      if ($simulation)
      {
          \DB::connection('ecases')->table('simulacion_usuario')->insert(
                        ['id_simulacion' => $simulation->id, 
                         'id_usuario' => $this->userIdInEcase,
                         'mail_bienvenida' => 1,
                         'estado' => 0]
            );
          return true;
      }
      return false;
      
          
  }
    
  public function decode($string){

        if ($string):
            $word = explode('</ES>',$string);
            $word = $word[0];
            $word = explode('<ES>', $word);
            if (isset($word[1]))
                return $word[1];
            else
                return NULL;
        else:
            return NULL;
        endif;

  }
    
  public function createAndAssignUser()
  {
      if (!$this->existsUser($this->user)){  
        $this->userIdInEcase = $this->createUser($this->user);
        $this->assignSimulationUser();
      }
      
  }
    
  public function getSimulationId($name)
  {
      $simulation = \DB::connection('ecases')->table('simulacion')->where('nombre',$name)->first();
      if ($simulation)
          return $simulation->id;
      return false;
  }
    
  
}

?>
