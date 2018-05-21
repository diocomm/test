<!DOCTYPE html>

<html>

<head>

<meta charset="utf-8" />

<title>Кабинет пользователя</title>

</head>

<body>
	<div>
		<div>
			<h1>Кабинет пользователя</h1>
		</div>
		<div>
			<p><?php echo 'Hello '.$_SESSION['name'];?></p>
			
			<p><a href="/user/exit">Выход</a></p>	
		</div>
	</div>

</body>

</html>