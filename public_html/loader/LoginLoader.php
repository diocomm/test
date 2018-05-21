<?php   
include_once ROOT.'/model/User.php';
header('Content-Type: application/json');
      
        // Обработка формы
    if (isset($_POST['login'])) {
    
        // Если форма отправлена 
        // Получаем данные из формы
       
        $login = $_POST['login'];
        $password = $_POST['password'];
        $remember = $_POST['remember'];

        //Для для возвращаемых параметров
        $param = false;
        //Для  ошибок
        $errors = false;

        // Валидация полей

        $userCheck = User::checkUserData($login, $password);

        if ($userCheck == false) {
          
          // Если данные неправильные - показываем ошибку
            $errors["err"] = "Неправильные логин или пароль для входа на сайт";

            // передаем ошибки если есть  в JSON
            if ($errors != false) {

                echo json_encode($errors, JSON_UNESCAPED_UNICODE); 

            }

        // Если данные правильные, авторизуем пользователя
        } else if ($userCheck == true) { 

            //Сформируем случайную строку для cookie (используем функцию generateSalt):     
            $keySalt = User::generateSalt();  

            //получаем Id если надо, имя, логин
            $userData = User::getUserData($login);      

            //Пишем в сессию информацию о том, что мы авторизовались id и name берем из userData.
            $_SESSION['auth'] = true;
            $_SESSION['id'] = $userData['id'];
            $_SESSION['name'] = $userData['name'];
                 
            //Проверяем если установлен chekbox(запомнить) то записываем cookie на компьютер пользоваетля 
            if ( !empty($_REQUEST['remember']) and $_REQUEST['remember'] == 1 ) {
                       
                //записываем cookie  время жизни = 30 дней
                setcookie('login', $userData['login'], time() + 86400 * 30, '/'); //логин
                setcookie('cookie', $keySalt, time() + 86400 * 30, '/'); //случайная строка salt
                $sessionId = $_COOKIE['PHPSESSID'];//Id сессии
                
                //передаем cookie в базу данных для данного пользователя
                User::cookieUpdate($keySalt, $login, $sessionId);
            }
                // Такой пользователь есть отправляем  статус OK и url                
                $param["status"] = "OK";
                $param["url"] = "http://test.flashraskraski.ru/user/cabinet";
                echo json_encode($param);
        }                    

    }

 