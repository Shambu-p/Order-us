<?php
/**
 * Created by PhpStorm.
 * User: Abnet
 * Date: 2/11/2020
 * Time: 12:25 AM
 */

namespace Absoft\Line\Attributes;
use Absoft\App\Routing\Route;
use \Absoft\Line\Modeling\Controller;

class Creator extends Controller
{

    public function route($name, $parameter){

        $_SESSION["_system"]["error_handling"]["error_for"] = "API";

        if($name == "model"){

            $return = $this->modelCreator($parameter);

        }else if($name == "controller"){

            $return = $this->controllerCreator($parameter);

        }else if($name == "entity"){

            $return = $this->entityCreator($parameter);

        }else if($name == "mapping"){

            $return = $this->setControllerModelMapping($parameter);

        }else if($name == "all_entity"){

            $return = $this->allEntity();

        }else if($name == "all_model"){

            $return = $this->allModel();

        }else if($name == "all_controller"){

            $return = $this->allControllers();

        }else if($name == "build_table"){

            $return = $this->executeEntity($parameter);

        }else if($name == "build_all_table"){

            $return = $this->executeAllEntity();

        }else if($name == "initialize"){

            $return = $this->initialize($parameter);

        }else if($name == "create_init"){

            $return = $this->initializerCreator($parameter);

        }else if($name == "update"){

            $return = $this->update();

        }
        else{

            $return = "";

        }

        return $return;

    }

    public function modelCreator($request){

        //$req = (Array) $request;
        //$req_size = sizeof($req);
        if(isset($request->model_name)){
            $model_name = $request->model_name;
            $file_address = str_replace("\\", "/", dirname(dirname(dirname(__DIR__))));
            $table_name = "";

            if(isset($request->table_name)){

                $table_name = $request->table_name;

            }

            $page_content = '<?php
namespace Users\Models;

use Absoft\Line\Modeling\Model;

class '.$model_name.' extends Model{

    /*
    public $MAINS = [
        "id" => "",
        "username" => "",
        "f_name" => ""
    ];

    */
    
    //As the name indicate this is the Table name of the Model
    
    public $TABLE_NAME = "'.$table_name.'";

    /**********************************************************************
        In this property you are expected to put all the columns you want
        other than the fields you want to be hashed.
    ***********************************************************************/

    public $MAINS = [
        //@att_start
        "id" => ""
        //@att_end
    ];
    
    /**********************************************************************
        In this field you are expected to put all columns you want to be
        encrypted or hashed.
    ***********************************************************************/
    
    public $HIDDEN = [
        //@hide_start
        "id" => ""
        //@hide_end
    ];

}
?>
        ';

            if(!file_exists($file_address."/app/Models/$model_name.php")){

                $file = fopen($file_address."/app/Models/$model_name.php", "w");

                if($file){

                    if(file_put_contents($file_address."/app/Models/$model_name.php", $page_content)){

                        return '
                        {
                        "status": "1",
                        "error_message": "",
                        "success_message": "Model Created successfully \n available in Models folder"
                        }
                        ';

                    }else{

                        unlink($file_address."/app/Models/$model_name.php");

                        return '
                        {
                        "status": "0",
                        "error_message": "Model file creation failed",
                        "success_message": ""
                        }
                        ';

                    }

                }else{

                    return '
                    {
                    "status": "0",
                    "error_message": "cannot create Model file. Model creation failed",
                    "success_message": ""
                    }
                    ';

                }


            }else{

                return '
                {
                "status": "0",
                "error_message": "Same Model exist in models folder. Model creation failed",
                "success_message": ""
                }
                ';

            }

        }
        else{

            return '
            {
            "status": "0",
            "error_message": "No Model Name provided. Model creation failed",
            "success_message": ""
            }
            ';
        }

    }

