<?php
namespace Users\Controllers;

use Absoft\App\Pager\Alert;
use Absoft\App\Security\Auth;
use \Absoft\Line\Modeling\Controller;
use \Absoft\App\Routing\Route;
use Users\Models\PostsModel;
use Absoft\App\Pager\Pager;

class PostsController extends Controller{


    public function route($name, $parameter)
    {

        if($name == "show"){

            $response = $this->show($parameter);

        }else if($name == "save"){

            $response = $this->save($parameter);

        }else if($name == "view"){

            $response = $this->view($parameter);

        }else if($name == "update"){

            $response = $this->pin($parameter);

        }
        else if($name == "add"){

            $response = $this->add();

        }
        else{

            \ErrorHandler::reportError(
                "Route Not Found!",
                "There is no Route named PostsController.".$name,
                __FILE__." on Line ".__LINE__
            );
            $response = Route::display("system_templates", "error");
        
        }

        return $response;

    }

    public function show($request){

        $model = new PostsModel();

        $data = $model->search(
            [
                [
                    "name" => "pin",
                    "value" => "false",
                    "equ" => "=",
                    "det" => "and"
                ]
            ],
            [],
            "",
            [
                "att" => "id",
                "det" => "0"
            ]
        );
        $pinned = $model->search(
            [
                [
                    "name" => "pin",
                    "value" => "true",
                    "equ" => "=",
                    "det" => "and"
                ]
            ]
        );

        if(!Pager::check("posts")){

            $pager = new Pager();
            $headers = new \stdClass();
            $headers->page_name = "posts";
            $headers->sub_page = "show";
            $pager->create($headers, "Posts.show", "posts", 9);

            Pager::linkPageClass("posts", "btn btn-secondary btn-sm");
            Pager::currentPageClass("posts", "btn btn-dark btn-sm");

        }

        $result = Pager::pageData($data, "posts", $request->page_number);
        unset($data);

        return Route::display("open", "home", ["posts" => $result, "pinned" => $pinned]);

    }

    private function add(){
        Route::view("admin", "new_post");
        return "";
    }

    public function save($request){

        if(!Auth::checkLogin()){
            Alert::sendErrorAlert("Login First");
            Route::goRoute("Auth.sign_in");
        }
        else if(!Auth::checkUser("role", "admin")){
            Alert::sendErrorAlert("You are not eligible");
            Route::goRoute("Auth.sign_in");
        }

        $text = $request->text;

        if(isset($_FILES["imageInput"]) && is_array($_FILES["imageInput"])){

            $oname = $_FILES['imageInput']['name'];
            $tmp_place = $_FILES['imageInput']['tmp_name'];
            $type = strtolower(pathinfo($oname)["extension"]);

            $allowed = array("jpg", "jpeg", "png", "ico");

            if(in_array($type, $allowed)){

                $tm = strtotime("now");

                if(move_uploaded_file($tmp_place, "./resource/images/post_images/post_image_$tm.$type")){

                    $post_data = [
                        "image" => "post_images/post_image_$tm.$type",
                        "text" => $text,
                        "pin" => "false",
                        "date" => $tm
                    ];

                    $model1 = new PostsModel();

                    if($model1->addRecord($post_data)){
                        Alert::sendSuccessAlert("Posting is Successful!");
                        Route::view("admin", "new_post");
                    }
                    else{
                        Alert::sendSuccessAlert("Posting is Successful!");
                        Route::view("admin", "new_post");
                    }

                }
                else{

                    unlink($tmp_place);
                    Alert::sendErrorAlert("Cannot move the file. Posting failed!");
                    Route::view("admin", "new_post");

                }
            }
            else{
                unlink($tmp_place);
                Alert::sendErrorAlert(" Incorrect Image Format! ".$type);
                Route::view("admin", "new_post");
            }

        }
        else{

            Alert::sendErrorAlert("No Image file uploaded. Posting failed!");
            Route::view("admin", "new_post");

        }

        return "";

    }

    public function view($request){

        $model = new PostsModel();

        return Route::display("posts", "view", ["post" => $model->find($request->post)]);

    }

    public function pin($request){

        $model = new PostsModel();
        $model->update(
            [
                "pin" => "false"
            ],
            [
                "pin" => [
                    "value" => "true",
                    "equ" => "=",
                    "det" => "and"
                ]
            ]
        );

        $model->update(
            [
                "pin" => "true"
            ],
            [
                "id" => [
                    "value" => $request->pin,
                    "equ" => "=",
                    "det" => "and"
                ]
            ]
        );

        Route::goRoute("Posts.show");

        return "";

    }

}
?>
