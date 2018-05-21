<?php

 // Класс User - для работы с пользователями и обработка запросов в БД

class User

{
     // Регистрация пользователя 
    public static  function register ($login, $password, $email, $name) {

        // Хэшируем первоначальный пароль
        $hash = md5($password); 
        $salt = User::generateSalt(); // Соль

        // Солим пароль =( хэш с солью )и ещё раз хэшируем
        $password = md5($hash . $salt);        

        $simxml = simplexml_load_file("user.xml");

        //auto-increment для id в БД
        $autoincrement = $simxml->auto;

        // создаем учетную запись вБД
        $user = $simxml->addChild('user');
        $user->addChild('id', $autoincrement);
        $user->addChild('login', $login);
        $user->addChild('email', $email);
        $user->addChild('password', $password);
        $user->addChild('name', $name);
        $user->addChild('salt', $salt);
        $user->addChild('sessionid', 'none');
        $user->addChild('cookie', 'none');

        $simxml->auto = $autoincrement + 1;

        file_put_contents("user.xml", $simxml->asXML());

    }

    // генерация соли 
    public static function generateSalt() {

        $salt = '';
         //длина соли 8
        for ($i = 0; $i < 8; $i++) {
            //символы ASCII
            $salt .= chr(mt_rand( 33, 126 )); 
        }
        return $salt;
    }

    //Запись cookie в БД
    public static function cookieUpdate($key, $login, $sessionId) {

        $simxml = simplexml_load_file("user.xml");

        foreach($simxml->xpath("//user[login ='$login']") as $res) {
            $res->cookie = $key;
             $res->sessionid = $sessionId;
        }
        
        file_put_contents("user.xml", $simxml->asXML());

    }

     // Проверяем существует ли пользователь с заданными $email и $password
    public static function checkUserData($login, $password) {        
       
        $simxml = simplexml_load_file("user.xml");
        foreach($simxml->xpath("//user[login ='$login']") as $res) {
            
            //сравниваем пароль с соленым паролем из БД
            $salt = $res->salt;
            $hash = md5($password);
            $passwordSalt = md5($hash.$salt);

            if  ($res->password == $passwordSalt) {
                return true;
        }
        return false;    
        }

    }    

    //получаем данные о пользоваетле из БД 
    public static function getUserData($login) {

        $simxml = simplexml_load_file("user.xml");
        $arr = array();
        foreach($simxml->xpath("//user[login ='$login']") as $res) {
                 
            $arr["id"] = (string)$res->id;
            $arr["name"] = (string)$res->name;
            $arr["login"] = (string)$res->login;
            $arr["sessionid"] = (string)$res->sessionid;

        }
        return $arr;      
     }   

	//проверяем есть ли такой email в БД
    public static function validateEmailUniq($email) {
            
        $simxml = simplexml_load_file("user.xml");

        foreach($simxml->xpath("//user[email ='$email']") as $res) {

            if ($res->email == $email){
                return true;
            } 
        }
        return false;
    }

  //проверяем есть ли такой логин в БД
    public static function validateLoginUniq($login) {

        $simxml = simplexml_load_file("user.xml");

        foreach($simxml->xpath("//user[login ='$login']") as $res) {

            if ($res->login == $login) {
                return true;
            } 
        }
        return false;
    }   

    //Проверка cookie на соответсвие в БД
    public static function checkCookie($key, $login) {
    
        $simxml = simplexml_load_file("user.xml");

        foreach($simxml->xpath("//user[login ='$login']") as $res) {

            if ($res->login == $login && $res->cookie == $key){
                return true;
            } 
        }
        return false;
    }

    //Проверяет поле: не меньше, чем 2 символа
    public static function checkLen($name) {

        if (strlen($name) >= 2) {
            return true;
        }
        return false;
    }

    //Проверяем Длинну пароля
    public static function checkPassword($password) {

        if (strlen($password) >= 5) {
            return true;
        }
        return false;
    }

    // Проверка паролей 
    public static function checkConfirmPassword($password, $confirmPassword) {

        if ($password != $confirmPassword) {
            return true;
        }
        return false;
    }
    // Проверка правильности email
    public static function checkEmail($email) {

        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return true;

        }
        return false;
    }

}