    public function initializerCreator($request){

        //$req = (Array) $request;
        //$req_size = sizeof($req);
        if(isset($request->init_name)){
            $init_name = $request->init_name;
            $file_address = str_replace("\\", "/", dirname(dirname(dirname(__DIR__))));

            $model_name = str_replace("Initializer", "", $init_name)."Model";

            $page_content = '<?php
namespace Users\Initializers;

use Absoft\Line\Modeling\Initializer;
use Users\Models\\'.$model_name.';

class '.$init_name.' extends Initializer{

    /*
    public $VALUES = [
        [
            "id" => "the_id",
            "name" => "the_name",
        ],
        [
            "id" => "the_id",
            "name" => "the_name"
        ]
    ];

    */

    /*************************************************************************
        In this property you are expected to put all the values you want
        to insert into database. the you can initialize the operation from
        line cli.
    *************************************************************************/

    public $VALUES = [
        [
            
        ]
    ];
    
    

}
?>
        ';

            if(!file_exists($file_address."/app/Initializers/$init_name.php")){

                $file = fopen($file_address."/app/Initializers/$init_name.php", "w");

                if($file){

                    if(file_put_contents($file_address."/app/Initializers/$init_name.php", $page_content)){

                        return '
                        {
                        "status": "1",
                        "error_message": "",
                        "success_message": "Initializer Created successfully \n available in app/Initializers folder"
                        }
                        ';

                    }else{

                        unlink($file_address."/app/Initializers/$init_name.php");

                        return '
                        {
                        "status": "0",
                        "error_message": "Initializer file creation failed",
                        "success_message": ""
                        }
                        ';

                    }

                }else{

                    return '
                    {
                    "status": "0",
                    "error_message": "cannot create Initializer file. Initializer creation failed",
                    "success_message": ""
                    }
                    ';

                }


            }else{

                return '
                {
                "status": "0",
                "error_message": "Same Initializer exist in initializers folder. Initializer creation failed",
                "success_message": ""
                }
                ';

            }

        }
        else{

            return '
            {
            "status": "0",
            "error_message": "No Initializer Name provided. Initializer creation failed",
            "success_message": ""
            }
            ';
        }

    }

    public function controllerCreator($request){

        //$req = (Array) $request;

        if(isset($request->controller_name)){

            $controller_name = $request->controller_name;
            $file_address = str_replace("\\", "/", dirname(dirname(dirname(__DIR__))));

            $page_content = '<?php
namespace Users\Controllers;

use \Absoft\Line\Modeling\Controller;
use \Absoft\App\Routing\Route;

class '.$controller_name.' extends Controller{


    public function route($name, $parameter)
    {

        if($name == "show"){

            $response = $this->show();

        }else if($name == "save"){

            $response = $this->save($parameter);

        }
        else{
        
            \ErrorHandler::reportError(
                "Route Not Found!",
                "There is no Route named '.$controller_name.'.".$name,
                __FILE__." on Line ".__LINE__
            );
        
            $response = Route::display("system_templates", "error");
        
        }
        
        return $response;

    }

    public function show(){
        //here write showing codes to be Executed
        return "";
    }
    
    public function view($request){
        //here write viewing codes to be Executed
        return "";
    }

    public function save($request){
        //Here write save codes to be Executed
        return "";
    }
    
    public function update($request){
        //here write updating codes to be Executed
        return "";
    }
    
    public function delete($request){
        //here write deleting codes to be Executed
        return "";
    }

}
?>
        ';

            if(!file_exists($file_address."/app/Controller/$controller_name.php")){

                $file = fopen($file_address."/app/Controller/$controller_name.php", "w");

                if($file){

                    if(file_put_contents($file_address."/app/Controller/$controller_name.php", $page_content)){

                        return '
                        {
                        "status": "1",
                        "error_message": "",
                        "success_message": "Controller Created successfully \n available in Controller folder"
                        }
                        ';
                    }else{

                        unlink($file_address."/app/Controller/$controller_name.php");

                        return '
                        {
                        "status": "0",
                        "error_message": "Controller file creation failed",
                        "success_message": ""
                        }
                        ';

                    }

                }else{

                    return '
                    {
                    "status": "0",
                    "error_message": "No controller name provided",
                    "success_message": ""
                    }
                    ';

                }


            }else{

                return '
                {
                "status": "0",
                "error_message": "Same Controller exist in Controller folder. Controller creation failed",
                "success_message": ""
                }
                ';

            }
        }else{

            return '
            {
            "status": "0",
            "error_message": "Controller Name were not Provided. Controller creation failed",
            "success_message": ""
            }
            ';

        }

    }

