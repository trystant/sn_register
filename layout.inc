<?php
    session_start();

    class MainLayout{
        
        public $title;        
        public $script;

        public function MainLayout($string){
            $this->title = $string;
            return;
        }

        public function main_display(){
            echo "<!Doctype html>";
            echo "<html>";
            echo $this->header();
            echo "<body>";
            echo $this->login_status();
            echo $this->page_title();
            return;
        }
        
        public function display_head_menu(){
            echo "<div align = 'center'>";
                echo "<table style='border-spacing:15px'>";
                    echo "<tr>";
                        echo "<td>";
                            echo "<a href='./index.php'><h3>Serial Number Registration</h3></a>";
                        echo "</td>";
                        echo "<td>";
                            echo "<a href='./product_register.php'><h3>Product Register</h3></a>";
                        echo "</td>";
                        echo "<td>";
                            echo "<a href='./search.php'><h3>Search</h3></a>";
                        echo "</td>";
                        echo "<td>";
                            echo "<a href='./hdd_search.php'><h3>HDD Search</h3></a>";
                        echo "</td>";
                        echo "<td>";
                            echo "<a href='./old_search.php'><h3>Old Serial Search</h3></a>";
                        echo "</td>";
                    echo "</tr>";
                echo "</table>";
            echo "</div>";
            return;
        }
        
        public function insert_script($script_input){
            //echo strlen($script_input);
            $this->script = $script_input;
            //echo "suxess!";
            return;
        }

        public function header(){
            echo "<head>";
                echo "<meta charset='utf-8'>";
                echo "<link type='text/css' rel='stylesheet' href='ss.css'/>";
                echo "<script>";
                echo $this->script;
                echo "</script>";
                echo strlen($this->script);
                echo "<title>".$this->title."</title>";
                echo $this->display_head_menu();
            echo "</head>";
            return;
        }
        
        public function end_main_display(){
            echo "</body>";
            echo "</html>";
            return;
        }
        
        public function login_status(){
            echo "<div align='center'>";
            if($_SESSION['is_logged']=='YES'){
                echo "Hello, ".$_SESSION['login_id']."<br>";
                echo "<a href='./logout.php'>Logout</a><br>";
                echo "<a href='./log.php'>Serial Log</a>";
            } else{
                echo "<a href='./login.php'>Login</a>";
            }
            echo "</div>";
            return;
        }
        
        public function page_title(){
            echo "<div align='center'>";
            echo "<h2>".$this->title."</h2>";
            echo "</div>";
            return;
        }
        
    }


?>