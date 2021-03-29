<?php
/**
 * Created by PhpStorm.
 * User: Abnet
 * Date: 2/18/2020
 * Time: 3:51 PM
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
                    <td>
                    <div class="btn-group" role="group" aria-label="Basic example">
                        <a href="'.Route::goRouteAddress("Users.change_status", ["username" => $req->username, "state" => "active"]).'" class="btn btn-success active" role="button" aria-pressed="true">Approve</a>
                        <a href="'.Route::goRouteAddress("Users.change_status", ["username" => $req->username, "state" => "declined"]).'" class="btn btn-danger active" role="button" aria-pressed="true">Decline</a>
                    </div>
                    </td>
                </tr>
                ';

            }
        }
        ?>
        </tbody>
    </table>

</div>

<?php
$this->loadTemplate("footer2.php");
?>
