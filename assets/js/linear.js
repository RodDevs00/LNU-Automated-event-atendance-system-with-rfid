$(document).ready(function () {
    $('#genders').change(function () {
        var gen = $('#genders').val();
        if (gen != '') {
            $.ajax({
                url: "crud/genders.php",
                method: "POST",
                data: { gen: gen },
                dataType: "JSON",
                success: function (data) {

                    const dates = (data.date);
                    const vol = (data.vols);
                    const fvol = (data.fvols);


                    ftb(dates, fvol);
                    //console.log(dates);

                    console.log(fvol);
                    //ftb()

                    $('#dates').val(dates);
                    // document.getElementById('gg').innerHTML = org;
                    // document.getElementById('fdg').innerHTML = org;
                    //  document.getElementById('lm1').innerHTML = dates;

                    //////////////////////////////////////

                    var edate = dates;
                    const options = edate.map(function (row) {
                        return { date: row }
                    });
                    console.log(options);


                    var evols = vol;
                    const evol = evols.map(str => {
                        return Number(str);
                    });
                    console.log(evol);

                    /////////////////CHARTS
                    var some = document.getElementsByClassName("genders");
                    var inputValues = new Array();

                    for (i in some) {
                        //extract the value of input elements
                        var singleVal = some[i].value;
                        if (singleVal !== "" && singleVal !== undefined) {
                            inputValues.push(singleVal);
                        }
                    }
                    const fd = inputValues.map(function (row) {
                        return { date: row }
                    });
                    console.log(fd);



                    const edates = edate;
                    const volumes = evol;
                    console.log(volumes);
                    let history = edates.map(
                        (e, i) => {
                            return ({ date: e, volume: volumes[i] });
                        });
                    console.log(history);


                    let forecast = fd;


                    const parseTime = d3.timeParse('%Y-%m-%d');
                    history = history.map((d) => {
                        return {
                            date: parseTime(d.date),
                            volume: d.volume,
                        };
                    });

                    const predict = (data, newX) => {
                        const round = n => Math.round(n * 100) / 100;

                        const sum = data.reduce((acc, pair) => {
                            const x = pair[0];
                            const y = pair[1];

                            if (y !== null) {
                                acc.x += x;
                                acc.y += y;
                                acc.squareX += x * x;
                                acc.product += x * y;
                                acc.len += 1;
                            }

                            return acc;
                        }, { x: 0, y: 0, squareX: 0, product: 0, len: 0 });

                        const run = ((sum.len * sum.squareX) - (sum.x * sum.x));
                        const rise = ((sum.len * sum.product) - (sum.x * sum.y));
                        const gradient = run === 0 ? 0 : round(rise / run);
                        const intercept = round((sum.y / sum.len) - ((gradient * sum.x) / sum.len));

                        return round((gradient * newX) + intercept);
                    };
                    const historyIndex = history.map((d, i) => [i, d.volume]);

                    forecast = forecast.map((d, i) => {
                        return {
                            date: parseTime(d.date),
                            volume: predict(historyIndex, historyIndex.length - 1 + i),
                        }
                    });
                    //////////////////////////////////////////////////////
                    console.log(forecast);
                    const fore = JSON.stringify(forecast);
                    //document.getElementById('gf').innerHTML = fore;


                    tb(forecast);
                    ///////////////////////////////////////////////

                    ///////////////////////////////CHARTS

                    //   $('#females').val(females);

                    //   document.getElementById('lm').innerHTML = males;
                    //  document.getElementById('lf').innerHTML = females;
                    //   document.getElementById('ev').innerHTML = ev;



                }
            })
        }
        else {
            //alert("Please Select");
        }

    });


    ////////////////////
    ////////////////////DISPLAY TO TABLE
    let myTable = document.querySelector('#mtable');

    function tb(forecast) {

        let fc = forecast;
        let headers = ['Dates', 'Number of Attendance'];
        let table = document.createElement('table');
        let headerRow = document.createElement('tr');

        headers.forEach(headerText => {
            let header = document.createElement('th');
            let textNode = document.createTextNode(headerText);
            header.appendChild(textNode);
            headerRow.appendChild(header);
        });

        table.appendChild(headerRow);

        fc.forEach(emp => {
            let row = document.createElement('tr');

            Object.values(emp).forEach(text => {
                let cell = document.createElement('td');
                let textNode = document.createTextNode(text);
                cell.appendChild(textNode);
                row.appendChild(cell);
            })

            table.appendChild(row);
        });

        myTable.appendChild(table);
    };




});
