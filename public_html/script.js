jQuery(function() {

    $('.spinner .btn:first-of-type').on('click', function() {
        var $input = $(this).parents('.spinner').find('input');
        $input.val(parseInt($input.val(), 10) + 1);
    });

    $('.spinner .btn:last-of-type').on('click', function() {
        var $input = $(this).parents('.spinner').find('input');
        $input.val(parseInt($input.val(), 10) - 1);
    });

    $('table.table').DataTable({
        "processing": true,
        "serverSide": true,
        "ajax": window.location.href +  '&action=datatable',
        "columns": [
            { "data": "screen_name" },
            { "data": "followers_count" },
            { "data": "friends_count" },
            { "data": "statuses_count" },
            { "data": "favourites_count" },
            { "data": "following" },
            { "data": "following_back" },
            { "data": "verified" },
            { "data": "lang" },
            { "data": "location" },
            { "data": "description" },
            { "data": "created_at" },
            { "data": "following_date" },
            { "data": "following_back_date" },
            { "data": "last_status" },
            { "data": "actions" }
        ],
        'order': [[ 1, 'desc' ]],
        'columnDefs': [
            {'targets':10, 'orderable': false, 'visible': false },
            {'targets': 15, 'orderable': false }
        ]
    });

});
