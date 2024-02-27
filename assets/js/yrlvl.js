$(document).ready(function () {
    $('#yrlvl').change(function () {
        var yr = $('#yrlvl').val();
        if (yr != '') {
            $.ajax({
                url: "crud/yrlvl.php",
                method: "POST",
                data: { yr: yr },
                dataType: "JSON",
                success: function (data) {
                   
                    const dates = (data.date);
                    const vol = (data.vols)
                   // console.log(dates);
                    //console.log(vol);

                    $('#dates').val(dates);
                    //document.getElementById('gg').innerHTML = org;
                    //document.getElementById('fdg').innerHTML = org;


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
   
                      tb(forecast);
                      
                       forecast.unshift(history[history.length - 1]);
                      const chart = d3.select('#yrchart');
                      const margin = { top: 20, right: 20, bottom: 30, left: 70 };
                      const width = 1000 - margin.left - margin.right;
                      const height = 500 - margin.top - margin.bottom;
                      const innerChart = chart.append('g')
                          .attr('transform', `translate(${margin.left} ${margin.top})`);
  
                      const x = d3.scaleTime().rangeRound([0, width]);
                      const y = d3.scaleLinear().rangeRound([height, 0]);
  
                      const line = d3.line()
                          .x(d => x(d.date))
                          .y(d => y(d.volume));
  
                      x.domain([
                          d3.min(history, d => d.date),
                          d3.max(forecast, d => d.date),
                      ]);
                      y.domain([0, d3.max(history, d => d.volume)]);
  
  
                      innerChart.append('g')
                          .attr('transform', `translate(0 ${height})`)
                          .style("font", "12px sans-serif")
                          .call(d3.axisBottom(x));
  
                      innerChart.append('g')
                          .call(d3.axisLeft(y))
                          .append('text')
                          .attr('fill', '#000')
                          .style("font", "24px arial")
                          .attr('transform', 'rotate(-90)')
                          .attr('y', 6)
                          .attr('dy', '1em')
                          .attr('text-anchor', 'end')
                          .text('Number of Attendance');
  
                      innerChart.append('path')
                          .datum(history)
                          .attr('fill', 'none')
                          .attr('stroke', 'steelblue')
                          .attr('stroke-width', 3)
                          .attr('d', line);
  
                      innerChart.append('path')
                          .datum(forecast)
                          .attr('fill', 'none')
                          .attr('stroke', 'tomato')
                          .attr('stroke-dasharray', '10,7')
                          .attr('stroke-width', 3)
                          .attr('d', line);
                    
                     
                               }
            })
        }

    });


    ////////////////////DISPLAY TO TABLE
 let myTable = document.querySelector('#yrtable');

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

 