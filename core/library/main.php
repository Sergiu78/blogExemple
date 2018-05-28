<?php

function show404page(){
    header("HTTP/1.1 404 Not Found");
    
    echo '404 page';
}

function renderView($viewName,array $data = []){
    include 'core/views/'.$viewName.'.php';
}

function is_auth(){
    if(isset($_SESSION['user']['id']) and !empty($_SESSION['user']['id'])){
        return true;
    }else{
        return false;
    }
}

function getUrlSegment($num){
    $url = strtolower($_GET['url']);

    $urlSegments = explode('/',$url);
    
    return getUrlSegment($num);
}

