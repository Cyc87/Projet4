<?php

    class ChapterManager{

        private $_db;

        public function __construct(){
            try {
                $this->_db = new PDO('mysql:host=localhost;dbname=projet4;charset=utf8', 'root', '');
            } catch (Exception $e) {
                die('Erreur : ' . $e->getMessage());
            }
        }
        public function getByContentChapter($contentChapter){
            $req = $this->_db->prepare("SELECT * FROM `chapter` WHERE contentChapter = :contentChapter");
            $req->execute(array(
                "contentChapter" => $contentChapter
            ));
            $data = $req ->fetch(PDO::FETCH_ASSOC);
            return $data;
        }
        public function getByTitleChapter($titleChapter){
            $req = $this->_db->prepare("SELECT * FROM `chapter` WHERE titleChapter = :titleChapter");
            $req->execute(array(
                "titleChapter" => $titleChapter
            ));
            $data = $req ->fetch(PDO::FETCH_ASSOC);
            return $data;
        }
        public function getByNumberChapter($numberChapter){
            $req = $this->_db->prepare("SELECT * FROM `chapter` WHERE numberChapter = :numberChapter");
            $req->execute(array(
                "numberChapter" => $numberChapter
            ));
            $data = $req ->fetch(PDO::FETCH_ASSOC);
            return $data;
        }
        public function addChapterCreation(ChapterCreation $chapter){
            $req = $this->_db->prepare("INSERT INTO chapter(numberChapter, titleChapter, contentChapter, dateCreationChapter) VALUES (?,?,?,NOW())");
            $req->execute(array(
                $chapter->numberChapter(),
                $chapter->titleChapter(),
                $chapter->contentChapter(),
            ));
        }
        public function deleteChapter($id){
            $req = $this->_db->prepare("DELETE FROM chapter WHERE id = ?");
            $req->execute(array(
                $id,
            )); 
        }
        public function modifChapterCreation(ChapterCreation $chapter){
            $req = $this->_db->prepare("UPDATE chapter SET numberChapter= :numberChapter, titleChapter= :titleChapter, contentChapter= :contentChapter  WHERE id = :id");
            $req->execute(array(
                $chapter->numberChapter(),
                $chapter->titleChapter(),
                $chapter->contentChapter(),
            ));
        }
    }

?>