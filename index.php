<?php

    session_start();

    require "model/entities/Chapter.php";
    require "model/managers/ChapterManager.php";

    require "model/entities/Comment.php";
    require "model/managers/CommentManager.php";

    require "model/entities/Account.php";
    require "model/managers/AccountManager.php";

    require "controller/frontEndController.php";

    if($_GET['action'] == "home"){
        home();
    }
    else if($_GET['action'] == "article"){
        article();  
    }else if($_GET['action'] == "login"){
        login();
    }else if($_GET['action'] == "admin"){
        admin();
    }else if($_GET['action'] == "creationAccount"){
        creationAccount();
    }else if($_GET['action'] == "creationChapter"){
        creationChapter();
    }else if($_GET['action'] == "deconnexion"){
        deconnexion();
    }else if($_GET['action'] == "deleteChapter"){
        deleteChapter();
    }else if($_GET['action'] == "modificationChapter"){
        modificationChapter();
    }else{
        pageError();
    }
  