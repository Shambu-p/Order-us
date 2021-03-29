<?php
namespace Users\Controllers;

use Absoft\App\Security\Auth;
use Absoft\Line\Modeling\Controller;
use Absoft\App\Routing\Route;
use Absoft\App\Pager\Alert;
use http\Message;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\PHPMailer;
use Users\Models\RecoveryModel;
use Users\Models\UsersModel;

class AuthController extends Controller{

    public function route($name, $parameter)
    {

        $_SESSION["_system"]["error_handling"]["error_for"] = "API";

        if($name == "login"){

            $response = $this->login($parameter);

        }
        else if($name == "api_login"){

            $response = $this->api_login($parameter);

        }
        else if($name == "log"){

            $response = $this->log();

        }
        else if($name == "forget_password"){

            $response = $this->forgetPassword($parameter);

        }
        else if($name == "confirm"){

            $response = $this->confirmation($parameter);

        }
        else if($name == "logout"){

            $response = $this->logout();

        }
        else if($name == "sign_in"){

            $response = $this->signIn();

        }
        else if($name == "get_in"){

            $response = $this->my_account();

        }
        else{

            \ErrorHandler::reportError(
                "Route Not Found!",
                "There is no Route named AuthController.".$name,
                __FILE__." on Line ".__LINE__
            );

            $response = Route::display("system_templates", "error");

        }

        return $response;

    }

    public function signIn(){

        if(Auth::checkLogin()){

            return Route::display("auth", "first_page");

        }

        return Route::display("auth", "login");

    }

    public function login($request){
        //here write showing codes to be Executed

        $model = new UsersModel();

        if(Auth::checkLogin()){

            return Route::display("auth", "first_page");

        }

        $password = $request->password;
        $user_name = $request->user_name;

        $result = $model->search(
            [
                [
                    "name" => "username",
                    "value" => $user_name,
                    "equ" => "=",
                    "det" => "and"
                ]
            ]
        );



        if(sizeof($result) > 0){

            $data = $result[0];

            $hash_password = $data["password"];

            if(password_verify($password, $hash_password)){

                Auth::grant($data);

                Alert::sendSuccessAlert("You have successfully Logged in");
                Route::view("auth", "first_page");

            }
            else{

                Alert::sendErrorAlert("Incorrect username or password login failed ");
                Route::view("auth", "login");

            }

        }
        else {

            Alert::sendInfoAlert("No user found with your id.");
            Route::view("auth", "login");

        }

        return "";

    }

    private function log(){

        $user = Auth::user();

        if($user){
            return Route::display("my_api", "index", ["state" => true, "user" => $user]);
        }

        return Route::display("my_api", "index", ["state" => false, "user" => []]);

    }

    public function api_login($request){
        //here write showing codes to be Executed

        $model = new UsersModel();

        if(Auth::checkLogin()){

            return Route::display("my_api", "index", [
                "status" => true,
                "message" => "logged in",
                "user" => Auth::user()
            ]);

        }

        $password = $request->password;
        $user_name = $request->user_name;

        $data = $model->search(
            [
                [
                    "name" => "username",
                    "value" => $user_name,
                    "equ" => "=",
                    "det" => "and"
                ]
            ]
        )[0];

        if(sizeof($data) > 0){

            $hash_password = $data["password"];

            if(password_verify($password, $hash_password)){
                
                Auth::grant($data);

                return Route::display("my_api", "index", [
                    "status" => true,
                    "message" => "logged in",
                    "user" => $data
                ]);

            }
            else{

                return Route::display("my_api", "index", [
                    "status" => false,
                    "message" => "incorrect Password",
                    "user" => []
                ]);

            }

        }
        else {

            return Route::display("my_api", "index", [
                "status" => false,
                "message" => "No user found",
                "user" => []
            ]);

        }

    }
    
