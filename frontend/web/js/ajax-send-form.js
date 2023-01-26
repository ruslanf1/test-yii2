$('#button').on('click', function (e) {
    const token = $('#jsonform-token').val()
    const json = $('#jsonform-json').val()
    const method = $('#jsonform-method option:selected').text()
    e.preventDefault()

    $.ajax({
        url: 'index.php?r=site/index',
        type: method,
        headers: {Auth: token},
        data: {json: json},
        dataType: 'json'
    }).done(function (response) {
        $('#json-form').html(response)
    }).fail(function () {
            alert('Данные не введены или неверны')
        })
})