    public function entityCreator($request){

        if(isset($request->entity_name)) {

            $entity_name = $request->entity_name;
            $file_address = str_replace("\\", "/", dirname(dirname(dirname(__DIR__))));
            $address = $file_address."/app/DatabaseBuilder/$entity_name.php";

            $page_content = '<?php
namespace Users\DatabaseBuilders;

use \Absoft\Line\Modeling\Entity;
use \Absoft\Line\Modeling\Schema;


class ' . $entity_name . ' extends Entity{

    function construct(Schema $table, $table_name = "' . $entity_name . '"){

        $this->TABLE_NAME = $table_name;

        $this->ATTRIBUTES = [
            //@att_start
            $table->autoincrement("id"),
            //@att_end
        ];
        
        $this->HIDDEN_ATTRIBUTES = [
            //@hide_start
            //@hide_end
        ];

    }

}

?>
        ';

            if(!file_exists($address)){

                $file = fopen($address, "w");

                if($file){

                    if(file_put_contents($address, $page_content)){

                        return '
                        {
                        "status": "1",
                        "error_message": "",
                        "success_message": "Entity Created successfully \n available in DatabaseBuilder folder"
                        }
                        ';

                    }else{

                        unlink($address);

                        return '
                        {
                        "status": "0",
                        "error_message": "Line cannot write the on entity file. Entity creation failed.",
                        "success_message": ""
                        }
                        ';

                    }

                }else{

                    return '
                    {
                    "status": "0",
                    "error_message": "cannot create Entity file. Entity creation failed",
                    "success_message": ""
                    }
                    ';

                }


            }else{

                return '
                {
                "status": "0",
                "error_message": "Same Entity exist in Entity folder. Entity creation failed",
                "success_message": ""
                }
                ';

            }

        }
        else{

            return '
            {
            "status": "0",
            "error_message": "No Entity Name provided. Entity creation failed",
            "success_message": ""
            }
            ';
        }

    }

    public function setControllerModelMapping($request){

        $req = (Array) $request;

        if(isset($req[0]) && isset($req[1])){

            $entity_name = $req[0];
            $controller_name = $req[1];
            $line_directory = str_replace("\\", "/", dirname(dirname(dirname(__DIR__))));
            $map_file = $line_directory."/SystemConstructor/App/Routing/routes.php";


            if(file_exists($map_file)){

                $file_content = '
Absoft\App\Routing\Route::set("'.$controller_name.'", "'.$entity_name.'");';

                if(file_exists($line_directory."/app/DatabaseBuilder/$entity_name.php") && file_exists($line_directory."/app/Controller/$controller_name.php")){

                    if(Route::getModelName($controller_name) == ""){

                        if(file_put_contents($map_file, $file_content, FILE_APPEND)){

                            return '
                            {
                            "status": "1",
                            "error_message": "",
                            "success_message": "Model Controller mapping is made you can view route map in \n '.$map_file.' file "
                            }
                            ';

                        }else{

                            return '
                            {
                            "status": "0",
                            "error_message": "Line cannot write on '.$map_file.' file. Model Controller mapping is failed.",
                            "success_message": ""
                            }
                            ';

                        }

                    }
                    else{

                        return '
                        {
                        "status": "0",
                        "error_message": "Same Route map exist.",
                        "success_message": ""
                        }
                        ';

                    }

                }
                else{

                    return '
                    {
                    "status": "0",
                    "error_message": "trying to map undefined '.$entity_name.' model and '.$controller_name.' controller",
                    "success_message": ""
                    }
                    ';

                }

            }
            else{

                return '
                {
                "status": "0",
                "error_message": "route_map file is deleted or misplaced from '.$map_file.'",
                "success_message": ""
                }
                ';

            }

        }else{

            return '
            {
            "status": "0",
            "error_message": "no model or controller name set",
            "success_message": ""
            }
            ';
        }

    }

