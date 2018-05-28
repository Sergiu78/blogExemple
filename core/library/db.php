<?php
function connectToDb(){
    $config = require 'core/configs/db.php';

     $link = @mysqli_connect($config['host'],$config['user'],$config['password'],$config['db_name']);
     
     if(!$link){
         echo 'Database connect error'. mysqli_connect_error();
         die();
     }
     return $link;
}

function selectData($sql){
    $link = connectToDb();
    $res = mysqli_query($link,$sql);
    
    if(!$res){
        die(mysqli_error($link));
    }
    return $res;
}

function insertUpdateDelete($sql){
     $link = connectToDb();
    $res = mysqli_query($link,$sql);
    
    if(!$res){
        die(mysqli_error($link));
    }
    return mysqli_insert_id($link);
}

function getSaveData($str){
    $link = connectToDb();
    return mysqli_real_escape_string($link,$str);
}

function findModelById($table,$id){
     $sql = "SELECT * FROM $table WHERE id = $id";
    return selectData($sql);
}

function getAll($table){
     $sql = "SELECT * FROM $table";
    return mysqli_fetch_all(selectData($sql), MYSQLI_ASSOC);
}