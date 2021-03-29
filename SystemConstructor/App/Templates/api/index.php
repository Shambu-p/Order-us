<?php
/**
 * Created by PhpStorm.
 * User: Abnet
 * Date: 11/6/2020
 * Time: 11:48 AM
 */

header("Content-Type: application/json");
header("Expires: ".date("D, d M Y h:i:s", strtotime("now")));
header("X-Powered-By: Absoft");
header("Data-Permitted-to: unknown");

/*
Cache-Control	no-store, no-cache, must-revalidate
Connection	close
Content-Type	application/json
Date	Sat, 07 Nov 2020 18:00:20 GMT
Expires	Thu, 19 Nov 1981 08:52:00 GMT
Host	localhost
Pragma	no-cache
X-Powered-By	PHP/7.3.8
*/

print json_encode($this->request);

?>


