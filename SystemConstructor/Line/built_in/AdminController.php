<?php
namespace Users\Super;

use Absoft\App\Pager\Alert;
use \Absoft\Line\Modeling\Controller;
use \Absoft\App\Routing\Route;

class AdminController extends Controller{

    public function route($name, $parameter)
    {

        if($name == "show"){

            $response = $this->databaseBuilders();

        }else if($name == "view"){

            $response = $this->view($parameter);

        }else if($name == "edit"){

            $response = $this->edit($parameter);

        }
        else if($name == "new_attribute"){

            $response = $this->newAttribute($parameter);

        }
        else if($name == "save"){

            $response = $this->save($parameter);

        }
        else if($name == "change_model"){

            $response = $this->changeModel($parameter);

        }
        else{
        
            \ErrorHandler::reportError(
                "Route Not Found!",
                "There is no Route named AdminController.".$name,
                __FILE__." on Line ".__LINE__
            );
        
            $response = Route::display("system_templates", "error");
        
        }
        
        return $response;

    }

    public function databaseBuilders(){
        //here write showing codes to be Executed

        $main_address = $this->_main_address."app/DatabaseBuilder";
        $return = [];

        if(file_exists($main_address)){

            if(is_dir($main_address)){

                $list = dir($main_address);

                while(($file = $list->read()) != false) {

                    if ($file == "." || $file == "..") {

                        continue;

                    } else {

                        $en_name = substr($file, 0, strpos($file, ".php"));
                        $temp["entity_name"] = $en_name;
                        $temp["created_on"] = filectime($main_address."/".$file);
                        $en_full_name = "Users\DatabaseBuilders\\".$en_name;
                        $temp["object"] = new $en_full_name;
                        $return[] = $temp;

                    }

                }

                if(sizeof($return) == 0){

                    Alert::sendInfoAlert("No DatabaseBuilders are Created yet!");

                }

                return Route::display("admin", "show", ["data" => $return]);

            }

        }

        Alert::sendErrorAlert("DatabaseBuilder should be folder! DatabaseBuilder folder not found!");
        return Route::display("admin", "show");

    }
    
    public function view($request){
        //here write viewing codes to be Executed

        $en_full_name = "Users\DatabaseBuilders\\".$request->table;
        $entity = new $en_full_name;

        return Route::display("admin", "view", ["entity" => $entity]);

    }

