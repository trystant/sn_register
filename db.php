<?php
    class Database{
        public $mysqli;
        public $result;
     
        public function DatabaseConnect(){
            include_once('./info.php');
            $this->mysqli = new mysqli($DB['host'], $DB['id'], $DB['pw'], $DB['db']);
            if(mysqli_connect_error()){
                exit('Connect Error('.mysqli_connect_errno().') '.mysqli_connect_error());
                return;
            }
        }

        public function query($string){
            return mysqli_query($this->mysqli, $string);
        }

        public function db_disconnect(){
            mysqli_close($this->mysqli);
            return;
        }
    }

?>