    public function initialize($request){

        $return = [
            "status" => "0",
            "error_message" => "",
            "success_message" => ""
        ];

        if(isset($request->model)){

            $model_name = $request->model;
            $entity_name = str_replace("Model", "", $request->model);
            $initializer = str_replace("Model", "Initializer", $request->model);

            $main_add = str_replace("\\", "/", dirname(dirname(dirname(__DIR__))))."/app/";

            $address = $main_add."Models/$model_name.php";
            $init_address = $main_add."Initializers/$initializer.php";

            if(file_exists($address)){

                if(file_exists($init_address)){

                    try{

                        $str_model_name = 'Users\Initializers\\'.$initializer;
                        $init = new $str_model_name;
                        $result = $init->initialize($entity_name);

                        $return["status"] = "1";

                        foreach($result as $message){

                            $return["success_message"] .= " <br> ".$message;

                        }

                        \ErrorHandler::clearError();
                        return json_encode($return);

                    }catch (\Exception $e){

                        $return["status"] = "0";
                        $return["error_message"] = $e->getMessage();
                        return json_encode($return);

                    }

                }
                else{

                    $return["error_message"] = "there is no Initializer named $initializer";
                    return json_encode($return);

                }

            }else{

                $return["error_message"] = "there is no Model named $model_name ";
                return json_encode($return);

            }

        }
        else {

            $return["status"] = "0";
            $return["error_message"] = "no entity name were provided";
            return json_encode($return);

        }

    }

    public function allModel(){

        $return = [
            "status" => "0",
            "error_message" => "",
            "success_message" => ""
        ];

        $address = str_replace("\\", "/", dirname(dirname(dirname(__DIR__))))."/app/Models";

        if(file_exists($address)){

            if(is_dir($address)){

                $list = dir($address);

                while(($file = $list->read()) != false) {

                    if ($file == "." || $file == "..") {

                        continue;

                    } else {

                        if(strpos($file, "Model.php") > 0){

                            $return["models"][] = substr($file, 0, strpos($file, ".php"));

                        }

                    }

                }

                $return["status"] = "1";
                return json_encode($return);

            }
            else{

                $return["status"] = "0";
                $return["error_message"] = " Models folder is misplaced or file type is changed ";
                return json_encode($return);

            }

        }
        else{

            $return["status"] = "0";
            $return["error_message"] = " Models folder is deleted or misplaced. ";
            return json_encode($return);

        }

    }

    public function allEntity(){

        $return = [
            "status" => "0",
            "error_message" => "",
            "success_message" => ""
        ];

        $address = str_replace("\\", "/", dirname(dirname(dirname(__DIR__))))."/app/DatabaseBuilder";

        if(file_exists($address)){

            if(is_dir($address)){

                $list = dir($address);

                while(($file = $list->read()) != false) {

                    if ($file == "." || $file == "..") {

                        continue;

                    } else {

                        $return["entitys"][] = substr($file, 0, strpos($file, ".php"));

                    }

                }

                $return["status"] = "1";
                return json_encode($return);

            }
            else{

                $return["status"] = "0";
                $return["error_message"] = " DatabaseBuilder folder has been misplaced or file type has been changed ";
                return json_encode($return);

            }

        }
        else{

            $return["status"] = "0";
            $return["error_message"] = " DatabaseBuilder folder has been deleted or misplaced. ";
            return json_encode($return);

        }

    }

