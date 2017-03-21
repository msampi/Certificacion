<?php

namespace App\Repositories;

use App\Models\Tracking;
use App\Models\TrackingAction;
use InfyOm\Generator\Common\BaseRepository;
use Auth;

class TrackingRepository extends AdminBaseRepository
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
        return Tracking::class;
    }

    public function firstOrCreate($conditions)
    {
      $model = $this->model->firstOrCreate($conditions);
      $model->user_id = $conditions['user_id'];
      $model->evaluation_id = $conditions['evaluation_id'];
      $model->client_id = $conditions['client_id'];
      $model->save();
      return $model;
    }



    public function getBrowser()
    {
        $u_agent = $_SERVER['HTTP_USER_AGENT'];        $ub = '';
        if(preg_match('/MSIE/i',$u_agent))          {   $ub = "ie";     }
        elseif(preg_match('/Firefox/i',$u_agent))   {   $ub = "firefox";    }
        elseif(preg_match('/Safari/i',$u_agent))    {   $ub = "safari"; }
        elseif(preg_match('/Chrome/i',$u_agent))    {   $ub = "chrome"; }
        elseif(preg_match('/Flock/i',$u_agent)) {   $ub = "flock";      }
        elseif(preg_match('/Opera/i',$u_agent)) {   $ub = "opera";      }
      return $ub;
    }

    
    function getUserCountry()
    {
        $xml = simplexml_load_file("http://www.geoplugin.net/xml.gp?ip=".$this->getUserIP());
        return $xml->geoplugin_countryName ;        
        
    }
    function getUserIP()
    {
        if (!empty($_SERVER['HTTP_CLIENT_IP']))   //check ip from share internet
    
            $ip = $_SERVER['HTTP_CLIENT_IP'];
        
        elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))   //to check ip is pass from proxy
    
            $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
        
        else
    
            $ip=$_SERVER['REMOTE_ADDR'];
    
        return $ip;
    }

    public function saveTrackingAction($id, $action)
    {
        $trackingAction = new TrackingAction();
        $trackingAction->tracking_id = $id;
        $trackingAction->action = $action;
        $trackingAction->ip = $this->getUserIP();
        $trackingAction->browser = $this->getBrowser();
        $trackingAction->country = $this->getUserCountry();
        $trackingAction->save();

    }
}
