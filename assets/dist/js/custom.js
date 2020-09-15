$(document).ready(() => {
    $("body").on("click", "#btn-pilih", function() {
        const id = $(this).data("id");
        const nomor = $(this).data("nomor");
        $("#suara-nomor").text(nomor);
        $("#btn-suara").attr("suara", id);
    })
    $("#btn-suara").on("click", function() {
        const id = $(this).attr("suara");
        window.location.href=id;
    });
});