<?php
/**
 * Created by PhpStorm.
 * User: Abnet
 * Date: 11/13/2020
 * Time: 11:26 AM
 */

?>

</main>
</div>
</div>

<!-- Bootstrap core JavaScript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<script><?php print $this->load_js("jquery-slim.min.js"); ?></script>
<script> window.jQuery || document.write('<script> <?php print $this->load_js("jquery-slim.min.js"); ?> <\/script>');</script>
<script> <?php $this->load_js("popper.min.js"); ?> </script>
<script><?php $this->load_js("bootstrap.min.js"); ?></script>

<!-- Icons -->
<script>feather.replace()</script>

<!-- Graphs -->


<script>
    var ctx = document.getElementById("myChart");
    var myChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: ["Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"],
            datasets: [{
                data: [15339, 21345, 18483, 24003, 23489, 24092, 12034],
                lineTension: 0,
                backgroundColor: 'transparent',
                borderColor: '#007bff',
                borderWidth: 4,
                pointBackgroundColor: '#007bff'
            }]
        },
        options: {
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero: false
                    }
                }]
            },
            legend: {
                display: false,
            }
        }
    });
</script>
</body>

<!-- Mirrored from getbootstrap.com/docs/4.1/examples/dashboard/ by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 07 Nov 2018 23:41:52 GMT -->
</html>
