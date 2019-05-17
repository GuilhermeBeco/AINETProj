<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Move extends Model
{
   protected $table ='movimentos';
   public function piloto(){
   	return $this->hasOne('App/User')->as('piloto');
   }
   public function instrutor(){
   	return $this->hasOne('App/User')->('instrutor');
   }
   public function aeronave(){
   	return $this->hasOne('App/Plane')->('aeronave');
   }
}
