<?php
/**
 * Created by PhpStorm.
 * User: Abnet
 * Date: 2/13/2020
 * Time: 10:26 AM
 */

namespace Absoft\App\Security;

class IpCheck
{

    public static function clientIp(){

        if(!empty($_SERVER["HTTP_CLIENT_IP"])){

            $client_ip = $_SERVER["HTTP_CLIENT_IP"];

        }else if(!empty($_SERVER["HTTP_X_FORWARDED_FOR"])){

            $client_ip = $_SERVER["HTTP_X_FORWARDED_FOR"];

        }else{

            $client_ip = $_SERVER["REMOTE_ADDR"];

        }

        return $client_ip;

    }

    public static function isIpTrusted($ip){

        $f_address = str_replace("\\", "/", dirname(dirname(dirname(__DIR__))))."/sys_description.json";
        $ip_array = (array) json_decode(file_get_contents($f_address));

        if(!in_array($ip, $ip_array["untrusted_ip"])){

            return true;

        }

        return false;

    }

    public static function isLocal($ip){

        $trusted = ["127.0.0.1", "localhost", "::1"];

        if(in_array($ip, $trusted)){
            return true;
        }

        return false;

    }

}
