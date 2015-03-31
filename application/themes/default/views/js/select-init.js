$(document).ready(function() {
    $("#e1").select2();
    $("#e9").select2();
    $("#author").select2();
    $("#review").select2();
    $("#editor").select2();
    $("#kategori").select2();
    $("#status").select2();
    $("#departemen").select2();
    $("#e2").select2({
        placeholder: "Select a State",
        allowClear: true
    });
    $("#e3").select2({
        minimumInputLength: 2
    });
});