    public function forgetPassword($request){
        //here write viewing codes to be Executed

        if(Auth::checkLogin()){

            return Route::display("auth", "first_page");

        }

        $model = new UsersModel();
        $recovery_model = new RecoveryModel();

        $result = $model->search(
            [
                [
                    "name" => "username",
                    "value" => $request->user_name,
                    "equ" => "=",
                    "det" => "and"
                ],
                [
                    "name" => "email",
                    "value" => $request->email,
                    "equ" => "=",
                    "det" => "and"
                ]
            ]
        );

        if(sizeof($result)){

            $now = strtotime("now");
            $sz = strlen($now);

            $code = $now[$sz-4].$now[$sz-3].$now[$sz-2].$now[$sz-1];
            $description = json_decode(file_get_contents($this->_main_address."sys_description.json"));
            $project = $description->project_name;

            if($description->project_email){

                $project_email = "<".$description->project_email.">";

            }
            else{

                $project_email = "";
            }

            $to = $result[0]["email"];
            $subject = 'Recover Your Account';
            $message = '<html>
                <body>
                <p>
                    <b>Some one is try to login to your account.</b> <br>
                    If it is you insert the following confirmation code to confirm who you realy are.
                    else if it is not you ignore this and do not share this code to any one.
                </p>
                <p>
                    Your confirmation code is <i>.'.$code.'</i>
                </p>
                </body>
            </html>';

            /*$headers = implode("\r\n", [
               "From: $project $project_email",
               "X-Mailer: PHP/" . PHP_VERSION,
               "MIME-Version: 1.0",
               "Content-Type: text/html; charset=UTF-8"
            ]);*/

            $rec_result = $recovery_model->byUser($request->user_name);

            if(sizeof($rec_result)){

                $db_result = $recovery_model->update(
                    [
                        "confirmation" => $code,
                    ],
                    [
                        [
                            "name" => "username",
                            "value" => $request->user_name,
                            "equ" => "=",
                            "det" => "and"
                        ]
                    ]
                );

            }else{

                $db_result = $recovery_model->addRecord(
                    [
                        "username" => $request->user_name,
                        "confirmation" => $code
                    ]
                );

            }

            if($db_result){

                //ini_set("SMTP","tls://smtp.gmail.com");

                $mail = new PHPMailer();

                //smtp settings
                $mail->isSMTP();
                $mail->Host = "smtp.gmail.com";
                $mail->SMTPAuth = true;
                $mail->Username = "abnet.kebede075@gmail.com";
                $mail->Password = "Shambel4419/09?";
                $mail->Port = 587;
                $mail->SMTPSecure = "ssl";

                //email settings
                $mail->isHTML(true);

                try{

                    $mail->setFrom("abnet.kebede075@gmail.com", "Smart Techno");
                    $mail->addAddress($to);
                    $mail->Subject = $subject;
                    $mail->Body = $message;

                    if($mail->send()){

                        Alert::sendInfoAlert("Confirmation code has been sent to your email address ".$result[0]["email"]);
                        return Route::display("auth", "recovery", ["user" => $result[0]["username"], "state" => "sent"]);

                    }
                    else{

                        Alert::sendErrorAlert("Cannot send Confirmation code! Mailer Failed! <br> try later.".$mail->ErrorInfo);
                        return Route::display("auth", "recovery", ["user" => $result[0]]);
                        
                    }

                }
                catch (Exception $e) {

                    Alert::sendErrorAlert("Cannot send Confirmation code! <br> try later.".$e->getMessage());
                    return Route::display("auth", "recovery", ["user" => $result[0]]);

                }

            }
            else{

                Alert::sendErrorAlert("Cannot send Confirmation code! try again later!");
                return Route::display("auth", "recovery", ["user" => $result[0]]);

            }

        }
        else{

            Alert::sendErrorAlert("There is no User with the given Username and password! Operation Failed! <br> try later.");
            return Route::display("auth", "forget_password");

        }

    }

    public function confirmation($request){

        $model = new RecoveryModel();
        $result = $model->byUser($request->user);

        if(sizeof($result)){

            if(password_verify($request->code, $result["code"])){

                return Route::display("auth", "new_password");

            }

        }

        Alert::sendErrorAlert("incorrect Confirmation code");
        return Route::display("auth", "recover");

    }

    public function logout(){
        //Here write save codes to be Executed

        Auth::deni();
        Route::goRoute("Auth.sign_in");
        return "";

    }

    private function my_account(){

        if(!Auth::checkLogin()){

            Route::goRoute("Auth.sign_in");

        }

        $user = Auth::user();

        if($user->role == "admin"){

            Route::goRoute("Orders.new_orders");

        }
        else if($user->role == "designer"){

            Route::goRoute("OrdersDesigners.my_order", ["designer" => $user->username]);

        }
        else if($user->role == "cashier"){

            Route::goRoute("Orders.approved_orders");

        }
        else{

            Route::goRoute("Auth.login");

        }
    }

}
?>
