<?php

class CommentManager{

    private $db;

    public function __construct(){
        try {
                $this->_db = new PDO('mysql:host=localhost;dbname=projet4;charset=utf8', 'root', '');
            } catch (Exception $e) {
                die('Erreur : ' . $e->getMessage());
            }
    }
    public function addComment(CommentChapter $comment){
        $req = $this->_db->prepare("INSERT INTO comment (pseudo, messageComment, idCommentChapter ,signalement) VALUES(?, ?, ?, ?)");
        $req->execute(array(
            $comment->pseudo(),
            $comment->messageComment(),
            $comment->idCommentChapter(),
            $comment->signalement(),
        ));
        $data = $req ->fetch(PDO::FETCH_ASSOC);
        return $data;
    }
    public function updateComment(CommentChapter $comment){
            
        $req = $this->_db->prepare("UPDATE comment SET signalement= :signalement WHERE id = :id ");
        $req->execute(array(
            "signalement" => $comment->signalement(),
            "id" => $comment->id(),
        ));
    }
    public function deleteComment($id){
           
        $req = $this->_db->prepare("DELETE FROM comment WHERE id = ?");
        $req->execute(array(
            $id,
        ));
    }
    public function deleteCommentSigned($idCommentChapter){
           
        $req = $this->_db->prepare("DELETE FROM comment WHERE idCommentChapter = ?");
        $req->execute(array(
            $idCommentChapter,
        ));
    }
}