    public function edit($request){
        //Here write save codes to be Executed

        $entity_full_address = $this->_main_address."app/DatabaseBuilder/".$request->table.".php";

        if(file_exists($entity_full_address)){

            $entity_total_content = file_get_contents($entity_full_address);

            $ret_array = $this->divideEntity($entity_total_content);

            if(sizeof($ret_array)){

                if($request->on == "mains"){
                    $attributes = explode(",", $ret_array["attributes"]);
                }
                else{
                    $attributes = explode(",", $ret_array["hidden"]);
                }

                $properties = explode("->", $attributes[$request->index]);

                if($request->change == "type"){

                    $temp = explode("(", $properties[1]);

                    $temp[0] = $request->value;
                    $properties[1] = $temp[0]."(".$temp[1];

                }
                else if($request->change == "length" || $request->change == "sign" || $request->change == "unique" || $request->change == "nullable" || $request->change == "autoincrement"){

                    $size = sizeof($properties);
                    $flag = 0;
                    $key = 0;
                    while($key < $size){

                        if(strpos($properties[$key], $request->change) > -1){

                            if($request->index == (sizeof($attributes) - 1) && $key == ($size - 1)){
                                $properties[$key] = "$request->change($request->value)\r\n";
                            }else{
                                $properties[$key] = "$request->change($request->value)";
                            }

                            $flag = 1;
                            break;

                        }

                        $key += 1;

                    }

                    if($flag == 0){
                        $properties[$size-1] = explode(")", $properties[$size-1])[0].")";

                        if($request->index == (sizeof($attributes) - 1)){
                            $properties[] = "$request->change($request->value)\r\n";
                        }else{
                            $properties[] = "$request->change($request->value)";
                        }

                    }

                }
                else if($request->change == "name"){

                    $temp = explode("(", $properties[1]);

                    $temp[1] = "\"$request->value\")";
                    $properties[1] = $temp[0]."(".$temp[1];

                }
                else{

                    $size = sizeof($properties);
                    $flag = 0;
                    $key = 0;
                    while($key < $size){

                        if(strpos($properties[$key], $request->change) > -1){

                            if($request->index == (sizeof($attributes) - 1) && $key == (sizeof($properties) - 1)){
                                $properties[$key] = "$request->change(\"$request->value\")\r\n";
                            }else{
                                $properties[$key] = "$request->change(\"$request->value\")";
                            }

                            $flag = 1;
                            break;

                        }

                        $key += 1;

                    }

                    if($flag == 0){

                        $properties[$size-1] = explode(")", $properties[$size-1])[0].")";

                        if($request->index == (sizeof($attributes) - 1)){
                            $properties[] = "$request->change($request->value)\r\n";
                        }else{
                            $properties[] = "$request->change($request->value)";
                        }

                    }

                }

                //-----------------------saving file ---------------------

                if(sizeof($properties) > 1){

                    $temp = $properties[0];

                    for ($i = 1; $i < sizeof($properties); $i++){

                        $temp .= "->".$properties[$i];

                    }

                    $attributes[$request->index] = $temp;

                }

                if($request->on == "mains"){
                    $ret_array["attributes"] = implode(",", $attributes);

                    if((sizeof($attributes) - 1) == $request->index){
                        $entity_total_content = $ret_array["top_content"]."//@att_start".$ret_array["attributes"]."\t\t\t//@att_end".$ret_array["middle_content"]."//@hide_start".$ret_array["hidden"]."//@hide_end".$ret_array["bottom_content"];
                    }else{
                        $entity_total_content = $ret_array["top_content"]."//@att_start".$ret_array["attributes"]."//@att_end".$ret_array["middle_content"]."//@hide_start".$ret_array["hidden"]."//@hide_end".$ret_array["bottom_content"];
                    }

                }else{

                    $ret_array["hidden"] = implode(",", $attributes);

                    if((sizeof($attributes) - 1) == $request->index){
                        $entity_total_content = $ret_array["top_content"]."//@att_start".$ret_array["attributes"]."//@att_end".$ret_array["middle_content"]."//@hide_start".$ret_array["hidden"]."\t\t\t//@hide_end".$ret_array["bottom_content"];
                    }else{
                        $entity_total_content = $ret_array["top_content"]."//@att_start".$ret_array["attributes"]."//@att_end".$ret_array["middle_content"]."//@hide_start".$ret_array["hidden"]."//@hide_end".$ret_array["bottom_content"];
                    }

                }

                file_put_contents($entity_full_address, $entity_total_content);

                return Route::route("Admin.change_model", ["table" => $request->table]);

            }
            else{

                Alert::sendErrorAlert("Empty file!");
                return Route::route("Admin.show");

            }

        }

        Alert::sendErrorAlert("DatabaseBuilder $request->table were not found!");
        return Route::route("Admin.show");

    }
    
    public function save($request){
        //here write updating codes to be Executed

        $entity_full_address = $this->_main_address."app/DatabaseBuilder/".$request->table.".php";

        if(file_exists($entity_full_address)){

            $entity_total_content = file_get_contents($entity_full_address);

            $ret_array = $this->divideEntity($entity_total_content);

            if(sizeof($ret_array)){

                $attributes = explode(",", $ret_array[$request->category]);
                $att_size = sizeof($attributes);

                if($att_size > 0 && trim("\t", trim("\r", trim("\n", trim(" ", $attributes[$att_size - 1])))) != ""){

                    $last_exp = explode("->", $attributes[$att_size - 1]);

                    if(sizeof($last_exp) > 1){

                        $last_exp[sizeof($last_exp) - 1] = explode(")", $last_exp[sizeof($last_exp) - 1])[0].")";
                        $attributes[sizeof($attributes) - 1] = implode("->", $last_exp);
                        $schema_object = explode("->", $attributes[0])[0];

                    }
                    else{
                        $attributes = [];
                        $schema_object = "\r\n\t\t\t\$table";
                    }

                }
                else{
                    $schema_object = "\r\n\t\t\t\$table";
                }

                $properties[0] = $schema_object;
                $properties[1] = "$request->type(\"$request->name\")";

                foreach ($request as $item => $req){

                    if($item != "category" && $req != "" && $item != "table" && $item != "type" && $item != "name"){

                        if($item == "length" || $item == "sign" || $item == "unique" || $item == "nullable" || $item == "autoincrement"){
                            $properties[] = "$item($req)";
                        }
                        else{
                            $properties[] = "$item(\"$req\")";
                        }

                    }

                }

                //-----------------------saving file ---------------------

                if(sizeof($properties) > 1){

                    $temp = $properties[0];

                    for ($i = 1; $i < sizeof($properties); $i++){

                        $temp .= "->".$properties[$i];

                    }

                    $attributes[] = $temp;

                }

                $ret_array[$request->category] = implode(",", $attributes);

                if($request->category == "attributes"){

                    $entity_total_content = $ret_array["top_content"]."//@att_start".$ret_array["attributes"]."\r\n\t\t\t//@att_end".$ret_array["middle_content"]."//@hide_start".$ret_array["hidden"]."//@hide_end".$ret_array["bottom_content"];

                }else{

                    $entity_total_content = $ret_array["top_content"]."//@att_start".$ret_array["attributes"]."//@att_end".$ret_array["middle_content"]."//@hide_start".$ret_array["hidden"]."\r\n\t\t\t//@hide_end".$ret_array["bottom_content"];

                }

                file_put_contents($entity_full_address, $entity_total_content);

                Route::goRoute("Admin.change_model", ["table" => $request->table]);
                return "";
            }
            else{

                Alert::sendErrorAlert("Empty file!");
                Route::goRoute("Admin.show");
                return "";

            }

        }

        Alert::sendErrorAlert("DatabaseBuilder $request->table were not found!");
        Route::goRoute("Admin.show");
        return "";

    }

