<?php
/**
 * Created by PhpStorm.
 * User: Abnet
 * Date: 2/10/2020
 * Time: 4:38 PM
 */

session_start();
$_main_address = str_replace("\\", "/", dirname( __DIR__))."/";


include_once $_main_address."SystemConstructor/App/Loaders/constant_loader.php";
include_once $_main_address."SystemConstructor/App/Loaders/app_loader.php";

\Absoft\App\Engines\Engine::loadAddress();


$engine = new \Absoft\App\Engines\Engine($_main_address);






$engine->start();


?>
