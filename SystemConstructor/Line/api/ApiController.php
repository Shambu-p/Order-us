<?php
/**
 * Created by PhpStorm.
 * User: Abnet
 * Date: 11/6/2020
 * Time: 11:27 AM
 */

namespace Absoft\Line\Api;


use Absoft\App\Pager\Alert;
use Absoft\App\Pager\Pager;
use Absoft\App\Routing\Route;
use Users\Models\ApiModel;
use Users\Models\ApiPermissionsModel;

class ApiController
{

    private $User = [];

    public function read($request){

        if(isset($request->key)){

            if($this->Authentication($request->key)){

                $result = [
                    "header" => [
                        "Provider" => "Absoft",
                        "Data_Permitted_to" => $request->key,
                        "error" => false,
                        "error_message" => ""
                    ],
                    "data" => []
                ];

            }
            else{

                return [
                    "header" => [
                        "Provider" => "Absoft",
                        "Data_Permitted_to" => $request->key,
                        "error" => true,
                        "error_message" => "invalid Key set"
                    ],
                    "data" => []
                ];

            }


        }
        else{

            return [
                "header" => [
                    "Provider" => "Absoft",
                    "Data_Permitted_to" => "Unknown",
                    "error" => true
                ],
                "data" => ""
            ];

        }

        foreach($request as $key => $val){

            if(is_object($val)){

                $result["data"] = $this->getTable($key, $val);

            }

        }

        if(\ErrorHandler::checkError()){

            if(isset($_SESSION["_system"]["error_handling"]["error"]["title"])){

                $result["header"]["error_message"] = $_SESSION["_system"]["error_handling"]["error"]["title"];

            }

            \ErrorHandler::clearError();

        }
        else{

            $result["header"]["error_message"] = "";

        }

        return $result;

    }

    public function write($request){



        return "";

    }

    public function getOther($first, $table){

        $return = [];

        //$reflection = new \ReflectionClass($model_name);
        $full_model_name = "Users\Models\\".$table."Model";
        $model = new $full_model_name;

        $reference = $model->getEntity()->getReference($first->TABLE_NAME);

        if($reference != ""){

            $value = $first->MAINS[$first->getEntity()->PRIMARY_KEY];


            if($value != ""){

                //$return = $model->find($value);
                $return["message"] = "1";
                $return["returned"] = [
                    "name" => "$reference",
                    "value" => $value,
                    "equ" => "=",
                    "det" => "and"
                ];

            }
            else{

                $return["message"] = "-6";
                $return["returned"] = "The value of the attribute in the model ".$model->TABLE_NAME." is empty";

                \ErrorHandler::reportError(
                    "Empty Value!",
                    "The value of the attribute in the model ".$model->TABLE_NAME." is empty",
                    __FILE__." on Line ".__LINE__,
                    "immediate"
                );

            }

        }
        else{

            $return["message"] = "-6";
            $return["returned"] = "There is no column references to table named ". $model->TABLE_NAME ." in Entity ". $first->TABLE_NAME;

            \ErrorHandler::reportError(
                "Column Not Found!",
                "There is no column named ". $model->TABLE_NAME ." in Entity ". $first->TABLE_NAME,
                __FILE__." on Line ".__LINE__,
                "immediate"
            );

        }

        return $return;

    }