    public function allControllers(){

        $return = [
            "status" => "0",
            "error_message" => "",
            "success_message" => ""
        ];

        $address = str_replace("\\", "/", dirname(dirname(dirname(__DIR__))))."/app/Controller";

        if(file_exists($address)){

            if(is_dir($address)){

                $list = dir($address);

                while(($file = $list->read()) != false) {

                    if ($file == "." || $file == "..") {

                        continue;

                    } else {

                        if(strpos($file, "Controller.php") > 0){

                            $return["controllers"][] = substr($file, 0, strpos($file, ".php"));

                        }

                    }

                }

                $return["status"] = "1";
                return json_encode($return);

            }
            else{

                $return["status"] = "0";
                $return["error_message"] = " Controllers folder has been misplaced or file type has been changed ";
                return json_encode($return);

            }

        }
        else{

            $return["status"] = "0";
            $return["error_message"] = " Controllers folder has been deleted or misplaced. ";
            return json_encode($return);

        }

    }

    public function executeEntity($request){

        $return = [
            "status" => "0",
            "error_message" => "",
            "success_message" => ""
        ];

        if(isset($request->entity_name)){

            $entity_name = $request->entity_name;

            $address = str_replace("\\", "/", dirname(dirname(dirname(__DIR__))))."/app/DatabaseBuilder/$entity_name.php";

            if(file_exists($address)){

                include_once $address;

                try{

                    $str_entity_name = 'Users\DatabaseBuilders\\'.$entity_name;
                    $entity = new $str_entity_name;
                    $result = $entity->CreateEntity();

                    if($result["message"] == "1"){

                        $return["status"] = "1";
                        $return["success_message"] = " table named $entity_name has been created ";
                        \ErrorHandler::clearError();
                        return json_encode($return);

                    }else{

                        $return["status"] = "0";
                        $return["error_message"] = $result['returned'];
                        \ErrorHandler::clearError();
                        return json_encode($return);

                    }


                }catch (\Exception $e){

                    $return["status"] = "0";
                    $return["error_message"] = $e->getMessage();
                    return json_encode($return);

                }

            }else{

                $return["error_message"] = "there is no entity named $entity_name ";
                return json_encode($return);

            }

        }
        else {

            $return["status"] = "0";
            $return["error_message"] = "no entity name were provided";
            return json_encode($return);

        }

    }

    public function executeAllEntity(){

        $return = [
            "messages" => []
        ];

        $address = str_replace("\\", "/", dirname(dirname(dirname(__DIR__))))."/app/DatabaseBuilder";

        if(file_exists($address)){

            if(is_dir($address)){

                $list = dir($address);

                while(($file = $list->read()) != false) {

                    if ($file == "." || $file == "..") {

                        continue;

                    } else {

                        $entity_name = $return["models"][] = substr($file, 0, strpos($file, ".php"));
                        $return["messages"][] = "trying to execute $entity_name";
                        $result = (array) json_decode($this->executeEntity(json_decode(json_encode(["entity_name" => $entity_name]))));

                        if($result["status"] == "1"){

                            $return["messages"][] = $result["success_message"];

                        }else{

                            $return["messages"][] = $result["error_message"];

                        }


                    }

                }

                \ErrorHandler::clearError();
                return json_encode($return);

            }
            else{

                $return["messages"][] = " DatabaseBuilder folder is misplaced or file type is changed ";
                return json_encode($return);

            }

        }
        else{

            $return["messages"][] = " DatabaseBuilder folder is deleted or misplaced. ";
            return json_encode($return);

        }

    }

    public function deleteModel(){

    }

    public function deleteController(){

    }

    public function deleteEntity(){

    }

    public function update(){

        $update = new Updater();

        $update->start();

        return "";

    }

}
