<?php
/**
 * Created by PhpStorm.
 * User: Abnet
 * Date: 2/9/2020
 * Time: 4:52 PM
 */

use Absoft\App\Loaders\Loader;

include_once $_main_address."SystemConstructor/App/Loaders/Loader.php";
include_once $_main_address."SystemConstructor/App/Loaders/Resource.php";
include_once $_main_address."SystemConstructor/App/Routing/Route.php";
include_once $_main_address."SystemConstructor/App/Routing/routes.php";

include_once $_main_address."systemConstructor/App/ErrorHandling/ErrorHandler.php";
include_once $_main_address."systemConstructor/App/ErrorHandling/error_handler.php";
include_once $_main_address."systemConstructor/App/ErrorHandling/ControllerNotFound.php";
include_once $_main_address."SystemConstructor/App/Security/IpCheck.php";
include_once $_main_address."SystemConstructor/App/Security/Auth.php";
include_once $_main_address."SystemConstructor/App/Pager/Pager.php";

include_once $_main_address."SystemConstructor/Line/Attributes/Attribute.php";
include_once $_main_address."SystemConstructor/Line/Attributes/Varchar.php";
include_once $_main_address."SystemConstructor/Line/Attributes/Text.php";
include_once $_main_address."SystemConstructor/Line/Attributes/Numeric.php";
include_once $_main_address."SystemConstructor/Line/Attributes/Primary.php";
include_once $_main_address."SystemConstructor/Line/Attributes/Time.php";
include_once $_main_address."SystemConstructor/Line/Attributes/Date.php";
include_once $_main_address."SystemConstructor/Line/Attributes/Number.php";
include_once $_main_address."SystemConstructor/Line/Attributes/Decimal.php";
include_once $_main_address."SystemConstructor/Line/Attributes/TimeStamp.php";
include_once $_main_address."SystemConstructor/Line/Attributes/Hidden.php";

include_once $_main_address."SystemConstructor/Line/Modeling/Controller.php";
include_once $_main_address."SystemConstructor/Line/Modeling/Entity.php";
include_once $_main_address."SystemConstructor/Line/Modeling/Model.php";
include_once $_main_address."SystemConstructor/Line/Modeling/Initializer.php";
include_once $_main_address."SystemConstructor/Line/Modeling/Schema.php";

include_once $_main_address."SystemConstructor/Line/QueryConstruction/QueryConstructor.php";
include_once $_main_address."SystemConstructor/Line/QueryConstruction/Selection.php";
include_once $_main_address."SystemConstructor/Line/QueryConstruction/Creation.php";
include_once $_main_address."SystemConstructor/Line/QueryConstruction/Update.php";
include_once $_main_address."SystemConstructor/Line/QueryConstruction/Deletion.php";
include_once $_main_address."SystemConstructor/Line/QueryConstruction/Insertion.php";

include_once $_main_address."SystemConstructor/Line/Database/Connection.php";
include_once $_main_address."SystemConstructor/Line/Database/Database.php";
include_once $_main_address."SystemConstructor/Line/Database/MySql.php";
include_once $_main_address."SystemConstructor/Line/Database/MsSql.php";
include_once $_main_address."SystemConstructor/Line/Creation/Updater.php";
include_once $_main_address."SystemConstructor/Line/Creation/Creator.php";

include_once $_main_address."SystemConstructor/Line/Mailer/src/PHPMailer.php";
include_once $_main_address."SystemConstructor/Line/Mailer/src/Exception.php";
include_once $_main_address."SystemConstructor/Line/Mailer/src/OAuth.php";
include_once $_main_address."SystemConstructor/Line/Mailer/src/POP3.php";
include_once $_main_address."SystemConstructor/Line/Mailer/src/SMTP.php";

//include_once $_main_address . "app/Controller/BuildersController.php";

//include_once $_main_address."SystemConstructor/Line/api/Api.php";
include_once $_main_address."SystemConstructor/Line/built_in/ApiController.php";
//include_once $_main_address."SystemConstructor/Line/api/ApiModel.php";

//$vars = \Absoft\App\Routing\Route::lineVariables();


//if(isset($vars->auto_api) && $vars->auto_api == true){

//}

Loader::loadEntity($_main_address);
Loader::loadModels($_main_address);
Loader::loadInitializer($_main_address);

?>
