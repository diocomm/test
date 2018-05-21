window.onload = function() {
            // получаем данные из полей формы
            var email = document.querySelector('input[name = email]');
            var login = document.querySelector('input[name = login]');
            var name = document.querySelector('input[name = name]');
            var password = document.querySelector('input[name = password]');
            var confirmPassword = document.querySelector('input[name = confirmPassword]');
           
            document.querySelector('#submit').onclick = function() {
           // формируем строку для отправки на сервер
            var arrayParam = 'email=' + email.value + '&' + 'login=' + login.value + '&' + 'name=' + name.value + '&' + 'password=' + password.value + '&' + 'confirmPassword=' + confirmPassword.value;
            
            // вызываем метод и отправляем строку с параметрами
            ajaxPost(arrayParam);

            }

}
 //создаем объект obj XMLHttpRequest 
function ajaxPost (arrayParam) {

      var postRequest = new XMLHttpRequest();

      postRequest.onreadystatechange = function() {
              //Проверяем что есть ответ от сервера
              if  (postRequest.readyState == 4 && postRequest.status == 200) {
                var data = JSON.parse(postRequest.responseText);
    
                  // получаем от сервера JSON массив расшифровываем ошибки 
                  if (data["name"] == "erLen") {
                    document.querySelector('#nameResult').innerHTML = "Имя не может быть короче 2-х символов";
                  }  else {
                    document.querySelector('#nameResult').innerHTML = " ";
                  }


                  if (data["login"] == "loginNotFree") {
                    document.querySelector('#loginResult').innerHTML = "К сожалению такой логин уже занят"; 

                  }  else if (data["login"] == "erLen"){
                    document.querySelector('#loginResult').innerHTML = "Логин не может быть короче 2-х символов"; 

                  } else {
                    document.querySelector('#loginResult').innerHTML = " ";
                  }


                  if (data["email"] == "emailNotFree") {
                    document.querySelector('#emailResult').innerHTML = "К сожалению такой e-mail уже занят"; 

                  }  else if (data["email"] == "emailBadInput") {
                    document.querySelector('#emailResult').innerHTML = "E-mail имеет не верный формат";

                  } else {
                    document.querySelector('#emailResult').innerHTML = " ";
                  }


                  if (data["password"] == "passwLen") {
                    document.querySelector('#passwordResult').innerHTML = "Пароль не может быть меньше 6 символов"; 
                  }  else {
                    document.querySelector('#passwordResult').innerHTML = " ";
                  }


                  if (data["conpassword"] == "passwconError") {
                    document.querySelector('#confirmPasswordResult').innerHTML = "Пароли не совпадают"; 
                  }  else {
                    document.querySelector('#confirmPasswordResult').innerHTML = " ";
                  }
                  
                  // получаем от сервера JSON массив если все ОК перенаправляем пользоваетеля на страницу входа
                  if ( data["status"] == 'OK'){                    
                    
                      alert("Вы успешно зарегистрированы");
                      var urlRedirect = data["url"];
                      window.location.href = urlRedirect;
                  } 
              // пока ответа нет выводим надпись подождите... или анимацию
              } else  if (postRequest.readyState == 1 || postRequest.readyState == 2 || postRequest.readyState == 3){
                document.querySelector('#answer').innerHTML = "Waiting........";                
              
              }
              document.querySelector('#answer').innerHTML = " "; 

      }
       
      postRequest.open ('POST', 'reg');

      postRequest.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
      postRequest.send(arrayParam);
}