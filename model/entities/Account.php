<?php

    class AccountCreation{

        private $_id;
        private $_userName;
        private $_pseudo;
        private $_password1;
        private $_mail;
        private $_creationDate;
        

        public function __construct(Array $data){
        $this->hydrate($data);
        }
        public function hydrate(Array $data){
            if(isset($data['id'])){
            $this->setId($data['id']);
            }
            if(isset($data['username'])){
            $this->setUserName($data['username']);
            }
            if(isset($data['pseudo'])){
            $this->setPseudo($data['pseudo']);
            }
            if(isset($data['password1'])){
            $this->setPassword1($data['password1']);
            }
            if(isset($data['mail'])){
            $this->setMail($data['mail']);
            }
            if(isset($data['creation_date'])){
            $this->setCreationDate($data['creation_date']);
            }
        } 
        // GETTERS
        public function id(){
            return $this->_id;
        }
        public function userName(){
            return $this->_userName;
        }
        public function pseudo(){
            return $this->_pseudo;
        }
        public function password1(){
            return $this->_password1;
        }
        public function mail(){
            return $this->_mail;
        }
        public function creationDate(){
            return $this->_creationDate;
        }
        // SETTERS
        public function setId($id){
            $this->_id = $id;
        }
        public function setUserName($name){
            $this->_userName = $name;
        }
        public function setPseudo($pseudo){
            $this->_pseudo = $pseudo;
        }
        public function setPassword1($password1){
            $this->_password1 = $password1;
        }
        public function setMail($mail){
            $this->_mail = $mail;
        }
        public function setCreationDate($creationDate){
            $this->_creationDate = $creationDate;
        }
    }     
?>