<?php

namespace App\Controller;

use App\Model\Model;

class ReservaController {

    private $db;

    public function __construct() {
        $this->db = new Model();
    }
    public function select(){
        $user = $this->db->select('reservas');
        
        return  $user;
    }
    public function selectId($id){
        $user = $this->db->select('reservas',['id'=>$id]);
        
        return  $user;
    }
    public function insert($data){
        if($this->db->insert('reservas', $data)){
            return true;
        }
        return false;
    }
    
    public function update($newData,$conditions){
        if($this->db->update('reservas', $newData, ['id'=>$conditions])){
            return true;
        }
        return false;
    }
    public function delete( $id){
        $resultado =$this->selectId($id);
        if(count($resultado)<1){
            return false;
        }
        if($this->db->delete('reservas', ['id'=>$id])){
            return true;
        }
        return false;        
    }
}