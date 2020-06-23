jQuery(document).ready(function($) {

    // jquery mask для импутов
    $("input[name=number]").mask("+7 (999) 999-99-99");


    $('.btn-register').on('click', function () {
        $('.auth-form').hide();
        $('.register-block').show();
    })
    $('.btn-auth').on('click', function () {
        $('.auth-form').show();
        $('.register-block').hide();
    })
    $('.mobile-menu').on('click', function () {
        $('.navbar-mobile-menu').show();
        $('.mobile-menu').hide();
        $('.mobile-menu-close').show();
    })
    $('.mobile-menu-close').on('click', function () {
        $('.navbar-mobile-menu').hide();
        $('.mobile-menu').show();
        $('.mobile-menu-close').hide();
    });


    // Проверка форм
    $('.register-form').find('input[type=submit]').on('click', function (e) {
        e.preventDefault();
        let good = true;
        let regexpLogin = /^[aA-zZ0-9\s]+$/i;
        let regexpEmail = /^([a-z0-9_-]+\.)*[a-z0-9_-]+@[a-z0-9_-]+(\.[a-z0-9_-]+)*\.[a-z]{2,6}$/gm;
        let regexpPassword = /^(?=.*[0-9])(?=.*[a-zA-Z])[a-zA-Z0-9]+$/gm;
        let $login = $('.register-form').find($('input[name=login]'));
        let $email = $('.register-form').find($('input[name="email"]'));
        let $password = $('.register-form').find($('input[name="password"]'));
        let $repassword = $('.register-form').find($('input[name="repassword"]'));
        if(!regexpLogin.test($login.val())) {
            e.preventDefault();
            good = false;
            $login.parents('.input-group').find('.input-group__text').css('color', 'red');
            $login.parents('.input-group').find('.input-group__text').css('fontSize', '18px');
            $login.css('border', '2px solid red');
            setTimeout(function () {
                $login.parents('.input-group').find('.input-group__text').css('color', 'cornflowerblue');
                $login.parents('.input-group').find('.input-group__text').css('fontSize', '15px');
                $login.css('border', '1px solid gray');
            }, 1500);
        }
        if(!regexpPassword.test($password.val())) {
            e.preventDefault();
            good = false;
            $password.parents('.input-group').find('.input-group__text').css('color', 'red');
            $password.parents('.input-group').find('.input-group__text').css('fontSize', '18px');
            $password.css('border', '2px solid red');
            setTimeout(function () {
                $password.parents('.input-group').find('.input-group__text').css('color', 'cornflowerblue');
                $password.parents('.input-group').find('.input-group__text').css('fontSize', '15px');
                $password.css('border', '1px solid gray');
            }, 1500);
        } else if($password.val() != $repassword.val()) {
            e.preventDefault();
            good = false;
            $password.css('border', '2px solid red');
            $repassword.css('border', '2px solid red');
            $repassword.parents('.input-group').find('.input-group__text').text("Пароли не совпадают");
            $repassword.parents('.input-group').find('.input-group__text').show();
            $repassword.parents('.input-group').find('.input-group__text').css('color', 'red');
            setTimeout(function () {
                $repassword.parents('.input-group').find('.input-group__text').hide();
                $password.css('border', '1px solid gray');
                $repassword.css('border', '1px solid gray');
            }, 1500)
        }
        if(!regexpEmail.test($email.val())) {
            console.log('nook');
            e.preventDefault();
            good = false;
            console.log($email);
            $email.css('border', '2px solid red');
            setTimeout(function () {
                $email.css('border', '1px solid gray');
            }, 1500);
        } else {
            console.log('ok');
        }
        if(good) {
            $('.register-form').submit();
        } else {
            return false;
        }
    })




    $('.modal-ok').on('click', function (e) {
        e.preventDefault();
        $('.warnings').hide('fast');
    })
    $('.delete-photo').on('click', function (e) {
        $this = $(this);
        e.preventDefault();
        showText('Успешно удалено!', 1);
        $id = $(this).attr('data-id');
        $.ajax({
            'url': '/ajax/deletePhoto.php',
            'type': 'GET',
            data: {'id': $id},
        }).done( function (data) {
            data = JSON.parse(data);
            console.log(data);
            if (data.status == 'error') {
                alert(data.text);
            } else {
                $this.parent('li').remove();
            }
        }, 'json').fail(
            function (data) {
                alert('Не удалось получить файл: ' + data.responseText);
            });


    })

    function showText(text, ok = 0) {
        $('.warnings').show();
        $('.modal-text').text(text);
        if(ok == 1) {
            $('.modal-ok').show();
        } else {
            setTimeout(function () {
                $('.warnings').hide();
            },2000)
        }
    }

});