    private function getTable($lower_table, $next, $upper_table = null){

        $conditions = [];
        $filters = [];
        $next_tbl = [];

        if($this->readCheck($lower_table)){

            foreach ($next as $key => $value){

                if(is_object($value)){

                    $next_tbl[$key] = $value;
                    continue;

                }
                else if($value){

                    $temp["name"] = $key;
                    $temp["value"] = $value;
                    $temp["equ"] = "=";
                    $temp["det"] = "and";
                    $conditions[] = $temp;
                    $filters[] = $key;

                }
                else{

                    $filters[] = $key;

                }

            }

            if($upper_table != null){

                $result1 = $this->getOther($upper_table, $lower_table);

                //print_r($result1);

                if($result1["message"] == "1"){

                    $conditions[] = $result1["returned"];

                    try{

                        $full_lower_table_name = "Users\Models\\".$lower_table."Model";
                        $lower_model = new $full_lower_table_name;
                        $result = $lower_model->search($conditions);

                        foreach($result as $key => $val){

                            if(isset($lower_model->MAINS[$key])){

                                $lower_model->MAINS[$key] = $val;

                            }

                            if(isset($lower_model->HIDDEN[$key])){

                                $lower_model->HIDDEN[$key] = $val;

                            }

                            if(!in_array($key, $filters)){

                                unset($result[$key]);

                            }

                        }

                        foreach($next_tbl as $tb_name => $att){

                            $result[$tb_name] = $this->getTable("Users\Models\\".$tb_name."Model", $att, $lower_model);

                        }

                        return $result;

                    }catch (\Exception $ex){

                        \ErrorHandler::reportError(
                            "Reflection Exception!",
                            $ex->getMessage(),
                            __FILE__." on Line ".__LINE__,
                            "immediate"
                        );

                        return [];

                    }

                }
                else{

                    return [];

                }

            }
            else{

                try{

                    //$reflection = new \ReflectionClass($lower_table);
                    $full_lower_table_name = "Users\Models\\".$lower_table."Model";
                    $lower_model = new $full_lower_table_name;
                    $result[$lower_table] = $lower_model->search($conditions);

                    foreach($result[$lower_table] as $index => $rec){

                        foreach($rec as $key => $val){

                            if(isset($lower_model->MAINS[$key])){

                                $lower_model->MAINS[$key] = $val;

                            }

                            if(isset($lower_model->HIDDEN[$key])){

                                $lower_model->HIDDEN[$key] = $val;

                            }

                            if(!in_array($key, $filters)){

                                unset($result[$index][$key]);

                            }

                        }

                        foreach($next_tbl as $tb_name => $att){

                            $result[$lower_table][$index][$tb_name] = $this->getTable($tb_name, $att, $lower_model);

                        }

                    }

                    return $result;

                }catch (\Exception $ex){

                    \ErrorHandler::reportError(
                        "Reflection Exception!",
                        $ex->getMessage(),
                        __FILE__." on Line ".__LINE__,
                        "immediate"
                    );

                    return [];

                }

            }

        }
        else{
            return [];
        }

    }

    public function Authentication($key){

        try{

            $variables = Route::lineVariables();
            //if(isset($variables->auto_api) && $variables->auto_api == true){

                $model_name = 'Users\Models\ApiModel';
                $permission_model_name = 'Users\Models\ApiPermissionsModel';

                $model = new $model_name;

                $result = $model->find($key);

                if(sizeof($result) > 0){

                    if($result["status"] == "active"){

                        $permission_model = new $permission_model_name;
                        $this->User = $permission_model->byKey($key);

                        return true;

                    }

                }

            //}

        }
        catch (\Exception $ex){

            \ErrorHandler::reportError(
                "Exception!",
                $ex->getMessage(),
                __FILE__." on Line ".__LINE__,
                "immediate"
            );

        }

        return false;

    }

    public function readCheck($table){

        foreach ($this->User as $item){

            if($item["tables"] == $table && $item["permissions"] == "read"){

                return true;

            }

        }

        return false;

    }

    public function addNewUser($request){

        $values = (array) $request;
        //print_r($request);

        $model = new ApiModel();

        $values["api_key"] = strtotime("now");
        $values["status"] = "active";

        if($model->addRecord($values)){

            Alert::sendSuccessAlert("New API Users has been added");
            return Route::route("api.new_api_user");

        }
        else{

            Alert::sendErrorAlert("cannot add this API User! Operation Failed!!");
            return Route::display("api", "add");

        }

    }

    public function allUsers($request){

        $return = [];
        $model = new ApiModel();

        $data = $model->allUsers();

        if(isset($request->page_number)){

            $return["show"] = Pager::pageData($data, "api_users", $request->page_number);

        }
        else{

            $pager = new Pager();
            $headers = new \stdClass();
            $headers->page_name = "api_users";
            $headers->sub_page = "show";
            $pager->create($headers, "Users.show_page", "api_users", 10);
            Pager::linkPageClass("api_users", "btn btn-light");
            Pager::currentPageClass("api_users", "btn btn-dark");

            $return["show"] = Pager::pageData($data, "api_users", 1);

        }

        return Route::display("api", "show", $return);

    }

    public function viewUser($request){

        $return = [];
        $model = new ApiModel();

        $return["view"] = $model->find($request->key);

        $data = $model->allUsers();

        $pager = new Pager();
        $headers = new \stdClass();
        $headers->page_name = "api_users";
        $headers->sub_page = "show";
        $pager->create($headers, "Users.show", "api_users", 10);
        Pager::linkPageClass("api_users", "btn btn-light");
        Pager::currentPageClass("api_users", "btn btn-dark");

        $return["show"] = Pager::pageData($data, "api_users", 1);

        return Route::display("api", "show", $return);

    }

