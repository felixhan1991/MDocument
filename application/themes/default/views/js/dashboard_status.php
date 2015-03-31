<script type="text/javascript">
(function ($) {
    "use strict";
    $(document).ready(function () {
        if ($.fn.plot) {

            var d1 = [
                [0, 10],
                [1, 20],
                [2, 33],
                [3, 24],
                [4, 45],
                [5, 96],
                [6, 47],
                [7, 18],
                [8, 11],
                [9, 13],
                [10, 21]

            ];
            var data = ([{
                label: "Too",
                data: d1,
                lines: {
                    show: true,
                    fill: true,
                    lineWidth: 2,
                    fillColor: {
                        colors: ["rgba(255,255,255,.1)", "rgba(160,220,220,.8)"]
                    }
                }
            }]);
            var options = {
                grid: {
                    backgroundColor: {
                        colors: ["#fff", "#fff"]
                    },
                    borderWidth: 0,
                    borderColor: "#f0f0f0",
                    margin: 0,
                    minBorderMargin: 0,
                    labelMargin: 20,
                    hoverable: true,
                    clickable: true
                },
                // Tooltip
                tooltip: true,
                tooltipOpts: {
                    content: "%s X: %x Y: %y",
                    shifts: {
                        x: -60,
                        y: 25
                    },
                    defaultTheme: false
                },

                legend: {
                    labelBoxBorderColor: "#ccc",
                    show: false,
                    noColumns: 0
                },
                series: {
                    stack: true,
                    shadowSize: 0,
                    highlightColor: 'rgba(30,120,120,.5)'

                },
                xaxis: {
                    tickLength: 0,
                    tickDecimals: 0,
                    show: true,
                    min: 2,

                    font: {

                        style: "normal",


                        color: "#666666"
                    }
                },
                yaxis: {
                    ticks: 3,
                    tickDecimals: 0,
                    show: true,
                    tickColor: "#f0f0f0",
                    font: {

                        style: "normal",


                        color: "#666666"
                    }
                },
                //        lines: {
                //            show: true,
                //            fill: true
                //
                //        },
                points: {
                    show: true,
                    radius: 2,
                    symbol: "circle"
                },
                colors: ["#87cfcb", "#48a9a7"]
            };
            var plot = $.plot($("#daily-visit-chart2"), data, options);



            // DONUT
            var dataPie = [
            <?php $j=0; $last_dept=count($dokumen_stat); 
            foreach($dokumen_stat as $dept) {    
                echo '{
                    label: "'.$dept->nama_status.'",
                    data: '.$dept->jum.'
                    ';
                if($j!==($last_dept-1)) echo '},';
                $j++;
                } echo '}'; ?>
                ];

            $.plot($(".sm-pie2"), dataPie, {
                series: {
                    pie: {
                        innerRadius: 0.7,
                        show: true,
                        stroke: {
                            width: 0.1,
                            color: '#ffffff'
                        }
                    }

                },

                legend: {
                    show: true
                },
                grid: {
                    hoverable: true,
                    clickable: true
                },

                colors: ["#ffdf7c", "#b2def7", "#efb3e6"]
            });

        }

        $(document).on('click', '.event-close', function () {
            $(this).closest("li").remove();
            return false;
        });

        $('.progress-stat-bar li').each(function () {
            $(this).find('.progress-stat-percent').animate({
                height: $(this).attr('data-percent')
            }, 1000);
        });

        $('.todo-check label').click(function () {
            $(this).parents('li').children('.todo-title').toggleClass('line-through');
        });


        $(document).on('click', '.todo-remove', function () {
            $(this).closest("li").remove();
            return false;
        });


        $('.stat-tab .stat-btn').click(function () {

            $(this).addClass('active');
            $(this).siblings('.btn').removeClass('active');

        });


        $("#sortable-todo").sortable();

    });


})(jQuery);


if (Skycons) {
    /*==Weather==*/
    var skycons = new Skycons({
        "color": "#aec785"
    });
    // on Android, a nasty hack is needed: {"resizeClear": true}
    // you can add a canvas by it's ID...
    skycons.add("icon1", Skycons.RAIN);
    // start animation!
    skycons.play();
    // you can also halt animation with skycons.pause()
    // want to change the icon? no problem:
    skycons.set("icon1", Skycons.RAIN);

}


</script>