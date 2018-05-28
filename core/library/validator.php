<?php

function required($data){
    return true;
}

function email($data){
    return true;
}

function password(){
    return true;
}

function login(){
    return true;
}

function validateForm($dataWithRules,$data){
    $errorForms = [];
    $fields = array_keys($dataWithRules);
    
    foreach($fields as $fieldName){
        $fieldData = $data[$fieldName];
        $rules = $dataWithRules[$fieldName];
        foreach($rule as $ruleName){
            if(!$ruleName($fieldData)){
                $errorForms[$fieldName][] = $ruleName;
            }
        }
        
    }
    return $errorForms;
}