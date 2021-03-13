<?php

    session_start();

    function isLogedIn(){
        if( isset($_SESSION['id'])){
            return true;
        }
        else{
            return false;
        }
    }