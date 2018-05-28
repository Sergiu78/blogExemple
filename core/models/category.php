<?php

function findCategoryById($id){
    $sql = "SELECT id FROM category WHERE id = $id";
}

function saveNewCategory($data){
    $sql = "INSERT INTO category(title,parent_id)VALUES ('{$data['title']}',{$data['parent_id']})";
    return insertUpdateDelete($sql);
}

function updateCategory($data){
    $sql = "UPDATE category SET title = '{$data['title']}',parent_id = {$data['parent_id']}WHERE id = {$data['id']}";
    return insertUpdateDelete($sql);
}
