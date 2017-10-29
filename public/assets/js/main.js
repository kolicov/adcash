/*price range*/

var RGBChange = function () {
    $('#RGB').css('background', 'rgb(' + r.getValue() + ',' + g.getValue() + ',' + b.getValue() + ')')
};

$(function () {
    $('#submitLogin').click(function (e) {
        e.preventDefault();
        $('form#login').submit();
    });
})

$('form#login').ajaxForm({
    dataType: 'json',
    success: function (data) {
        if (data.hasError == false) {
            location.reload();
        } else {
            $('.modal-body').append('Грешно потребителско име или парола')
        }
    }
});

$('form#send').ajaxForm({
    dataType: 'json',
    success: function (data) {
        $('form#send').append(data);
    }
});

$('form#registration').submit(function () {
    var form = $(this);
    $.ajax({
        url: "/registration",
        dataType: 'json',
        type: "POST",
        data: $(this).serialize(),
        success: function (data) {
            if (data.hasError == true) {
                form.prepend(data.message);
            } else {
                if (data.redirect != undefined) {
                    window.location.href = data.redirect;
                }
            }
//            $('#closeTestMeilBox').click();
        }
    });
    return false;
})

$('.update').click(function (e) {
    e.preventDefault();
    var url = $(this).attr('href');
    $.ajax({
        url: url,
        dataType: 'json',
        success: function (data) {
            if (data.hasError == true) {
                form.prepend(data.message);
            } else {
//                if (data.redirect != undefined) {
                window.location.href = '/Кошница';
//                }
            }
        }
    });
})

$('.cart_quantity_delete').click(function (e) {
    e.preventDefault();
    var button = $(this);
    var url = $(this).attr('href');
    $.ajax({
        url: url,
        dataType: 'json',
        success: function (data) {
            button.parent('td').parent('tr').remove();
        }
    });
});

$('.cart_quantity_up').click(function (e) {
    e.preventDefault();
    $(this).next().attr('value', parseInt($(this).next().attr('value')) + 1);

    console.log($(this).parent().parent().prev().html().replace('<p>', '').replace('</p>', '').replace('Цена: ', ''));

    var totalPrice = parseFloat($(this).parent().parent().prev().html().replace('<p>', '').replace('</p>', '').replace('Цена: ', '')) * parseFloat($(this).next().attr('value'));
    $(this).parent().parent().next().children('.cart_total_price').html('Цена: ' + totalPrice + ' лв.');
})

$('.cart_quantity_down').click(function (e) {
    e.preventDefault();
    if (parseInt($(this).prev().attr('value')) != 0) {
        $(this).prev().attr('value', parseInt($(this).prev().attr('value')) - 1);
        var totalPrice = parseFloat($(this).parent().parent().prev().html().replace('<p>', '').replace('</p>', '').replace('Цена: ', '')) * parseFloat($(this).prev().attr('value'));
        $(this).parent().parent().next().children('.cart_total_price').html('Цена: ' + totalPrice + ' лв.');
    }
})

$("#order").validate({
    rules: {
        first_name: "required",
        last_name: "required",
        phone: "required",
        address: "required",
        email: {
            required: true,
            email: true
        },
    },
    messages: {
        first_name: "Моля въведете име",
        last_name: "Моля въведете фамилия",
        phone: "Моля въведете телефон за връска",
        address: "Моля въведете адрес за доставка",
        email: "Моля въведете валиден имейл",
    }
});