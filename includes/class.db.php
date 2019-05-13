<?php

class DB {
        //Private variable to store sql connection
        private $sql;
        //function which is called when object is created
        function __construct($host,$user,$pass,$name) {
                //start the sql connection. Replace with your database config
                $this->sql = new mysqli($host, $user,$pass,$name);
        }
        /*
        Function to exequte sql query.
        $IO is for operations which do not have a return value like insert queries
        */
        public function query($Q, $IO = false){
                //Store sql variable locally
                $sql=$this->sql;
                //init results array and store them after executing the sql query
                $results_array = array();
                $result = $sql->query($Q);
                //If there is no expected array of results, just return the $result (true or false depending if it worked!)
                if($IO){
                     return $result;
                }else{
                        //if query was successful, store and return the results
                        if($result){
                                while ($row = $result->fetch_assoc()) {
                                $results_array[] = $row;
                                }
                                return $results_array;
                        }else{
                                //not successful, return nothing
                                return null;
                        }
                }
        }
        //called when object is deleted - close sql connection
        function __destruct(){
                $this->sql->close();
        }
        //clean a string using the mysqli real escape string function
        public function cleanString($string){
                return mysqli_real_escape_string($this->sql, $string);
        }
}