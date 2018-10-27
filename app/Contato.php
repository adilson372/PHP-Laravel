<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contato extends Model
{
    //
      public $fillable = [
      'saudacao', 'nome', 'telefone', 'email','avatar','nota','created_at'
    ];
    //acessar
    public function getAvatarImageAttribute($value){
      return $this->avatar == null ? asset('images/null.png') : asset($this->avatar);
    }
    public function getAvatarFileNameAttribute($value){
      return substr($this->avatar,30,strlen($this->avatar));
    }
    public function getDataNascimentoAttribute($value){
      return $this->dateFormatDatabaseScreen($value,'screen');
    }
    public function setDataNascimentoAttribute($value){
      $this->attributes['data_nascimento'] = $this->dateFormatDatabaseScreen($value);
    }
    public function setAvatarAttribute($value){
      $filename = substr(md5(rand(100000,999999)),0,5).'_'.$value->getClientOriginalName();
      $filepath ='public/uploads/'.date('Y').'/'.date('m').'/';
      if($value->isValid()){
         $value->storeAs($filepath,$filename);
      }
      $this->attributes['avatar'] = str_replace('public','storage',$filepath).$filename;
    }

    public function dateFormatDatabaseScreen($data,$formato='database') {
  		if ($formato == "screen") {
  			$data = str_replace('-','/',$data);
  		}
  		else if($formato == "database"){
        $data = str_replace('/','-',$data);
      }
      return $data;
  	}
}
