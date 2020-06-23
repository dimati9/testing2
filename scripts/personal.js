jQuery(document).ready(function ($) {
    getItems();

    // Добавление пользователя
    $('.add_new').on('click', function (e) {
        e.preventDefault();
        $('.add-form').show();
    })
    $('.add-from__close').on('click', function () {
        $('.add-form').hide();
    });
    $('.edit-from__close').on('click', function () {
        $('.edit-form').hide();
    });

    $('.add-form').on('submit', function(e){
        e.preventDefault();
        if($('.add_name').val().length <= 0) {
            $('.add_name').css('border', '1px solid red');
            setTimeout(function () {
                $('.add_name').css('border', '1px solid gray');
            }, 1000)
            return true;
        }
        if($('.add_phone').val().length <= 0) {
            $('.add_phone').css('border', '1px solid red');
            setTimeout(function () {
                $('.add_phone').css('border', '1px solid gray');
            }, 1000)
            return true;
        }
        var $that = $(this),
            formData = new FormData($that.get(0));
        $.ajax({
            'url': '/ajax/addContact.php',
            'type': 'POST',
            contentType: false, // важно - убираем форматирование данных по умолчанию
            processData: false, // важно - убираем преобразование строк по умолчанию
            data: formData,
            success: function(json){
                if(json){
                    json = JSON.parse(json);
                    if(json.status == 'ok') {
                        $('.add-form').hide();
                        showText("Запись добавлена!");
                        getItems();
                    } else {
                        showText(json.message);
                    }
                }
            }
        });
    })


    function getItems($text = "") {
        let id = $('.main-table').attr('data-id');
        $.ajax({
            'url': '/ajax/getAll.php',
            'type': 'GET',
            data: {'id': id, 'text': $text},
            success: function (json) {
                if (json) {
                    let elements = null;
                    object = JSON.parse(json);
                        if(object.items.length > 0) {
                            elements = JSON.parse(object.items);
                        }

                    if (object.status == 'ok' && elements != null) {
                        let items = '';
                        elements.forEach(function (item, i, arr) {
                            items += `<tr>
    <th data-id="${item.id}" scope="row">${item.name} ${item.lastName}</th>
<td>${item.phone}</td>
<td>${item.email}</td>
<td><button class="edit">Изменить</button></td>
<td><button class="remove">Удалить</button></td>
</tr>`
                        });
                        $('.main-tbody').html(items);

                        $('.remove').on('click', function (e) {
                            showText("Удаление...");
                            e.preventDefault();
                            let id = $(this).parents('tr').find('th').attr('data-id');
                            $.ajax({
                                'url': '/ajax/removeContact.php',
                                'type': 'GET',
                                data: {'id': id},
                                success: function (json) {
                                    if (json) {
                                        object = JSON.parse(json);
                                        if (object.status == 'ok') {
                                            showText("Запись удалена!");
                                            getItems();
                                        } else {
                                            showText(object.message);
                                        }
                                    } else {
                                        console.log('error');
                                    }
                                }
                            })
                        });

                        $('.edit').on('click', function (e) {
                            showText("Загружаем...");
                            e.preventDefault();
                            let id = $(this).parents('tr').find('th').attr('data-id');
                            $.ajax({
                                'url': '/ajax/getContact.php',
                                'type': 'GET',
                                data: {'id': id},
                                success: function (json) {
                                    if (json) {
                                        $('.edit-form').show();
                                        object = JSON.parse(json);
                                        let contact = JSON.parse(object.item);
                                        if (object.status == 'ok') {
                                            $('.edit_name').val(contact.name);
                                            $('.edit_lastName').val(contact.lastName);
                                            $('.edit_email').val(contact.email);
                                            $('.edit_phone').val(contact.phone);
                                            $('.contactId').val(id);
                                            $('.edit_phoneText').attr('data-text', contact.phoneText);
                                            if(contact.image != "") {
                                                $('.edit_images').html(`<img src="/${contact.image}">`);
                                            }
                                        } else {
                                            $('.edit-form').hide();
                                            showText(object.message);
                                        }
                                    } else {
                                        console.log('error');
                                    }
                                }
                            })
                        });
                        $('.edit_phoneText').on('click', function (e) {
                            e.preventDefault();
                            showText($(this).attr('data-text'), 1);
                        });


                        $('.edit-form').on('submit', function(e){
                            e.preventDefault();
                            if($('.edit_name').val().length <= 0) {
                                $('.edit_name').css('border', '1px solid red');
                                setTimeout(function () {
                                    $('.edit_name').css('border', '1px solid gray');
                                }, 1000)
                                return true;
                            }
                            if($('.edit_phone').val().length <= 0) {
                                $('.edit_phone').css('border', '1px solid red');
                                setTimeout(function () {
                                    $('.edit_phone').css('border', '1px solid gray');
                                }, 1000)
                                return true;
                            }
                            var $that = $(this),
                                formData = new FormData($that.get(0));
                            $.ajax({
                                'url': '/ajax/editContact.php',
                                'type': 'POST',
                                contentType: false, // важно - убираем форматирование данных по умолчанию
                                processData: false, // важно - убираем преобразование строк по умолчанию
                                data: formData,
                                success: function(json){
                                    if(json){
                                        json = JSON.parse(json);
                                        if(json.status == 'ok') {
                                            $('.edit-form').hide();
                                            showText("Запись изменена!");
                                            getItems();
                                        } else {
                                            showText(json.message);
                                        }
                                    }
                                }
                            });
                        })

                    } else {
                        $('.main-tbody').html('<h3>Список пуст</h3>')
                    }
                }
            }
        });
    }

    $('.clear-search').on('click', function (e) {
        e.preventDefault();
        $('.search-text').val("");
        getItems();
    });

    $('.search').on('click', function (e) {
        e.preventDefault();
        $search = $('.search-text');
        if($search.val().length > 0) {
            getItems($search.val());
        } else {
            getItems();
        }

    });

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
