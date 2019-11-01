$(function () {
    //export data
    let action_btn = $('.action-btn');
    let period_selector = $('#period');
    let token_selector = $('#token');
    let url_selector = $('#url');
    let table_data = $('#table_data');
    let table_generate = $('#table_generate');
    let csv_export = $('#csv_export');

    period_selector.on('change', function () {
        let period = period_selector.val();
        if (period !== '') {
            action_btn.removeClass('disabled');
            action_btn.prop('disabled', false);
        } else {
            action_btn.addClass('disabled');
            action_btn.prop('disabled', true);
        }

        table_data.html('');
    });

    //send filter data
    table_generate.on('click', function () {
        let period_arr = [];
        let period = period_selector.val();
        if (period !== '') {
            period_arr = period.split('-');

            let year = period_arr[0];
            let month = period_arr[1];

            let token = token_selector.val();
            let url = url_selector.val();

            table_data.html('');

            $.post(url + "/generate_table", {year: year, month: month, _token: token})
                .done(function (data) {
                    table_data.html(data);

                    let $tr = $('#report_table tr.no-sort'); //get the reference of row with the class no-sort
                    let exclude_last_row = $tr.prop('outerHTML'); //get html code of tr
                    $tr.remove();

                    $('#report_table').DataTable({
                        "aaSorting": [],
                        paging: false,
                        "fnDrawCallback": function () {
                            //add the row with 'append' method: in the last children of TBODY
                            $('#report_table tbody').append(exclude_last_row);
                        }
                    });
                });
        } else {
            return false;
        }
    });

    csv_export.on('click', function (e) {
        e.preventDefault();
        let period_arr = [];
        let period = period_selector.val();
        if (period !== '') {
            period_arr = period.split('-');

            let year = period_arr[0];
            let month = period_arr[1];

            let url = url_selector.val();

            location.href = url + '/export_csv?year=' + year + '&month=' + month;
        } else {
            return false;
        }
    });
});

