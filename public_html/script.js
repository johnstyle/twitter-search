jQuery(function() {

    $('.spinner .btn:first-of-type').on('click', function() {
        var $input = $(this).parents('.spinner').find('input');
        $input.val(parseInt($input.val(), 10) + 1);
    });

    $('.spinner .btn:last-of-type').on('click', function() {
        var $input = $(this).parents('.spinner').find('input');
        $input.val(parseInt($input.val(), 10) - 1);
    });

    $('table.table').dataTable({
        'order': [[ 1, 'desc' ]],
        'columnDefs': [
            {'targets': 7, 'orderable': false },
            {'targets': 11, 'orderable': false }
        ]
    });
});
