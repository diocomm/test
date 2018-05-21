<?php
include_once ROOT.'/model/User.php';

 //SiteController
 
class SiteController {

    
    // Action для главной страницы
     
    public function actionIndex() {

        SiteController::verifiCookie ();

    
        require_once(ROOT.'/view/site/index.php');

        return true;
    }
   
    //функция проверки cookie в БД
    public static function verifiCookie () {
     
      if (isset($_SESSION['auth'])) {
        if ($_SESSION['auth'] == true){
        header("Location: /user/cabinet");
        }
    }
              if ( !empty($_COOKIE['login']) and !empty($_COOKIE['cookie']) ) {

                  //запрос в базу данных ответ кладем в $result:
                  $result = User::checkCookie($_COOKIE['cookie'], $_COOKIE['login']); 
                  
                  //проверка, если вернулась true то куки и логин подходят
                  if ($result == true) {
                    $userData = User::getUserData($_COOKIE['login']);
                    //возобнавляем сессию
                    setcookie('PHPSESSID', $userData['sessionid'], time() + 86400 * 30, '/' );

                      header("Location: /user/cabinet");
                      
                  }

              }
 
    }
}




