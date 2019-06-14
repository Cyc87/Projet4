<?php

function home(){
    
    $chapterManager = new ChapterManager();       
    $chapter = $chapterManager->readAllChapter();
    
    include("view/home.php");
} 
function article(){

    $edit_chapter = htmlspecialchars($_GET['edit']);
    
    $chapterManager = new chapterManager;
    $commentReadChapter = $chapterManager->editChapter($edit_chapter);
    
    $commentManager = new CommentManager;
    $commentRead = $commentManager->readComment($_GET['edit']);
    

    if(isset($_POST['validate'])){
  
        if (isset($_POST['pseudo']) &&!empty($_POST['pseudo']) && isset($_POST['message']) &&!empty($_POST['message'])){

            $pseudo = htmlspecialchars($_POST['pseudo']);
            $messageComment = htmlspecialchars($_POST['message']);
            $signalement = "0";
            
            $commentManager = new CommentManager();
            $comment = new CommentChapter([
                "pseudo" => $pseudo,
                "messageComment" => $messageComment,
                "idCommentChapter" => $_GET['edit'],
                "signalement" => $signalement,
            ]);
            $commentManager->addComment($comment);
            header('Location: index.php?action=article&edit=' . $_GET['edit']);
        }  
    }

    if(isset($_GET['signed'])){
        $signalement = "1";
        $modifSigned_id = $_GET['signed'];
        
        $commentManager = new CommentManager();   
        $comment = new CommentChapter([
            'signalement' => $signalement,
            'id' => $modifSigned_id,  
            ]);
        
        $commentManager->updateComment($comment);
    }
    include("view/article.php");
}  
function login(){
    
    if (isset($_SESSION['user'])) {
        header('Location: index.php?action=admin');
        exit();
    }
    if (!empty($_POST)) {
            $name="";
            $accountManager = new AccountManager();       
            $data = $accountManager->getByUserName($name);
           
        
        if ($data) {  
            if (password_verify($_POST['password'], $data['password1'])){
                $_SESSION['user'] = $data['id'];
                header('Location: index.php?action=admin');
                exit();
            } else {
                $_SESSION['message'] = "Votre mot de passe est invalide";
                $_SESSION['msg_type'] = "danger";
            }
        } else {
            $_SESSION['message'] = "Votre login est invalide";
            $_SESSION['msg_type'] = "danger";
        }
    }
    include("view/login.php");  
}
function admin(){
    
    if (!isset($_SESSION['user'])) {
            header('Location: index.php?action=login');
            exit();
    }

    $accountManager = new AccountManager();       
    $data = $accountManager->sessionUser($_SESSION['user']);
    
    $commentManager = new CommentManager();       
    $comment = $commentManager->readAllComment();
    

    if(isset($_GET['supprSigned'])){
        $supprSigned = htmlspecialchars($_GET['edit']);

        $deleteComment = new CommentManager();
        $deleteComment->deleteComment($supprSigned);

        $_SESSION['message'] = "Ce commentaire est bien supprimé! ";
        $_SESSION['msg_type'] = "danger";
        header('location: index.php?action=admin');
        exit();
    
    }
    if(isset($_GET['restoreSigned'])){
        $signalement = "0";
        $restoreSigned_id = ($_GET['edit']);

        $commentManager = new CommentManager();   
        $comment = new CommentChapter([
            'signalement' => $signalement,
            'id' => $restoreSigned_id,  
            ]);
        
        $commentManager->updateComment($comment);

        $_SESSION['message'] = "Ce commentaire est validé! ";
        $_SESSION['msg_type'] = "success";
        header('location: index.php?action=admin');
        exit();   
    }
    include("view/admin.php");   
}
function creationAccount(){
    if(!isset($_SESSION['user'])){
        header('Location: index.php?action=admin');
        exit();
    }
    if (!empty($_POST))
    {
        
        $name = trim(htmlspecialchars($_POST['nom']));
        $pseudo = trim(htmlspecialchars($_POST['pseudo']));
        $password1 = trim(htmlspecialchars($_POST['password1']));
        $password2 = trim(htmlspecialchars($_POST['password2']));
        $mail = trim(htmlspecialchars($_POST['mail']));
        $validation = true;

        
        if (strlen($name) > 30) {
            $_SESSION['message'] = "Votre nom doit faire moins de 30 caractères";
            $_SESSION['msg_type'] = "danger";
            $validation = false;
        }
        if(strlen($pseudo) < 5 ||strlen($pseudo)  > 20)
        {
            $_SESSION['message'] = "Votre pseudo doit être compris entre 5 et 20 caractères";
            $_SESSION['msg_type'] = "danger";
            $validation = false; 
        }
        if(!empty($_POST['pseudo']))
        {
            $accountManager = new AccountManager();       
            $data = $accountManager->getByPseudo($pseudo);

            if ($data == true)
            {
                $_SESSION['message'] = "Pseudo déjà existant";
                $_SESSION['msg_type'] = "danger";
                $validation = false;
            }
        }
        if (strlen($password1) < 8 || strlen($password1) > 25) {
            $_SESSION['message'] = "Votre mot de passe doit être compris entre 8 et 25 caractères";
            $_SESSION['msg_type'] = "danger";
            $validation = false;
        }
        if ($password1 != $password2) {
            $_SESSION['message'] = "Mots de passe différents";
            $_SESSION['msg_type'] = "danger";
            $validation = false;
        }
        if(!empty($_POST['mail']))
        {
            $accountManager = new AccountManager();       
            $data = $accountManager->getByMail($mail);
            
            if($data == true)
            {
                $_SESSION['message'] = "Mail déjà existant";
                $_SESSION['msg_type'] ="danger";
                $validation = false;
            }
        }
        if (empty($name) || empty($pseudo) || empty($password1) || empty($password2) || empty($mail))
        {
            $_SESSION['message'] = "Tous les champs sont obligatoires ";
            $_SESSION['msg_type'] = "danger";
            $validation = false;
        }
        if($validation == true)
        {
            $password1 = password_hash($password1, PASSWORD_DEFAULT);
            
            $users = new AccountCreation([
                "username" => $name,
                "pseudo" => $pseudo,
                "password1" => $password1,
                "mail" => $mail
            ]);
            $accountManager->addAccountCreation($users);

            $_SESSION['message'] = "Votre compte a été crée avec succés !";
            $_SESSION['msg_type'] = "success";
            header('Location: index.php?action=admin');
            exit();
        }
    }    
    include("view/creationAccount.php");
}
function creationChapter(){
    if(!isset($_SESSION['user']))
    {
        header('Location: index.php?action=admin');
        exit();
    }
    if(!empty($_POST))
    {
        $numberChapter=trim(htmlspecialchars($_POST['numberChapter']));
        $titleChapter=trim(htmlspecialchars($_POST['titleChapter']));
        $contentChapter=trim($_POST['contentChapter']);
        $validation = true;

        if(empty($numberChapter) || empty($titleChapter) || empty($contentChapter))
        {
            $_SESSION['message'] = "Tous les champs sont obligatoires ";
            $_SESSION['msg_type'] = "danger";
            $validation = false;
        }
        if(!empty($_POST['numberChapter']))
        {
            $chapterManager = new ChapterManager();       
            $data = $chapterManager->getByNumberChapter($numberChapter);

            if ($data == true)
            {
                $_SESSION['message'] = "Numéro de chapitre déjà existant";
                $_SESSION['msg_type'] = "danger";
                $validation = false;
            }
        }
        if(!empty($_POST['titleChapter']))
        {
            $chapterManager = new ChapterManager();
            $data = $chapterManager->getByTitleChapter($titleChapter);
            if ($data == true)
            {
                $_SESSION['message'] = "Titre de chapitre déjà existant";
                $_SESSION['msg_type'] = "danger";
                $validation = false;
            }
        }
        if($validation == true)
        {
            $chapter = new ChapterCreation([
                "numberChapter" => $numberChapter,
                "titleChapter" => $titleChapter,
                "contentChapter" => $contentChapter,
            ]);
            $chapterManager->addChapterCreation($chapter);
            $_SESSION['message']= "Votre chapitre a été crée avec succés !";
            $_SESSION['msg_type'] = "success";
            header('Location: index.php?action=admin');
            exit();
        }
    }
    include("view/creationChapter.php");
}
function deconnexion(){

    session_destroy();
    
    header('Location: index.php?action=home');
    exit();  
    include("view/deconnexion.php");
}
function deleteChapter(){
    if (!isset($_SESSION['user'])) {
        header('Location: index.php?action=admin');
        exit();
    }
    
    $chapterManager = new ChapterManager();       
    $chapter = $chapterManager->readAllChapter();
    
    if (isset($_GET['id']) && !empty($_GET['id'])) {

        $suppr_id = htmlspecialchars($_GET['id']);

        $deletechapter = new ChapterManager();
        $deletechapter->deletechapter($suppr_id);

        $deleteComment = new CommentManager();
        $deleteComment->deleteCommentSigned($suppr_id);
        
        
        $_SESSION['message'] = "Le chapitre ainsi que les commentaires sont bien supprimés ! ";
        $_SESSION['msg_type'] = "success";

        header('Location: index.php?action=admin');
        exit();
    }
    include("view/deleteChapter.php");
}
function modificationChapter(){
if (!isset($_SESSION['user'])) {
        header('Location: index.php?action=admin');
        exit();
    }

    $chapterManager = new ChapterManager();       
    $chapter = $chapterManager->readAllChapter();
    
    $edit_chapter['numberChapter'] = '';
    $edit_chapter['titleChapter'] = '';
    $edit_chapter['contentChapter'] = '';
    
    if(empty($_GET['edit'])){
        $_GET['edit']= '';
      
    }else{
        if (isset($_GET['edit']) && !empty($_GET['edit'])) {
            
            $edit_id = htmlspecialchars($_GET['edit']);
           
            $chapterManager = new chapterManager;
            $commentModifChapter = $chapterManager->editChapter($edit_id);
        }
        if (isset($_POST['modif'])) {
        
            $modif_id = htmlspecialchars($_GET['edit']);
            $number = htmlspecialchars($_POST['numberChapter']);
            $title = htmlspecialchars($_POST['titleChapter']);
            $contenu = htmlspecialchars($_POST['contentChapter']);

            $chapterManager = new ChapterManager();
            
            $chapterUpdate = new ChapterCreation([
                'numberChapter' => $number,
                'titleChapter' => $title,
                'contentChapter' => $contenu,
                'id' => $modif_id,  
                ]);
           
            $chapterManager->updateChapter($chapterUpdate);

            $_SESSION['message'] = "Votre chapitre a été modifié avec succés !";
            $_SESSION['msg_type'] = "success";
            header('location: index.php?action=admin');
            exit();
        }
    }   
    include("view/modificationChapter.php");
}
function pageError(){
   include("view/pageError.php");
}
    

