<?php

namespace App\Controller;
use App\Model\Model;
class SoftwareController {
    private $db;

    public function __construct() {
        $this->db = new Model();
    }
    public function select(){
        $user = $this->db->select('software');
        
        return  $user;
    }
    public function selectId($id){
        $user = $this->db->select('software',['id'=>$id]);
        
        return  $user;
    }
    public function insert($data){
        if($this->db->insert('software', $data)){
            return true;
        }
        return false;
    }
    
    public function update($newData,$conditions){
        if($this->db->update('software', $newData, ['id'=>$conditions])){
            return true;
        }
        return false;
    }
    public function delete( $id){
        $resultado =$this->selectId($id);
        if(count($resultado)<1){
            return false;
        }
        if($this->db->delete('software', ['id'=>$id])){
            return true;
        }
        return false;        
    }
}