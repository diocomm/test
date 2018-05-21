window.onload = function() {
      // получаем данные из полей формы
          var login = document.querySelector('input[name = login]');
          var password = document.querySelector('input[name = password]');

          document.querySelector('#submit').onclick = function() {
                  //проверяем checkbox запомнить меня
              var remember = document.querySelector('input[name = remember]');
                  
                  if (remember.checked == false) {
                      rememberValue = 0;
                  } else {
                      rememberValue = 1;
                  }
              // формируем строку для отправки на сервер
              var arrayParam = 'login=' + login.value + '&' + 'password=' + password.value + '&' + 'remember=' + rememberValue;
              // вызываем метод и передаем строку с параметрами
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
                      
                      //  выводим ошибку
                      document.querySelector('#answer').innerHTML = data["err"];
                      // получаем от сервера JSON массив если все ОК перенаправляем пользоваетеля в личный кабинет
                      if (data["status"] == 'OK'){
                                            
                          alert("Вы успешно авторизованы");
                          var urlRedirect = data["url"];
                          window.location.href = urlRedirect;
                      } 
                      // пока ответа нет выводим надпись подождите... или анимацию      
                  } else if (postRequest.readyState == 1 || postRequest.readyState == 2 || postRequest.readyState == 3  ) {
                        
                      document.querySelector('#answer').innerHTML = "Waiting........";
                       
                  }

          }
      //Отправляем POST на сервер
      postRequest.open('POST', 'auth');
      postRequest.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
      postRequest.send(arrayParam);
}