    public function editUser($request){

        $full_name = 'Users\Models\ApiModel';
        $model = new $full_name;

        $result = $model->find($request->key);

        foreach ($result as $item => $values){

            if(isset($model->MAINS[$item])){

                $model->MAINS[$item] = $values;

            }

        }

        $result1 = $model->Permissions();

        $address = $_SESSION["_system"]["_main_url"]."DatabaseBuilder";

        if(file_exists($address)){

            if(is_dir($address)){

                $list = dir($address);
                $entities = [];

                while(($file = $list->read()) != false) {

                    if (($file == "." || $file == "..") || (strpos($file, ".php") <= 1)) {

                        continue;

                    } else {

                        $entities[] = substr($file, 0, strpos($file, ".php"));

                    }

                }

            }
            else{

                $entities = [];

            }

        }
        else{
            $entities = [];
        }

        return Route::display("api", "edit", ["user" => $result, "permissions" => $result1, "entities" => $entities]);

    }

    public function add_permission($request){

        $pr_model_name = 'Users\Models\ApiPermissionsModel';

        $model = new $pr_model_name;

        if(isset($request->key) && isset($request->tables) && isset($request->permission)){

            $result = $model->search(
                [
                    [
                        "name" => "api_key",
                        "value" => $request->key,
                        "equ" => "=",
                        "det" => "and"
                    ],
                    [
                        "name" => "permissions",
                        "value" => $request->permission,
                        "equ" => "=",
                        "det" => "and"
                    ],
                    [
                        "name" => "tables",
                        "value" => $request->tables,
                        "equ" => "=",
                        "det" => "and"
                    ]
                ]
            );

            if(sizeof($result) > 0){

                Alert::sendErrorAlert("there exist the same permission!");
                Route::goRoute("api.edit", ["key" => $request->key]);
                die();

            }

            $array = [
                "api_key" => $request->key,
                "tables" => $request->tables,
                "permissions" => $request->permission
            ];

            if($model->addRecord($array)){

                Alert::sendSuccessAlert("Permission Added Successfully");
                Route::goRoute("api.edit", ["key" => $request->key]);
                die();

            }
            else{

                Alert::sendErrorAlert("Permission Not added! Problem occurred! Operation Failed!");
                Route::goRoute("api.edit", ["key" => $request->key]);
                die();

            }

        }
        else{
            Alert::setErrorClassName("Column Data missed!");

            if(isset($request->key)){

                Route::goRoute("api.edit", ["key" => $request->key]);
                die();

            }

            Route::goRoute("api.show");
            die();

        }

        return '';

    }

    public function remove_permission($request){

        $model_full_name = 'Users\Models\ApiPermissionsModel';
        $model = new $model_full_name;

        $model->MAINS["api_key"] = $request->key;
        $result = $model->User();

        if(sizeof($result)){

            if($model->delete($request->key, $request->table, $request->permission)){

                Alert::sendSuccessAlert("Permission has been deleted");
                Route::goRoute("api.edit", ["key" => $request->key]);

            }
            else{
                Alert::sendErrorAlert("Cannot Delete Permission! Operation Failed!");
                Route::goRoute("api.edit", ["key" => $request->key]);
            }


        }
        else{

            Alert::sendErrorAlert("No Users found with the api key provided");
            Route::goRoute("api.edit", ["key" => $request->key]);

        }

        return '';

    }

    public function deactivate($request){

        $full_model_name = 'Users\Models\ApiModel';
        $model = new $full_model_name;

        if(isset($request->key)){

            if($model->deactivate($request->key)){

                Alert::sendSuccessAlert("API Users has been deactivated!");
                Route::goRoute("api.view", ["key" => $request->key]);

            }
            else{

                Alert::sendErrorAlert("Problem encountered During deactivating user! Operation failed");
                Route::goRoute("api.view", ["key" => $request->key]);

            }

        }
        else{

            Alert::sendErrorAlert("API User key should be set to deactivate! Operation failed!");
            Route::goRoute("api.show");

        }

        return '';

    }

    public function activate($request){

        $full_model_name = 'Users\Models\ApiModel';
        $model = new $full_model_name;

        if(isset($request->key)){

            if($model->activate($request->key)){

                Alert::sendSuccessAlert("API Users has been Activated!");
                Route::goRoute("api.view", ["key" => $request->key]);

            }
            else{

                Alert::sendErrorAlert("Problem encountered During activating user! Operation failed");
                Route::goRoute("api.view", ["key" => $request->key]);

            }

        }
        else{

            Alert::sendErrorAlert("API User key should be set to activate! Operation failed!");
            Route::goRoute("api.show");

        }

        return '';

    }

    public function search($request){

        $full_model_name = 'Users\Models\ApiModel';
        $model = new $full_model_name;

        if(isset($request->word)){

            $result = $model->searchAll($request->word);

            return Route::display("api", "show", ["show" => $result]);

        }
        else{

            Alert::sendErrorAlert("Operation Failed!");
            Route::goRoute("api.show");

        }

        return '';

    }

}
