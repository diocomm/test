<!DOCTYPE html>

<html>

<head>

<meta charset="utf-8" />

<title>Registration</title>

</head>

<body>
	<div>
		<div>
			<h1>Регистрация пользователя</h1>
		</div>
		<div>
				<p><a href="/">Главная</a></p>
		</div>
		<div><p>Если вы не зарегистрированы пройдите регистрацию</p>
			
		<form  id="regis">
		
			<div id="answer" style="color:#FF0000";></div>

			<p>Логин*<input name='login' type='text' required placeholder="Введите логин"><output id="loginResult" style="color:#FF0000";></output></p>

			<p>Парооль*<input name='password' type='password' required placeholder="Введите пароль"><output id="passwordResult" style="color:#FF0000";></output></p>

			<p>Подтвердите пароль*<input name='confirmPassword' type='password' required placeholder="Введите пароль ещё раз" ><output id="confirmPasswordResult" style="color:#FF0000";></output></p>

			<p>E-mail*<input name='email' type='email' required placeholder="Введите ваш e-mail"><output id="emailResult" style="color:#FF0000";></output></p>

			<p>Имя*<input name='name' type='text' required placeholder="Введите ваше имя"><output id="nameResult" style="color:#FF0000";></output></p>

			<p>	<input id="submit" type='button' value='Зарегистрироваться'></p>

			<p>Поля отмеченые * - обязательные к заполнению</p>

		</form></div>


	</div>
	

<script src="/js/scriptReg.js"></script>

</body>

</html>
