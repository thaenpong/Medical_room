$(document).ready(function () {
    $('#data_table').Tabledit({
        columns: {
            identifier: [1, 'ID_student'],
            editable: [[4, 'healthcheck_1'], [5, 'healthcheck_2'], [6, 'healthcheck_3']]
        },
        hideIdentifier: true,
        url: 'healthcheck_live_edit.php'
    });
});