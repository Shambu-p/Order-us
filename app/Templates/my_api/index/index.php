<?php
/**
 * Created by PhpStorm.
 * User: Abnet
 * Date: 12/11/2020
 * Time: 5:20 PM
 */

header("content-type: application/json");
header("Access-Control-Allow-Origin: *");
print json_encode($this->request);

?>
