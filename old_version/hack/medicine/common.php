<?php session_start(); // Стартуем сессию
if (isset($_POST['submit'])) { // Отлавливаем нажатие кнопки "Отправить"
	if (empty($_POST['login'])) // Если поле логин пустое
		{
//		echo '<script>alert("Поле логин не заполненно");</script>'; // То выводим сообщение об ошибке
	}
	elseif (empty($_POST['pass'])) // Если поле пароль пустое
		{
//		echo '<script>alert("Поле пароль не заполненно");</script>'; // То выводим сообщение об ошибке
	}
	else{ // Иначе если все поля заполненны
		$login = $_POST['login']; // Записываем логин в переменную
		$password = $_POST['pass']; // Записываем пароль в переменную
		$query = mysql_query("SELECT * FROM `users` WHERE `login` = '$login' AND `password` = '$password'"); // Формируем переменную с запросом к базе данных с проверкой пользователя
		$result = mysql_fetch_array($query); // Формируем переменную с исполнением запроса к БД
		if (empty($result['id'])) // Если запрос к бд не возвразяет id пользователя
			{
			echo '<script>alert("Неверные Логин или Пароль");</script>'; // Значит такой пользователь не существует или не верен пароль
		}
		else // Если возвращяем id пользователя, выполняем вход под ним
			{
			$_SESSION['doc_password'] = $password; // Заносим в сессию  пароль
			$_SESSION['doc_login'] = $login; // Заносим в сессию  логин
			$_SESSION['doc_id'] = $result['id']; // Заносим в сессию  id
			$_SESSION['doc_user_name'] = $result['user_name']; // Заносим в сессию имя пользователя
			$_SESSION['doc_user_rights'] = $result['user_rights']; // Заносим в сессию права пользователя
		}
	}
}

if (!isset($_SESSION['doc_login']) || !isset($_SESSION['doc_id'])){ // если в сессии не загружены логин и id
//вход не произведен
}
if (isset($_SESSION['doc_login']) && isset($_SESSION['doc_id'])){ // если в сессии загружены логин и id
//вход произведен
}
if($_SESSION['doc_user_rights']){define('USER_RIGHTS', $_SESSION['doc_user_rights']);}
else{define('USER_RIGHTS', '0');}
if (isset($_REQUEST['exit'])) { // если вызвали переменную "exit"
	unset($_SESSION['doc_password']); // Чистим сессию пароля
	unset($_SESSION['doc_login']); // Чистим сессию логина
	unset($_SESSION['doc_id']); // Чистим сессию id
	unset($_SESSION['doc_user_name']); // Чистим сессию id
	unset($_SESSION['doc_user_rights']); // Чистим сессию id
	define('USER_RIGHTS', '0');
}
?>