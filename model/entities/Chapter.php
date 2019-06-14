<?php 

    class ChapterCreation{
        
        private $_id;
        private $_numberChapter;
        private $_titleChapter;
        private $_contentChapter;
        private $_dateCreationChapter;

        public function __construct(Array $data){
            $this->hydrate($data);
        }
        public function hydrate(Array $data){
            if(isset($data['id'])){
                $this->setId($data['id']);
            }
            if(isset($data['numberChapter'])){
                $this->setNumberChapter($data['numberChapter']);
            }
            if(isset($data['titleChapter'])){
                $this->setTitleChapter($data['titleChapter']);
            }
            if(isset($data['contentChapter'])){
                $this->setContentChapter($data['contentChapter']);
            }
            if(isset($data['dateCreationChapter'])){
                $this->setDateCreationChapter($data['dateCreationChapter']);
            }
        }
        // GETTERS
        public function id(){
            return $this->_id;
        }
        public function numberChapter(){
            return $this->_numberChapter;
        }
        public function titleChapter(){
            return $this->_titleChapter;
        }
        public function contentChapter(){
            return $this->_contentChapter;
        }
        public function dateCreationChapter(){
            return $this->_dateCreationChapter;
        }
        // SETTERS
        public function setId($id){
            $this->_id = $id;
        }
        public function setNumberChapter($numberChapter){
            $this->_numberChapter = $numberChapter;
        }
        public function setTitleChapter($titleChapter){
            $this->_titleChapter = $titleChapter;
        }
        public function setContentChapter($contentChapter){
            $this->_contentChapter = $contentChapter;
        }
        public function setDateCreationChapter($dateCreationChapter){
            $this->_dateCreationChapter = $dateCreationChapter;
        }
    }
?>