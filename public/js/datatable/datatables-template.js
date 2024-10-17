$(document).ready(function(){
    $.extend(true, $.fn.dataTable.defaults, {
        order: [[0, "desc"]]
    });
});

$(document).ready(function(){
    $.extend(true, $.fn.dataTable.defaults, {
        language: {
            "url": "//cdn.datatables.net/plug-ins/1.11.5/i18n/es-ES.json"
        },
        "paging": true,
        "searching": true,
        "ordering": true
    });
});
