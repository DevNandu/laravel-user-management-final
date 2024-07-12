$(document).ready(function() {
    function updateResults(url, data) {
        $.ajax({
            url: url,
            method: 'GET',
            data: data,
            success: function(response) {
                $('#user-grid').html($(response).find('#user-grid').html());
                $('.pagination').html($(response).find('.pagination').html());
            }
        });
    }

    $('#search').on('keyup', function() {
        updateResults(window.location.href, { search: $(this).val() });
    });

    $('#reset').on('click', function() {
        $('#search').val('');
        updateResults(window.location.href);
    });

    $(document).on('click', '.pagination a', function(e) {
        e.preventDefault();
        updateResults($(this).attr('href'));
    });

    $('#export-csv').on('click', function() {
        window.location.href = '/export-csv';
    });
});
