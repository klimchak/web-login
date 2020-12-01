$(document).ready(function() {
                                                                                        /* описание функций */
    // растяшивание блока по высоте
    function getSetHeight(){
        let heightNav = $("#nav").css('height');
        let heightScreen = document.documentElement.scrollHeight;
        $("#mainBlock").css('height', heightScreen - heightNav.substr(0, 2));
    }
    // проверка данных в инпуте
    function checkInput(string, type){
        if (type === 'login'){
            pattern = /(?!.*[\.\-\_]{2,})^[a-zA-Z0-9\.\-\_]{6,24}$/gm;
            return pattern.test(string);
        }
        if (type === 'password' || type === 'repassword'){
            pattern = /^(?=[\x21-\x7E]*[0-9])(?=[\x21-\x7E]*[A-Z])(?=[\x21-\x7E]*[a-z])(?=[\x21-\x7E]*[\x21-\x2F|\x3A-\x40|\x5B-\x60|\x7B-\x7E])[\x21-\x7E]{6,}$/;
            return pattern.test(string);
        }
        if (type === 'email'){
            pattern = /[a-z0-9!#$%&'*+/=?^_`{|}~-]+(?:\.[a-z0-9!#$%&'*+/=?^_`{|}~-]+)*@(?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])?\.)+[a-z0-9](?:[a-z0-9-]*[a-z0-9])?/g;
            return pattern.test(string);
        }
        if (type === 'fname'){
            pattern = /[a-zA-Zа-яА-Я{2,18}]{4,8}/gm;
            return pattern.test(string);
        }

    }
    // функция удаления кук
    function delete_cookie (cookie_name){
        let cookie_date = new Date ( );
        cookie_date.setTime ( cookie_date.getTime() - 1 );
        document.cookie = cookie_name += "=; expires=" + cookie_date.toGMTString();
    }
    // валидация по нажатию
    function validOnKey(inputId, typeValidateDate, typeHelp){
        $(inputId).keypress(function () {
            let idHelp = '#' + typeHelp + 'Help';
            let sd = checkInput($(this).val(), typeValidateDate);
            if (sd === false){
                $(idHelp).removeClass('text-hide');
                // delete_cookie(typeHelp);
            }else {
                $(idHelp).addClass('text-hide');
                // document.cookie = typeHelp + "=" + true;
            }
        })
    }

    // запрос на отправку формы серверу
    function sendData(form, url){
        $(form).submit(function () {
            let str = $(this).serializeArray(); // получили поля
            let index, len, pass;
            len = str.length;
            // валидация данных
            for (index = 0;  index < len; ++index){
                if (str[index]['name'] === 'password'){
                    pass = str[index]['value'];
                }
                if (str[index]['name'] === 'repassword'){
                    if (pass !== str[index]['value']){
                        alert('Пароли не совпадают');
                        return false;
                        break;
                    }
                }
                if (!checkInput(str[index]['value'], str[index]['name'])) {
                    alert('Ошибка ввода данных поля ' + str[index]['name']);
                    return false;
                    break;
                }
            }
            // аякс запрос к серверу
            $.ajax({
                type: "POST",
                url: url,
                data: str,
                success: function(data){
                        let sourceLink = JSON.parse(data);
                        console.log(data);
                        console.log(sourceLink);
                        if (sourceLink['link']){
                            window.location.href = sourceLink['link'];
                        }
                        if (sourceLink['unic_login']) {
                            $('#loginHelp').removeClass('text-hide');
                        }
                        if (sourceLink['unic_email']) {
                            $('#emailHelp').removeClass('text-hide');
                        }
                        if (sourceLink['password_err']) {
                            $('#loginHelp').removeClass('text-hide');
                        }
                        if (sourceLink['regex_email']) {
                            $('#emailHelp').removeClass('text-hide');
                        }
                }
            });
            return false;
        })
    }

                                                                                         /* работа со страницей */

    $('#regAct').attr('type', 'submit');
    $('#logAct').attr('type', 'submit');

    // растягиваем блок по высоте
    getSetHeight();
    // валидируем данные по нажатию
    validOnKey('#InputLogin', 'login', 'login')
    validOnKey('#InputPassword1', 'password', 'password')
    validOnKey('#InputEmail', 'email', 'email')
    validOnKey('#InputName', 'login', 'name')




    sendData('#regForm', './register.php');
    sendData('#loginForm', './login.php');


});