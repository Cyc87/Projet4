<?php

class CommentChapter{

    private $_id;
    private $_pseudo;
    private $_messageComment;
    private $_dateTimeComment;
    private $_idCommentChapter;
    private $signalement;

    public function __construct(Array $data){
        $this->hydrate($data);
    }
    public function hydrate(Array $data){
        if(isset($data['id'])){
            $this->setId($data['id']);
        }
        if(isset($data['pseudo'])){
            $this->setPseudo($data['pseudo']);
        }
        if(isset($data['messageComment'])){
            $this->setMessageComment($data['messageComment']);
        }
        if(isset($data['dateTimeComment'])){
            $this->setDateTimeComment($data['dateTimeComment']);
        }
        if(isset($data['idCommentChapter'])){
            $this->setIdCommentChapter($data['idCommentChapter']);
        }
        if(isset($data['signalement'])){
            $this->setSignalement($data['signalement']);
        }
    }
    // GETTERS
    public function id(){
        return $this->_id;
    }
    public function pseudo(){
        return $this->_pseudo;
    }
    public function messageComment(){
        return $this->_messageComment;
    }
    public function dateTimeComment(){
        return $this->_dateTimeComment;
    }
    public function idCommentChapter(){
        return $this->_idCommentChapter;
    }
    public function signalement(){
        return $this->_signalement;
    }
    // SETTERS
    public function setId($id){
        $this->_id = $id;
    }
    public function setPseudo($pseudo){
        $this->_pseudo = $pseudo;
    }
    public function setMessageComment($messageComment){
        $this->_messageComment = $messageComment;
    }
    public function setDateTimeComment($dateTimeComment){
        $this->_dateTimeComment = $dateTimeComment;
    }
    public function setIdCommentChapter($idCommentChapter){
        $this->_idCommentChapter = $idCommentChapter;
    }
    public function setSignalement($signalement){
        $this->_signalement = $signalement;
    }
}