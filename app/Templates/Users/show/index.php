<?php
/**
 * Created by PhpStorm.
 * User: Abnet
 * Date: 3/5/2020
 * Time: 6:07 PM
 */

$this->loadTemplate("header2.php");



?>

    <br>
    <div class="container" style="overflow-x: auto;">

        <table class="table table-borderless rounded">
            <thead>
            <tr>
                <th>User Name</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Email</th>
                <th>Role</th>
                <th>Phone</th>
                <th>Options</th>
            </tr>
            </thead>
            <tbody>

            <?php

            if(isset($this->request->data) ){

                $data = (array) $this->request->data;

                foreach($data as $req){

                    print '
                <tr>
                    <td>'.$req->username.'</td>
                    <td>'.$req->f_name.'</td>
                    <td>'.$req->l_name.'</td>
                    <td>'.$req->email.'</td>
                    <td>'.$req->role.'</td>
                    <td>'.$req->phone_number.'</td>
                    <td>';

                    if(isset($this->request->reg_requests) && isset($_SESSION["role"]) && $_SESSION['role'] == "director"){

                        print '
                        <div class="btn-group" role="group" aria-label="Basic example">
                            <a href="'.Route::goRouteAddress("Users.change_status", ["username" => $req->username, "state" => "active"]).'" class="btn btn-success active" role="button" aria-pressed="true">Approve</a>
                            <a href="'.Route::goRouteAddress("Users.change_status", ["username" => $req->username, "state" => "declined"]).'" class="btn btn-danger active" role="button" aria-pressed="true">Decline</a>
                        </div>
                    </td>
                </tr>
                ';

                    }
                    else if(isset($this->request->all_employees)){

                        print '
                        <div class="btn-group" role="group" aria-label="Basic example">
                            <a class="btn btn-dark btn-sm" role="button" aria-pressed="true" href="'.Route::goRouteAddress("Users.view", ["username" => $req->username]).'">view</a>
                            ';

                        if(isset($_SESSION["role"]) && $_SESSION['role'] == "director"){

                            if($req->status == "active"){

                                print
                                    '<a class="btn btn-danger btn-sm" role="button" aria-pressed="true" href="'.Route::goRouteAddress("Users.change_status", ["username" => $req->username, "state" => "deactivate"]).'">Deactivate</a>
                            </div>
                        </td>
                    </tr>
                    ';

                            }
                            else if($req->status == "deactivate"){

                                print
                                    '<a class="btn btn-success btn-sm" role="button" aria-pressed="true" href="'.Route::goRouteAddress("Users.change_status", ["username" => $req->username, "state" => "active"]).'">Activate</a>
                            </div>
                        </td>
                    </tr>
                    ';

                            }

                        }

                    }

                }

            }
            ?>
            </tbody>
        </table>

    </div>

<?php
$this->loadTemplate("footer2.php");
?>
