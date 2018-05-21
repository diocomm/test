<?php
include_once ROOT.'/controllers/SiteController.php';
// UserController
 
class UserController {
   
     // Action for  User
     
    // загрузка формы регистрации
    public function actionRegister() {

		require_once(ROOT . '/view/user/register.php');
        return true;
    }

	// загрузка формы авторизации
    public function actionLogin() {

		SiteController::verifiCookie ();

		require_once(ROOT . '/view/user/login.php');
	
        return true;
    }

    // обработчик формы авторизации
	 public function actionAuth() {

		require_once(ROOT . '/loader/LoginLoader.php');
		
        return true;

	 }

	 // обработчик формы регистрации
	public function actionReg() {

		require_once(ROOT . '/loader/RegistrationLoader.php');
		
        return true;

	 }
     // загрузка кабинета пользователя
	 public function actionCabinet() {
        if (isset($_SESSION['auth']) != false) {

            if ($_SESSION['auth'] != false) {

                require_once (ROOT.'/view/cabinet/index.php');
            }

        } else {

       header("Location: /user/login");  
	 	
	 }
	 return true;
}
    //Выход из кабинета пользователя
	public function actionExit() {

        // удаляем cookie
        setcookie('cookie', '', time() - 3600, '/');
        setcookie('login', '', time() - 3600, '/');
        setcookie('PHPSESSID', '', time() - 3600, '/');
       
        // Удаляем информацию о пользователе из сессии
        session_destroy();
        
        // Перенаправляем пользователя на главную страницу
        header("Location: /");
    }

}    