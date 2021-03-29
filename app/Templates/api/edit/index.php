<?php
/**
 * Created by PhpStorm.
 * User: Abnet
 * Date: 11/13/2020
 * Time: 12:17 PM
 */

$this->loadTemplate("api/api_header.php");
?>

<div class="pt-3 pb-1 mb-3 border-bottom">
    <h1 class="h2">Edit Permissions</h1>
</div>

<?php

\Absoft\App\Pager\Alert::displayAlert();

if(isset($this->request->user) && sizeof((array) $this->request->user)){

    $user = $this->request->user;

    print '
    
    <ul class="list-group list-group-flush mt-lg-5">
        <li class="list-group-item active">User</li>
        <li class="list-group-item my-table-animation"><strong>Company Name: </strong> '.$user->company_name.'</li>
        <li class="list-group-item my-table-animation" style="animation-delay: 0.1s;"><strong>Agent Name: </strong> '.$user->agent_name.'</li>
        <li class="list-group-item my-table-animation" style="animation-delay: 0.2s;"><strong>Status: </strong> '.$user->status.' </li>
        <li class="list-group-item active">Permissions</li>
    </ul>
    
    ';

}

?>

<div class="table-responsive-sm mb-3">

    <table class="table table-striped table-sm">

        <thead>
        <tr>
            <th>Table Name</th>
            <th>Access</th>
            <th>Options</th>
        </tr>
        </thead>
        <tbody>
        <?php

        if(isset($this->request->permissions) && sizeof((array) $this->request->permissions)){

            $permissions = (array) $this->request->permissions;


            foreach ($permissions as $index => $permission){

                print '
            
                <tr class="my-table-animation" style="animation-delay: 0.'.$index.'s;">
                    <td>'.$permission->tables.'</td>
                    <td>'.$permission->permissions.'</td>
                    <td>
                        <form action="'.$this->route_address("api.rm_permission").'" class="m-0 p-0" method="post">
                            <input type="hidden" name="table" value="'.$permission->tables.'">
                            <input type="hidden" name="key" value="'.$permission->api_key.'">
                            <input type="hidden" name="permission" value="'.$permission->permissions.'">
                            <button class="btn btn-danger btn-sm" type="submit">Remove</button>
                        </form>
                    </td>
                </tr>
            
                ';

            }

        }

        ?>
        </tbody>

    </table>
</div>


<h2>New Permission</h2>

<form class="mb-3" action="<?php print $this->route_address("api.add_permission"); ?>" method="post">

    <input type="hidden" name="key" value="<?php print $this->request->user->api_key; ?>">

    <div class="input-group">
        <select class="custom-select" name="tables">

            <?php

            if(isset($this->request->entities)){

                $entities = $this->request->entities;

                foreach ($entities as $entity){

                    if($entity == "Api" || $entity == "ApiPermissions"){

                        continue;

                    }

                    print '<option value="'.$entity.'">'.$entity.'</option>';

                }

            }

            ?>

        </select>
        <select class="custom-select" name="permission">
            <option value="read">Read Access</option>
            <option value="write">Write Access</option>
        </select>
        <div class="input-group-append">
            <button class="btn btn-dark" type="submit">Permit</button>
        </div>
    </div>

</form>

<?php
$this->loadTemplate("api/api_footer.php");
?>
