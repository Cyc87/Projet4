<?php
    class AccountManager{

        private $_db;

        public function __construct(){
            try {
                $this->_db = new PDO('mysql:host=localhost;dbname=projet4;charset=utf8', 'root', '');
            } catch (Exception $e) {
                die('Erreur : ' . $e->getMessage());
            }
        }
        public function getByMail($mail){
            $req = $this->_db->prepare("SELECT * FROM `users` WHERE mail = :mail");
            $req->execute(array(
                "mail" => $mail
            ));
            $data = $req ->fetch(PDO::FETCH_ASSOC);
            return $data;
        }
        public function getByPseudo($pseudo){
            $req = $this->_db->prepare("SELECT * FROM `users` WHERE pseudo = :pseudo");
            $req->execute(array(
                "pseudo" => $pseudo
            ));
            $data = $req ->fetch(PDO::FETCH_ASSOC);
            return $data;
        }
        public function addAccountCreation(AccountCreation $users){
            $req = $this->_db->prepare("INSERT INTO users(username, pseudo, password1, mail, creation_date) VALUES (?,?,?,?,NOW())");
            $req->execute(array(
                $users->userName(),
                $users->pseudo(),
                $users->password1(),
                $users->mail(),
            ));
        }
    }
?>