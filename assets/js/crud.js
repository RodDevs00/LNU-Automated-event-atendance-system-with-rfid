//Delete admin
$(document).ready(function () {

    $('#adminsTable tbody').on('click', '.deladminbtn', function () {
        $('.deladminbtn').on('click', function () {

            $('#deladminmodal').modal('show');

            $tr = $(this).closest('tr');

            var data = $tr.children("td").map(function () {
                return $(this).text();
            }).get();

            console.log(data);

            $('#delete_id').val(data[0]);

        });
    });

    $('.delclose').on('click', function () {

        $('#deladminmodal').modal('hide');

    });

});

//CATEGORIES
$(document).ready(function () {

    $('#courseTable tbody').on('click', '.editcat', function () {
        $('.editcat').on('click', function () {

            $('#editcatmodal').modal('show');

            $tr = $(this).closest('tr');

            var data = $tr.children("td").map(function () {
                return $(this).text();
            }).get();

            console.log(data);

            $('#edit_id').val(data[0]);
            $('#course').val(data[1]);
            $('#organization').val(data[2]);
            $('#college').val(data[3]);

        });
    });


    $('.edclose').on('click', function () {

        $('#editcatmodal').modal('hide');

    });
});

//DELETE CATEGORY MODAL
$(document).ready(function () {

    $('#courseTable tbody').on('click', '.deletecat', function () {
        $('.deletecat').on('click', function () {

            $('#delcatmodal').modal('show');

            $tr = $(this).closest('tr');

            var data = $tr.children("td").map(function () {
                return $(this).text();
            }).get();

            console.log(data);

            $('#delete_id').val(data[0]);

        });
    });


    $('.delclose').on('click', function () {

        $('#delcatmodal').modal('hide');

    });
});
//CATEGORIES


//STUDENT
//ADD STUDENT
$(document).ready(function () {


    $('.addstudbtn').on('click', function () {

        $('#addstudentmodal').modal('show');

    });

    $('.studclose').on('click', function () {

        $('#addstudentmodal').modal('hide');

    });


});


//EDIT STUDENT
$(document).ready(function () {

    $('#studentTable tbody').on('click', '.editstudbtn', function () {
        $('.editstudbtn').on('click', function () {

            $('#editstudentmodal').modal('show');

            $tr = $(this).closest('tr');


            var data = $tr.children("td").map(function () {
                return $(this).text();
            }).get();

            console.log(data);

            $('#update_id').val(data[0]);
            $('#upstud').val(data[1]);
            $('#studname').val(data[2]);
            $('#section').val(data[4]);
            $('#courses').val(data[5]);
            $('#organization').val(data[6]);
            $('#yrlevel').val(data[7]);
            var gen = "Male";
            if (data[3] === gen) {
                document.getElementById("male").checked = true;
            }
            else {
                document.getElementById("female").checked = true;
            }

        });
    });


    $('.studclose').on('click', function () {

        $('#editstudentmodal').modal('hide');

    });
});

//DELETE STUDENT
$(document).ready(function () {
    $('#studentTable tbody').on('click', '.delstudbtn', function () {
        $('.delstudbtn').on('click', function () {

            $('#delstudmodal').modal('show');

            $tr = $(this).closest('tr');

            var data = $tr.children("td").map(function () {
                return $(this).text();
            }).get();

            console.log(data);

            $('#delete_id').val(data[0]);

        });
    });

    $('.delclose').on('click', function () {

        $('#delstudmodal').modal('hide');

    });
});
//STUDENT

//EVENTS
//DELETE Event
$(document).ready(function () {
    $('#eventsTable tbody').on('click', '.delevent', function () {
        $('.delevent').on('click', function () {

            $('#deleventmodal').modal('show');

            $tr = $(this).closest('tr');

            var data = $tr.children("td").map(function () {
                return $(this).text();
            }).get();

            console.log(data);

            $('#delete_id').val(data[0]);

        });
    });

    $('.delclose').on('click', function () {

        $('#deleventmodal').modal('hide');

    });
});

//EDIT EVENT
$(document).ready(function () {

    $('#eventsTable tbody').on('click', '.editevent', function () {
        $('.editevent').on('click', function () {

            $('#editeventmodal').modal('show');

            $tr = $(this).closest('tr');

            var data = $tr.children("td").map(function () {
                return $(this).text();
            }).get();

            console.log(data);

            $('#edit_id').val(data[0]);
            $('#editname').val(data[1]);
            $('#organizer').val(data[2]);
            $('#date').val(data[3]);

        });
    });


    $('.edclose').on('click', function () {

        $('#editeventmodal').modal('hide');

    });
});
//EVENTSS