$(document).on('submit', '#json-form', function (e) {
    e.preventDefault()
    const token = $('#jsonform-token').val()
    const json = $('#jsonform-json').val()
    const method = $('#jsonform-method option:selected').text()

    $.ajax({
        url: '/form',
        type: method,
        headers: {Auth: token},
        data: {json: json},
    }).done(function (response) {
        $('#json-form').html(response)
    }).fail(function () {
            alert('Данные не введены или неверны')
        })
})