<?php
/**
 * Created by PhpStorm.
 * User: Abnet
 * Date: 11/13/2020
 * Time: 11:26 AM
 */

$this->loadTemplate("api/api_header.php");
?>

    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">

        <h1 class="h2">API Users</h1>

    </div>

<?php

\Absoft\App\Pager\Alert::displayAlert();

if(isset($this->request->view)){

    $view = $this->request->view;

    print '<div class="container w-100 mb-lg-5">';

    print '
    
    <ul class="list-group list-group-flush mb-5">
        <li class="list-group-item"><strong>Company: </strong> '.$view->company_name.'</li>
        <li class="list-group-item"><strong>Agent: </strong> '.$view->agent_name.' </li>
        <li class="list-group-item"><strong>Status: </strong> '.$view->status.'</li>
    </ul>
    
    <a href="'.$this->route_address("api.edit", ["key" => $view->api_key]).'" class="btn btn-sm btn-primary d-inline">Edit Permission</a>
    
    ';

    if($view->status == "active"){

        print '
        
        <form class="d-inline m-0 p-0" action="'.$this->route_address("api.deactivate").'" method="post">
        
            <input type="hidden" name="key" value="'.$view->api_key.'">
            <button type="submit" class="btn btn-sm btn-danger">Deactivate</button>
        
        </form>
        
        ';

    }
    else{

        print '
        
        <form class="d-inline m-0 p-0" action="'.$this->route_address("api.activate").'" method="post">
        
            <input type="hidden" name="key" value="'.$view->api_key.'">
            <button type="submit" class="btn btn-sm btn-success">Activate</button>
        
        </form>
        
        ';

    }

    print '</div>';

}

?>

    <h2 class="mt-3">All Users</h2>

    <div class="table-responsive-sm mb-3">

        <?php

        if(isset($this->request->show) && sizeof($this->request->show) > 0){

            print '
            <table class="table table-striped table-sm">
            <thead>
                <tr>
                    <th>Key</th>
                    <th>Company Name</th>
                    <th>Agent</th>
                    <th>Status</th>
                    <th>Options</th>
                </tr>
            </thead>
            <tbody>
            ';

            foreach ($this->request->show as $users){

                print '
                
                <tr class="my-table-animation">
                    <td>'.$users->api_key.'</td>
                    <td>'.$users->company_name.'</td>
                    <td>'.$users->agent_name.'</td>
                    <td>'.$users->status.'</td>
                    <td>
                        <a href="'.$this->route_address("api.view", ["key" => $users->api_key]).'" class="btn btn-sm btn-primary d-inline">view</a>
                    </td>
                </tr>
                
                ';

            }

            print '</tbody></table>';

        }
        else{

            print '
            
            <div class="jumbotron mt-3">
                <h1 class="display-4">No Users Yet!</h1>
            </div>
            
            ';

        }

        ?>

        <div class="btn-group" style="position: relative; left: 50%; transform: translateX(-50%);">
            <a href="#" class="btn btn-sm btn-primary d-inline">view</a>
            <a href="#" class="btn btn-sm btn-primary d-inline">view</a>
        </div>

    </div>


<?php
$this->loadTemplate("api/api_footer.php");
?>
