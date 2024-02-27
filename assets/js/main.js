function myFunction() {
    var x = document.getElementById("floatingPassword");
    if (x.type === "password") {
        x.type = "text";
    } else {
        x.type = "password";
    }
}

$(document).ready(function () {
    $('#profileTable').DataTable();
});

$(document).ready(function () {
    $('#eventsTable').DataTable();
});

$(document).ready(function () {
    $('#adminsTable').DataTable();
});

$(document).ready(function () {
    $('#courseTable').DataTable();
});
$(document).ready(function () {
    $('#orgTable').DataTable();
});


$(document).ready(function () {
    $('#studentTable').DataTable();
});

$('#datepicker').datepicker({
    uiLibrary: 'bootstrap4'
});

$('#datepickerUpdate').datepicker({
    uiLibrary: 'bootstrap4'
});



//////////////////////
document.getElementById("rfidr").onchange = function () {
    document.getElementById("record").clicked == true;
};






