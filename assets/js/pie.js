$('#submit').click(function () {
    var event = $('#event').val();
    var numfemales = $('#females').val();
    var females = parseInt(numfemales);
    var nummales = $('#males').val();
    var males = parseInt(nummales);
    // Load google charts
    google.charts.load('current', { 'packages': ['corechart'] });
    google.charts.setOnLoadCallback(drawChart);
    // Draw the chart and set the chart values
    function drawChart() {
        var data = google.visualization.arrayToDataTable([
            ['Gender', 'Number of Attendees'],
            ['Males', females],
            ['Females', males]
        ]);

        var title = event + " " + "Attendance by Gender";


        // Optional; add a title and set the width and height of the chart
        var options = { 'title': title, 'width': 500, 'height': 400, is3D: true };

        // Display the chart inside the <div> element with id="piechart"
        var chart = new google.visualization.PieChart(document.getElementById('piechart'));
        chart.draw(data, options);
    }
});

/////////////////////////////////////////////////
$(document).ready(function () {
    $('#event').change(function () {

        var event = $('#event').val();
        if (event != '') {
            $.ajax({
                url: "crud/pie.php",
                method: "POST",
                data: { event: event },
                dataType: "JSON",
                success: function (data) {
                    const ev = (data.event);
                    const males = (data.no_males);
                    const females = (data.no_females);
                    console.log(data.no_attendance);
                    $('#males').val(males);
                    $('#females').val(females);

                    document.getElementById('lm').innerHTML = males;
                    document.getElementById('lf').innerHTML = females;
                    document.getElementById('ev').innerHTML = ev;

                }
            })
        }
        else {
            //alert("Please Select");
        }

    });
});



