<?php

    include('Database.php');
    
    class Config extends Database{
        
        public $cn;
        public $lastid;

        function config(){
            $this -> cn = new mysqli(
                $this -> localhost,
                $this -> root,
                $this -> password,
                $this -> database,
            );
        }

        function __construct(){
            $this->config();
        }

        function insert($table, $value){
            $sql = "INSERT INTO $table VALUES($value)";
            $this->cn->query($sql);
            $this->lastid = $this->cn->insert_id;
        }
        
        function update($table,$column,$condition){
            $sql = "UPDATE $table SET $column WHERE $condition ";
            $this->cn->query($sql);
        }
        
        function duplicate($table,$column,$condition){
            $sql = "SELECT $column FROM $table WHERE $condition";
            $result = $this-> cn-> query($sql);
            if($result->num_rows > 0){
                return true;
            }else{
                return false;
            }
        }

        function getdata($table,$column,$condition1,$condition2,$start,$end){
            
            $sql = "SELECT $column FROM $table WHERE $condition1 ORDER BY $condition2 DESC LIMIT $start,$end";
            $result = $this->cn->query($sql);
            $data = array();
            if($result->num_rows > 0){
                while($row = $result->fetch_array()){
                    $data[] = $row;
                }
                return $data;
            }else{
                return 0;
            }
            
        }

        function getcurrentdata($table,$column,$condition){
            
            $sql = "SELECT $column FROM $table WHERE $condition";
            $result = $this->cn->query($sql);
            $row = $result ->fetch_array();
            
            return $row; 
        }

        function countdata($table,$condition){
            
            $sql = "SELECT COUNT(*) AS total FROM $table WHERE $condition";
            $resultcount = $this->cn->query($sql);
            $rowcount = $resultcount->fetch_array();
            return $rowcount[0];
            
        }


        function slugStr($str){
            return preg_replace("#(\p{P}|\p{C}|\p{S}|\p{Z})+#u","-", $str);
        } 
    }
    


?>