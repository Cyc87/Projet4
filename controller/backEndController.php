<?php

function home(){
    
    $chapterManager = new ChapterManager();       
    $chapter = $chapterManager->readAllChapter();
    
    include("view/home.php");
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

function deconnexion(){

    session_destroy();
    
    header('Location: index.php?action=home');
    exit();  
    include("view/deconnexion.php");
}

function pageError(){
   include("view/pageError.php");
}
