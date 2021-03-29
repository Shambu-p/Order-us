<?php
/**
 * Created by PhpStorm.
 * User: Abnet
 * Date: 11/18/2020
 * Time: 9:06 PM
 */

$this->loadTemplate("admin/admin_header.php");


if(isset($this->request->entity)){

    print '

    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">'.strtoupper($this->request->entity->TABLE_NAME).'</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
            <div class="btn-group mr-2">
                <button class="btn btn-sm btn-outline-secondary">Export</button>
            </div>
            <a href="'.$this->route_address("Admin.new_attribute", ["table" => $this->request->entity->TABLE_NAME]).'" class="btn btn-sm btn-outline-secondary">
                New Attribute
            </a>
        </div>
    </div>
    
    ';

}



\Absoft\App\Pager\Alert::displayAlert();

?>

    <div class="container">

        <ul class="list-group list-group-flush">

            <?php

            if(isset($this->request->entity)){

                $data = $this->request->entity;

                foreach ($data->ATTRIBUTES as $index => $attribute){

                    print '
                    
                    <li class="list-group-item bg-dark text-white">'.$attribute->name.'</li>
                    <li class="list-group-item">
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item">
        
                                <div class="row">
                                    <div class="col">
                                        <h5 class="mr-3 d-inline">Name: '.$attribute->name.'</h5>
                                    </div>
                                    <div class="col">
        
                                        <form action="'.$this->route_address("Admin.edit", ["change" => "name", "on" => "mains", "index" => $index, "table" => $data->TABLE_NAME]).'" class="form-inline d-inline" method="post">
        
                                            <input type="text" class="form-control form-control-sm d-inline" style="width: 18rem;" name="value" placeholder="Enter the value">
        
                                            <button class="btn btn-dark btn-sm ml-2">Change</button>
        
                                        </form>
        
                                    </div>
                                </div>
        
                            </li>
                            <li class="list-group-item">
        
                                <div class="row">
                                    <div class="col">
                                        <h5 class="mr-3 d-inline">Length: '.$attribute->length.'</h5>
                                    </div>
                                    <div class="col">
        
                                        <form action="'.$this->route_address("Admin.edit", ["change" => "length", "on" => "mains", "index" => $index, "table" => $data->TABLE_NAME]).'" class="form-inline d-inline" method="post">
        
                                            <input type="number" min="0" class="form-control form-control-sm d-inline" style="width: 18rem;" name="value" placeholder="Enter the value">
        
                                            <button class="btn btn-dark btn-sm ml-2">Change</button>
        
                                        </form>
        
                                    </div>
                                </div>
        
        
                            </li>
                            <li class="list-group-item">
        
                                <div class="row">
                                    <div class="col">
                                        <h5 class="mr-3 d-inline">Type: '.$attribute->type.'</h5>
                                    </div>
                                    <div class="col">
                                        <form action="'.$this->route_address("Admin.edit", ["change" => "type", "on" => "mains", "index" => $index, "table" => $data->TABLE_NAME]).'" class="form-inline d-inline" method="post">
        
                                            <select class="form-control form-control-sm d-inline" style="width: 18rem;" name="value" >
                                                
                                                <option value="string">Varchar</option>
                                                <option value="text">Text</option>
                                                <option value="int">Integer</option>
                                                <option value="autoIncrement">Auto Increment</option>
                                                <option value="time">Time</option>
                                                <option value="date">Date</option>
                                                <option value="double">Double</option>
                                                <option value="float">Float</option>
                                                <option value="timestamp">Time Stamp</option>
                                                <option value="hidden">Hidden</option>
                                                
                                            </select>
        
                                            <button class="btn btn-dark btn-sm ml-2">Change</button>
        
                                        </form>
                                    </div>
                                </div>
        
                            </li>
                            <li class="list-group-item">
        
                                <div class="row">
                                    <div class="col">
                                        <h5 class="mr-3 d-inline">Nullable: ';
                    if($attribute->nullable){

                        print 'true';

                    }else{
                        print "false";
                    }

                    print '</h5>
                                    </div>
                                    <div class="col">
                                        <form action="'.$this->route_address("Admin.edit", ["change" => "nullable", "on" => "mains", "index" => $index, "table" => $data->TABLE_NAME]).'" class="form-inline d-inline" method="post">
        
                                            <select class="form-control form-control-sm d-inline" style="width: 18rem;" name="value" >
                                                
                                                <option value="true">True</option>
                                                <option value="false">False</option>
                                                
                                            </select>
        
                                            <button class="btn btn-dark btn-sm ml-2">Change</button>
        
                                        </form>
                                    </div>
                                </div>
        
                            </li>
                            <li class="list-group-item">
        
                                <div class="row">
                                    <div class="col">
                                        <h5 class="mr-3 d-inline">References to: '.$attribute->foreign.'</h5>
                                    </div>
                                    <div class="col">
                                        <form action="'.$this->route_address("Admin.edit", ["change" => "References", "on" => "mains", "index" => $index, "table" => $data->TABLE_NAME]).'" class="form-inline d-inline" method="post">
        
                                            <input type="text" class="form-control form-control-sm d-inline" style="width: 18rem;" name="value" placeholder="Enter Table Name">
        
                                            <button class="btn btn-dark btn-sm ml-2">Change</button>
        
                                        </form>
                                    </div>
                                </div>
        
                            </li>
                            <li class="list-group-item">
        
                                <div class="row">
                                    <div class="col">
                                        <h5 class="mr-3 d-inline">Reference on: '.$attribute->reference.'</h5>
                                    </div>
                                    <div class="col">
                                        <form action="'.$this->route_address("Admin.edit", ["change" => "on", "on" => "mains", "index" => $index, "table" => $data->TABLE_NAME]).'" class="form-inline d-inline" method="post">
        
                                            <input type="text" class="form-control form-control-sm d-inline" style="width: 18rem;" name="value" placeholder="Enter the value">
        
                                            <button class="btn btn-dark btn-sm ml-2">Change</button>
        
                                        </form>
                                    </div>
                                </div>
        
                            </li>
                            <li class="list-group-item">
        
                                <div class="row">
                                    <div class="col">
                                        <h5 class="mr-3 d-inline">Sign: ';
                    if($attribute->sign){

                        print 'true';

                    }else{
                        print "false";
                    }

                    print '</h5>
                                    </div>
                                    <div class="col">
                                        <form action="'.$this->route_address("Admin.edit", ["change" => "sign", "on" => "mains", "index" => $index, "table" => $data->TABLE_NAME]).'" class="form-inline d-inline" method="post">
        
                                            <select class="form-control form-control-sm d-inline" style="width: 18rem;" name="value" >
                                                
                                                <option value="true">True</option>
                                                <option value="false">False</option>
                                                
                                            </select>
        
                                            <button class="btn btn-dark btn-sm ml-2">Change</button>
        
                                        </form>
                                    </div>
                                </div>
        
                            </li>
                            <li class="list-group-item">
        
                                <div class="row">
                                    <div class="col">
                                        <h5 class="mr-3 d-inline">Unique: ';
                    if($attribute->unique){

                        print 'true';

                    }else{
                        print "false";
                    }

                    print '</h5>
                                    </div>
                                    <div class="col">
                                        <form action="'.$this->route_address("Admin.edit", ["change" => "unique", "on" => "mains", "index" => $index, "table" => $data->TABLE_NAME]).'" class="form-inline d-inline" method="post">
        
                                            <select class="form-control form-control-sm d-inline" style="width: 18rem;" name="value" >
                                                
                                                <option value="true">True</option>
                                                <option value="false">False</option>
                                                
                                            </select>
        
                                            <button class="btn btn-dark btn-sm ml-2">Change</button>
        
                                        </form>
                                    </div>
                                </div>
        
                            </li>
                            <li class="list-group-item">
        
                                <div class="row">
                                    <div class="col">
                                        <h5 class="mr-3 d-inline">Key: '.$attribute->key.'</h5>
                                    </div>
                                    <div class="col">
                                        <form action="'.$this->route_address("Admin.edit", ["change" => "setPrimaryKey", "on" => "mains", "index" => $index, "table" => $data->TABLE_NAME]).'" class="form-inline d-inline" method="post">
        
                                            <select class="form-control form-control-sm d-inline" style="width: 18rem;" name="value" >
                                                
                                                <option value="">Unset</option>
                                                <option value="primary">Primary Key</option>
                                                
                                            </select>
        
                                            <button class="btn btn-dark btn-sm ml-2">Change</button>
        
                                        </form>
                                    </div>
                                </div>
        
                            </li>
                        </ul>
                    </li>
                    
                    ';

                }

                print '<li class="list-group-item active">HIDDEN ATTRIBUTES</li>';

                foreach ($data->HIDDEN_ATTRIBUTES as $index => $attribute){

                    print '
                    
                    <li class="list-group-item bg-dark text-white">'.$attribute->name.'</li>
                    <li class="list-group-item">
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item">
        
                                <div class="row">
                                    <div class="col">
                                        <h5 class="mr-3 d-inline">Name: '.$attribute->name.'</h5>
                                    </div>
                                    <div class="col">
        
                                        <form action="'.$this->route_address("Admin.edit", ["change" => "name", "on" => "hidden", "index" => $index, "table" => $data->TABLE_NAME]).'" class="form-inline d-inline" method="post">
        
                                            <input type="text" class="form-control form-control-sm d-inline" style="width: 18rem;" name="value" placeholder="Enter the value">
        
                                            <button class="btn btn-dark btn-sm ml-2">Change</button>
        
                                        </form>
        
                                    </div>
                                </div>
        
                            </li>
                            <li class="list-group-item">
        
                                <div class="row">
                                    <div class="col">
                                        <h5 class="mr-3 d-inline">Length: '.$attribute->length.'</h5>
                                    </div>
                                    <div class="col">
        
                                        <form action="'.$this->route_address("Admin.edit", ["change" => "length", "on" => "hidden", "index" => $index, "table" => $data->TABLE_NAME]).'" class="form-inline d-inline" method="post">
        
                                            <input type="number" min="0" class="form-control form-control-sm d-inline" style="width: 18rem;" name="value" placeholder="Enter the value">
        
                                            <button class="btn btn-dark btn-sm ml-2">Change</button>
        
                                        </form>
        
                                    </div>
                                </div>
        
        
                            </li>
                            <li class="list-group-item">
        
                                <div class="row">
                                    <div class="col">
                                        <h5 class="mr-3 d-inline">Type: '.$attribute->type.'</h5>
                                    </div>
                                    <div class="col">
                                        <form action="'.$this->route_address("Admin.edit", ["change" => "type", "on" => "hidden", "index" => $index, "table" => $data->TABLE_NAME]).'" class="form-inline d-inline" method="post">
        
                                            <select class="form-control form-control-sm d-inline" style="width: 18rem;" name="value" >
                                                
                                                <option value="string">Varchar</option>
                                                <option value="text">Text</option>
                                                <option value="int">Integer</option>
                                                <option value="autoIncrement">Auto Increment</option>
                                                <option value="time">Time</option>
                                                <option value="date">Date</option>
                                                <option value="double">Double</option>
                                                <option value="float">Float</option>
                                                <option value="timestamp">Time Stamp</option>
                                                <option value="hidden">Hidden</option>
                                                
                                            </select>
        
                                            <button class="btn btn-dark btn-sm ml-2">Change</button>
        
                                        </form>
                                    </div>
                                </div>
        
                            </li>
                            <li class="list-group-item">
        
                                <div class="row">
                                    <div class="col">
                                        <h5 class="mr-3 d-inline">Nullable: ';
                    if($attribute->nullable){

                        print 'true';

                    }else{
                        print "false";
                    }

                    print '</h5>
                                    </div>
                                    <div class="col">
                                        <form action="'.$this->route_address("Admin.edit", ["change" => "nullable", "on" => "hidden", "index" => $index, "table" => $data->TABLE_NAME]).'" class="form-inline d-inline" method="post">
        
                                            <select class="form-control form-control-sm d-inline" style="width: 18rem;" name="value" >
                                                
                                                <option value="true">True</option>
                                                <option value="false">False</option>
                                                
                                            </select>
        
                                            <button class="btn btn-dark btn-sm ml-2">Change</button>
        
                                        </form>
                                    </div>
                                </div>
        
                            </li>
                            <li class="list-group-item">
        
                                <div class="row">
                                    <div class="col">
                                        <h5 class="mr-3 d-inline">Reference to: '.$attribute->foreign.'</h5>
                                    </div>
                                    <div class="col">
                                        <form action="'.$this->route_address("Admin.edit", ["change" => "References", "on" => "hidden", "index" => $index, "table" => $data->TABLE_NAME]).'" class="form-inline d-inline" method="post">
        
                                            <input type="text" class="form-control form-control-sm d-inline" style="width: 18rem;" name="value" placeholder="Enter Table Name">
        
                                            <button class="btn btn-dark btn-sm ml-2">Change</button>
        
                                        </form>
                                    </div>
                                </div>
        
                            </li>
                            <li class="list-group-item">
        
                                <div class="row">
                                    <div class="col">
                                        <h5 class="mr-3 d-inline">Reference on: '.$attribute->reference.'</h5>
                                    </div>
                                    <div class="col">
                                        <form action="'.$this->route_address("Admin.edit", ["change" => "on", "on" => "hidden", "index" => $index, "table" => $data->TABLE_NAME]).'" class="form-inline d-inline" method="post">
        
                                            <input type="text" class="form-control form-control-sm d-inline" style="width: 18rem;" name="value" placeholder="Enter the value">
        
                                            <button class="btn btn-dark btn-sm ml-2">Change</button>
        
                                        </form>
                                    </div>
                                </div>
        
                            </li>
                            <li class="list-group-item">
        
                                <div class="row">
                                    <div class="col">
                                        <h5 class="mr-3 d-inline">Sign: ';
                    if($attribute->nullable){

                        print 'true';

                    }else{
                        print "false";
                    }

                    print '</h5>
                                    </div>
                                    <div class="col">
                                        <form action="'.$this->route_address("Admin.edit", ["change" => "sign", "on" => "hidden", "index" => $index, "table" => $data->TABLE_NAME]).'" class="form-inline d-inline" method="post">
        
                                            <select class="form-control form-control-sm d-inline" style="width: 18rem;" name="value" >
                                                
                                                <option value="true">True</option>
                                                <option value="false">False</option>
                                                
                                            </select>
        
                                            <button class="btn btn-dark btn-sm ml-2">Change</button>
        
                                        </form>
                                    </div>
                                </div>
        
                            </li>
                            <li class="list-group-item">
        
                                <div class="row">
                                    <div class="col">
                                        <h5 class="mr-3 d-inline">Unique: ';
                    if($attribute->nullable){

                        print 'true';

                    }else{
                        print "false";
                    }

                    print '</h5>
                                    </div>
                                    <div class="col">
                                        <form action="'.$this->route_address("Admin.edit", ["change" => "unique", "on" => "hidden", "index" => $index, "table" => $data->TABLE_NAME]).'" class="form-inline d-inline" method="post">
        
                                            <select class="form-control form-control-sm d-inline" style="width: 18rem;" name="value" >
                                                
                                                <option value="true">True</option>
                                                <option value="false">False</option>
                                                
                                            </select>
        
                                            <button class="btn btn-dark btn-sm ml-2">Change</button>
        
                                        </form>
                                    </div>
                                </div>
        
                            </li>
                            <li class="list-group-item">
        
                                <div class="row">
                                    <div class="col">
                                        <h5 class="mr-3 d-inline">Key: '.$attribute->key.'</h5>
                                    </div>
                                    <div class="col">
                                        <form action="'.$this->route_address("Admin.edit", ["change" => "setPrimaryKey", "on" => "hidden", "index" => $index, "table" => $data->TABLE_NAME]).'" class="form-inline d-inline" method="post">
        
                                            <select class="form-control form-control-sm d-inline" style="width: 18rem;" name="value" >
                                                
                                                <option value="">Unset</option>
                                                <option value="primary">Primary Key</option>
                                                
                                            </select>
        
                                            <button class="btn btn-dark btn-sm ml-2">Change</button>
        
                                        </form>
                                    </div>
                                </div>
        
                            </li>
                        </ul>
                    </li>
                    
                    ';

                }

            }

            ?>

        </ul>

    </div>


<?php
$this->loadTemplate("admin/admin_footer.php");
?>
