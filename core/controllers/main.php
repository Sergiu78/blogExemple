<?php

function action_index(){
    if(is_auth()){
    echo 'Index page';
    }else{
       echo 'Hello guest';
    }
    
}

function action_contacts(){
    echo 'Contact page';
}

function action_registration(){
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $formData = [ 
        'login' => getSaveData(htmlspecialchars(trim($_POST['login']))),
        'password' => getSaveData(trim($_POST['password'])),
        'email' => getSaveData(trim($_POST['email']))
            ];
        
        $rules = [
            'login' => ['required', 'login'],
             'password' => ['required', 'password'],
             'email' => ['required', 'email']
        ];
        
        
        $errors = validateForm($rules, $formData);
        if(empty ($errors)){
            $formData['password'] = md5($formData['password'],SECRET_KEY);
            $sql = "INSERT INTO `user`(`login`,`password`,`email`) VALUES ('{$formData['login']}','{$formData['password']}','{$formData['email']}')";
            
            
            $sql1 = "SELECT id FROM user WHERE login = '{$formData['login']}' or email = '{$formData['email']}'";
            
            $res = selectData($sql1);
            
            if($res->num_rows === 0){
                if(insertUpdateDelete($sql)){
                     header("location: /main/successReg");
                }
            }else{
                echo 'login or email bo unique';
            }
            
        }
    }
    renderView('registration',$errors);
}

function action_successReg(){
   
}

function action_login(){
    if($_SERVER('REQUEST_METHOD') == 'POST'){
         $formData = [ 
        'login' => getSaveData(htmlspecialchars(trim($_POST['login']))),
        'password' => getSaveData(trim($_POST['password']))
             ];
         $formData['password'] = md5($formData['password'],SECRET_KEY);
          $sql1 = "SELECT id,role FROM user WHERE login = '{$formData['login']}' and password = '{$formData['password']}'";
            
            $res = selectData($sql1);
            if($res->num_rows === 0){
                echo 'Incorrect login or password';
                
            }else{
                $_SESSION['user'] = mysqli_fetch_assoc($res);
                header('location: /');
            }
    }
    renderView('login',[]);
}

function action_logout(){
    session_unset();
    session_destroy();
     header('location: /');
}