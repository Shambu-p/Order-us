<?php
/**
 * Created by PhpStorm.
 * User: Abnet
 * Date: 1/21/2021
 * Time: 10:52 PM
 */

use Absoft\App\Security\Auth;

if(Auth::checkUser("role", "admin")){
    $this->loadTemplate("layouts/admin_header.php");
}
else if(Auth::checkUser("role", "designer")){
    $this->loadTemplate("layouts/designer_header.php");
}
else if(Auth::checkUser("role", "cashier")){
    $this->loadTemplate("layouts/cashier_header.php");
}
else{
    print '
    
    <div class="jumbotron">
        <h1 class="display-4">Incorrect page</h1>
    </div>
    
    ';
    die();
}

print '<script type="text/javascript">'.$this->load_js("Chart.min.js").'</script>';

print '<script type="text/javascript">';

print 'var statistic_address = "'.$this->route_address("Orders.stat").'";';

print '</script>';

?>

<script type="text/javascript">

    let payment_element, payed_element, amount_element, declined_element, type_element;

    window.onload = function(){
        payment_element = document.getElementById("payments_chart").getContext('2d');
        payed_element = document.getElementById("payed_chart").getContext('2d');
        amount_element = document.getElementById("amount_chart").getContext('2d');
        declined_element = document.getElementById("declined_chart").getContext('2d');
        type_element = document.getElementById("type_chart").getContext('2d');

        thisYear();

        /*
        let ajax = new XMLHttpRequest();
        ajax.open("POST", statistic_address+'/all', true);

        ajax.send();

        ajax.onreadystatechange = function(){

            if(this.readyState === 4 && this.status === 200){

                let result = JSON.parse(this.responseText);

                showMyChart(result.payment, payment_element, "Payment Collected");
                showMyChart(result.type, type_element, "Orders By Type");
                showMyChart(result.payed, payed_element, "Payed Orders");
                showMyChart(result.decline, declined_element, "Declined Orders");


            }

        };*/



    };

    function thisYear() {
        let ajax = new XMLHttpRequest();
        ajax.open("POST", statistic_address+'/all', true);

        ajax.send();

        ajax.onreadystatechange = function(){

            if(this.readyState === 4 && this.status === 200){

                let result = JSON.parse(this.responseText);

                showMyChart(result.amount, amount_element, "Order Amount", "#0084c4");
                showMyChart(result.payment, payment_element, "Payment Collected", "#dd7d3b");
                showMyChart(result.type, type_element, "Orders By Type", "#5e3edd");
                showMyChart(result.payed, payed_element, "Payed Orders", "#7eb3dd");
                showMyChart(result.decline, declined_element, "Declined Orders", "black");


            }

        };
    }

    function lastYear() {
        let ajax = new XMLHttpRequest();
        ajax.open("POST", statistic_address+'/last_year', true);

        ajax.send();

        ajax.onreadystatechange = function(){

            if(this.readyState === 4 && this.status === 200){

                let result = JSON.parse(this.responseText);

                showMyChart(result.payment, payment_element, "Payment Collected");
                showMyChart(result.type, type_element, "Orders By Type");
                showMyChart(result.payed, payed_element, "Payed Orders");
                showMyChart(result.decline, declined_element, "Declined Orders");


            }

        };
    }

    function thisMonth() {
        let ajax = new XMLHttpRequest();
        ajax.open("POST", statistic_address+'/this_month', true);

        ajax.send();

        ajax.onreadystatechange = function(){

            if(this.readyState === 4 && this.status === 200){

                let result = JSON.parse(this.responseText);

                showMyChart(result.payment, payment_element, "Payment Collected");
                showMyChart(result.type, type_element, "Orders By Type");
                showMyChart(result.payed, payed_element, "Payed Orders");
                showMyChart(result.decline, declined_element, "Declined Orders");


            }

        };
    }

    function lastMonth() {
        let ajax = new XMLHttpRequest();
        ajax.open("POST", statistic_address+'/last_month', true);

        ajax.send();

        ajax.onreadystatechange = function(){

            if(this.readyState === 4 && this.status === 200){

                let result = JSON.parse(this.responseText);

                showMyChart(result.payment, payment_element, "Payment Collected");
                showMyChart(result.type, type_element, "Orders By Type");
                showMyChart(result.payed, payed_element, "Payed Orders");
                showMyChart(result.decline, declined_element, "Declined Orders");


            }

        };
    }

    function showMyChart(data, element, title, color="#c4c4c4"){

        let myChart = new Chart(element, {
            type:'line',
            data:{
                labels:["Cup", "Banner", "Shirt", "wedding_card", "flier_card", "business_card"],
                datasets:[
                    {
                        label: title,
                        data:[data.cup, data.banner, data.shirt, data.wedding_card, data.flier_card, data.business_card],
                        backgroundColor: color
                    }

                ]
            },
            options:{
                scales: {
                    yAxes:[{
                            ticks: {
                                beginAtZero: true
                            }
                        }
                    ]
                }
            }
        });

    }
</script>

<!--
<div class="p-2 w-100 border-bottom shadow-sm rounded bg-light mt-3">
    <button class="btn btn-primary">This Month</button>
    <button class="btn btn-primary">This Year</button>
    <button class="btn btn-primary">Last Year</button>
    <button class="btn btn-primary">Last Month</button>
</div>
-->

<div class="container rounded shadow p-1 mt-3 bg-light">
    <canvas id="amount_chart"></canvas>
</div>

<div class="row mt-3">
    <div class="col-5">
        <div class="rounded p-1 shadow-sm w-100 bg-light">
            <canvas id="payments_chart"></canvas>
        </div>
    </div>
    <div class="col-6">
        <div class="rounded p-1 shadow-sm w-100 bg-light">
            <canvas id="type_chart"></canvas>
        </div>
    </div>
</div>

<div class="row mt-3">
    <div class="col-5">
        <div class="rounded p-1 shadow-sm w-100 bg-light">
            <canvas id="payed_chart"></canvas>
        </div>
    </div>
    <div class="col-6">
        <div class="rounded p-1 shadow-sm w-100 bg-light">
            <canvas id="declined_chart"></canvas>
        </div>
    </div>
</div>

<?php
$this->loadTemplate("layouts/admin_footer.php");
?>
