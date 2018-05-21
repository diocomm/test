<?php

include_once ROOT. '/model/User.php';

    header('Content-Type: application/json');

    // Переменные из $_POST
    $login = ($_POST["login"]);
    $password = $_POST["password"];
    $confirmPassword = $_POST["confirmPassword"];
    $email = $_POST["email"];
    $name =  ($_POST["name"]);

    //переменная для передачи успешного завершения
    $param = false;
    
    // переменная для ошибок      
    $errors = false;
                
   //проверка данных на валидность
    if (!User::checkLen($name)) {
        $errors["name"] = "erLen";
    }  

      if (!User::checkLen($login)) {
        $errors["login"] = "erLen";
    }  

     if (!User::checkEmail($email)) {
         $errors["email"] = "emailBadInput";
     }
       
    if (!User::checkPassword($password)) {
        $errors["password"] = "passwLen";
    }

    if (User::checkConfirmPassword($password, $confirmPassword)) {
        $errors["conpassword"] = "passwconError";
    }

    if (User::validateEmailUniq($email)) {
        $errors["email"] = "emailNotFree";
    } 

    if (User::validateLoginUniq($login)) {
        $errors["login"] = "loginNotFree";
    } 
             
    if ($errors == false) {

        // Если ошибок нет Регистрируем пользователя                    
        User::register($login, $password, $email, $name);
     
        $param["status"] = "OK";
        $param["url"] = "http://test.flashraskraski.ru/user/login";

        echo json_encode($param, JSON_UNESCAPED_UNICODE);

    } else {

    // Иначе выдаем список ошибок                   
    echo json_encode($errors, JSON_UNESCAPED_UNICODE);
    }