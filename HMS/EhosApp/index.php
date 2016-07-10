<?php
    session_start();
    if (!isset($_SESSION['uid'])) {
           if (isset($_COOKIE['uid']) && isset($_COOKIE['uname'])) {
        $_SESSION['uid'] = $_COOKIE['uid'];
        $_SESSION['uname'] = $_COOKIE['uname'];
        }
    }
  


    function startsWith($haystack, $needle)
    {
        return $needle === "" || strpos($haystack, $needle) === 0;
    }
    function endsWith($haystack, $needle)
    {
        return $needle === "" || substr($haystack, -strlen($needle)) === $needle;
    }

    function IsNullOrEmptyString($question){
        return (!isset($question) || trim($question)==='');
    }
       // echo $_GET["load"]."from controller.....".isset($_SESSION['uname']);
        $viewfile = isset($_GET["load"]) ? $_GET['load'] : "" ;
        if(IsNullOrEmptyString($viewfile)){
            include '/view/ehos_home.php';
        }elseif(endsWith($viewfile, ".php")){
            include '/view/'.$viewfile;
        } else {
            include '/view/'.$viewfile.'.php';
        }
    
?> 