<?php
/**
 * Created by PhpStorm.
 * User: Abnet
 * Date: 12/13/2020
 * Time: 7:38 PM
 */

$this->loadTemplate("layouts/admin_header.php");
?>

    <div class="table-responsive mt-5">
        <table class="table table-striped table-sm">
            <thead>
            <tr>
                <th>Username</th>
                <th>Name</th>
                <th>Phone</th>
                <th>Email</th>
                <th>Status</th>
                <th>opt</th>
            </tr>
            </thead>
            <tbody>

            <?php

            if(isset($this->request->users) && sizeof((array) $this->request->users)){

                $users = $this->request->users;

                foreach ($users as $user){

                    print '
            
                    <tr>
                        <td>'.$user->username.'</td>
                        <td>'.$user->f_name.' '.$user->l_name.'</td>
                        <td>'.$user->phone_number.'</td>
                        <td>'.$user->email.'</td>
                        <td>'.$user->status.'</td>
                        <td>
                            <a class="card-link small" href="'.$this->route_address("Users.view", ["user" => $user->username]).'">View</a>
                        </td>
                    </tr>
                    
                    ';

                }

            }
            else{

                print '
                    </tbody>
                </table>
                <tr>
                    <div class="jumbotron jumbotron-fluid">
                        <div class="container">
                            <h1 class="display-4">No User Found</h1>
                        </div>
                    </div>
                </tr>
                ';

            }

            ?>

            </tbody>
        </table>
    </div>

<?php
$this->loadTemplate("layouts/admin_header.php");
