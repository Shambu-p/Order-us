<?php
/**
 * Created by PhpStorm.
 * User: Abnet
 * Date: 2/13/2020
 * Time: 9:39 AM
 */

$client_ip = \Absoft\App\Security\IpCheck::clientIp();

if(!\Absoft\App\Security\IpCheck::isIpTrusted($client_ip)){

    print '
<br>
<div class="container shadow p-3 mb-5">
    <div class="jumbotron rounded shadow-sm">
          <h1>You are not Eligible to use this page!</h1>
          <p>
             the ip address '.$client_ip.' is not trusted ip address.
             you are not eligible to use this page.
          </p>
    </div>
</div>
    ';
    die("");

}

//Loader::checkIp();

?>
