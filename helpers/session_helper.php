<?php

if(!isset($_SESSION)) {
    session_start();
}

function flash($name, $message = "", $class = "error-box") {
    if(!empty($name)) {
        if(!empty($message) && empty($_SESSION[$name])) {
            $_SESSION[$name] = $message;
            $_SESSION[$name."_class"] = $class;
        }
        else if(empty($message) && !empty($_SESSION[$name])) {
            echo "<div class='".$_SESSION[$name."_class"]."'><h3>".$_SESSION[$name]."</h3></div>";
            unset($_SESSION[$name]);
            unset($_SESSION[$name."_class"]);
        }
    }
}

function redirect($path) {
    header("location:".$path);
    exit();
}