    public function newAttribute($request){
        return Route::display("admin", "add", ["table" => $request->table]);
    }
    
    public function delete($request){
        //here write deleting codes to be Executed
        return "";
    }

    private function divideEntity($content){

        $return = [];

        $first_explosion = explode("//@att_start", $content);

        $return["top_content"] = $first_explosion[0];

        $sec_explosion = explode("//@att_end", $first_explosion[1]);

        $return["attributes"] = $sec_explosion[0];

        $third_explosion = explode("//@hide_start", $sec_explosion[1]);

        $return["middle_content"] = $third_explosion[0];

        $fourth_explosion = explode("//@hide_end", $third_explosion[1]);

        $return["hidden"] = $fourth_explosion[0];

        $return["bottom_content"] = $fourth_explosion[1];

        return $return;

    }

    private function changeModel($request){

        $model_full_address = $this->_main_address."app/Models/".$request->table."Model.php";

        if(file_exists($model_full_address)){

            $model_total_content = file_get_contents($model_full_address);

            $ret_array = $this->divideEntity($model_total_content);

            $entity_full_name = "Users\DatabaseBuilders\\$request->table";
            $entity = new $entity_full_name;

            $hidden = [];
            $not_hidden = [];

            foreach($entity->ATTRIBUTES as $att){

                $not_hidden[] = "\r\n\t\t\"$att->name\" => \"\"";

            }

            foreach ($entity->HIDDEN_ATTRIBUTES  as $hide){

                $hidden[] = "\r\n\t\t\"$hide->name\" => \"\"";

            }

            if(sizeof($hidden) > 0){

                $ret_array["hidden"] = implode(",", $hidden);

            }

            if(sizeof($not_hidden) > 0){

                $ret_array["attributes"] = implode(",", $not_hidden);

            }

            //-----------------------saving file ---------------------

            $model_total_content = $ret_array["top_content"]."//@att_start".$ret_array["attributes"]."\r\n\t\t//@att_end".$ret_array["middle_content"]."//@hide_start".$ret_array["hidden"]."\r\n\t\t//@hide_end".$ret_array["bottom_content"];

            file_put_contents($model_full_address, $model_total_content);

            Route::goRoute("Admin.view", ["table" => $request->table]);
            return "";

        }
        else{

            $entity_full_name = "Users\DatabaseBuilders\\$request->table";
            $entity = new $entity_full_name;

            $hidden = [];
            $not_hidden = [];

            foreach($entity->ATTRIBUTES as $att){

                $not_hidden[] = "\r\n\t\t\"$att->name\" => \"\"";

            }

            foreach ($entity->HIDDEN_ATTRIBUTES  as $hide){

                $hidden[] = "\r\n\t\t\"$hide->name\" => \"\"";

            }

            $page_content = '<?php
namespace Users\Models;

use Absoft\Line\Modeling\Model;

class '.$request->table.'Model extends Model{

    /*
    public $MAINS = [
        "id" => "",
        "username" => "",
        "f_name" => ""
    ];

    */
    
    //As the name indicate this is the Table name of the Model
    
    public $TABLE_NAME = "'.$request->table.'";

    /**********************************************************************
        In this property you are expected to put all the columns you want
        other than the fields you want to be hashed.
    ***********************************************************************/

    public $MAINS = [
        //@att_start';
            if(sizeof($not_hidden) > 0){
                $page_content .= implode(",", $not_hidden);
            }
        $page_content .= '
        //@att_end
    ];
    
    /**********************************************************************
        In this field you are expected to put all columns you want to be
        encrypted or hashed.
    ***********************************************************************/
    
    public $HIDDEN = [
        //@hide_start';
            if(sizeof($hidden) > 0){
                $page_content .= implode(",", $hidden);
            }
        $page_content .= '
        //@hide_end
    ];

}
?>';
            file_put_contents($model_full_address, $page_content);

            Alert::sendInfoAlert("Model $request->table were not found! <br> new Model file created");
            Route::goRoute("Admin.view", ["table" => $request->table]);
            return "";

        }

    }

}
?>
