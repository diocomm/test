<!DOCTYPE html>

<html>

<head>

<meta charset="utf-8" />

<title>Authorization</title>


</head>

<body>

	<div>
			<div>
				<h1>Вход на сайт</h1>
			</div>
			<div>
				<p><a href="/">Главная</a></p>
			</div>

			<div>

				<form  id="auth">

					<p>Login <input name='login' type='text' required placeholder="Введите логин"></p>

					<p>Пароль <input name='password' type='password' required placeholder="Введите пароль"></p>

					<p><input id = "get_value" name='remember' type='checkbox' value='1'> Запомнить меня </p>
					
					<p>	<input id="submit" type='button' value='Войти'></p>

				<div id="answer" style="color:#FF0000";></div>
				

			</form></div>
			<div>
				<p><a href="register">Зарегистрироваться</a></p>
			</div>
	</div>
<script src="/js/scriptAuth.js"></script>

</body>

</html>







