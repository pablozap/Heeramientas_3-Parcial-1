<?php
    class Persona{
        private $id = 0;
        private $user = null;
        private $password = null;

        function __construct($_id, $_user, $_password)
        {
            $this->id = $_id;
            $this->user = $_user;
            $this->password = $_password;
        }
        function getId(){
            return $this->id;
        }
        function getUser(){
            return $this->user;
        }
        function getPassword(){
            return $this->password;
        }
    }
?>