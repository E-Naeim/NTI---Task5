<?php

function validate($var, $method){
    if($method == 'name'){
        if(empty($var)){
            echo 'Name is required.'.'<br>';
          }
        else if (preg_match('~[0-9]+~', $var)) {
            echo 'Name must contain letters only!'.'<br>';
          }
        else return true;
    }

    if($method == 'password'){
        if(empty($var)){
            echo 'Password is required.'.'<br>';
          }
        else if(strlen($var) < 5){
            echo 'Password is too short!, minimum length is 6 charachters.'.'<br>';
          }
        else return true;
    }

    if($method == 'email'){
        if(empty($var)){
            echo 'Email is required.'.'<br>';
          }
        else if(!filter_var($var, FILTER_VALIDATE_EMAIL)){
            echo 'NOT A VALID EMAIL!'.'<br>';
          }
        else return true;
    }

    if($method == 'address'){
        if(empty($var)){
            echo 'Address is required.'.'<br>';
          }
        else if(strlen($var) < 9){
            echo 'Address is too short!, minimum length is 10 charachters.'.'<br>';
          }
        else return true;
    }

    if($method == 'gender'){
        if($var == 'Unkown'){
            echo 'Gender is required.'.'<br>';
          }
        else return true;
    }

    if($method == 'url'){
        if(empty($var)){
            echo 'Linkedin URL is required.'.'<br>';
          }
        else if(!filter_var($var, FILTER_VALIDATE_URL)){
            echo 'NOT A VALID Linkedin URL!'.'<br>';
          }
        else return true;
    }


}
?>