<?php
/**
 * Created by PhpStorm.
 * User: Abnet
 * Date: 5/30/2020
 * Time: 9:33 AM
 */
?>

<h3 class="display-4">Project folder</h3>

<p>


    <strong><big>API Folder</big></strong> <br>
    The folder API is on the top of the line framework folder structure in alphabetical order.
    It consists of two php files named Starter.php and test.php.
    Starter.php contains all the inclusion of php files which are used by the API. Which can
    be user models user controllers built in classes. Test.php include starter.php and contains
    the logic which used to decompose the request from API user and send it to proxy class inside
    the SystemConstructor folder. Test.php also the page which the result data will be shown as
    json file.
    <br><br>
    <strong><big>Bootstrap</big></strong><br>
    This folder contains two folders js and css. The folder js contains all the java script files
    used by bootstrap front end framework and other two java script files build by line framework
    developers. The js folder contains _main.js.bootstrap.mini.js, home.js, jquery3.3.1.min.js and
    popper.min.js.
    The css folder contains bootstrap.min.css file which used by bootstrap frame work and main.css
    build by line developer.
    <br><br>
    <strong><big>Controller</big></strong><br>
    This folder contains nothing at first but when you develop your project all the user made
    controller class will be here. Controller cannot be created at another folder only in controller folder.
    <br><br>
    <strong><big>DatabaseBuilder</big></strong><br>
    This folder also contains nothing at first but when you develop your project all the users made
    databasebuilder classes will be here. Database builder is an entity which serve as blueprint for
    the database table. Database builder class can only be created inside this folder.
    <br><br>
    <strong><big>Images</big></strong><br>
    The users of line frameworks suggested to put all images used by the project inside this folder.
    As the name indicates all the images used by the line framework are put in here.
    <br><br>
    <strong><big>Models</big></strong><br>
    This folder contains nothing at first but when you develop your project all the user made
    controller class will be here. All models can only be created inside this folder.
    <br><br>
    <strong><big>Public</big></strong><br>
    This folder contains two files named control.php and index.php. control.php start session
    and include the controlling file which all requests for the controller goes to. Index.php starts
    session and include the templating.php file.
    <br><br>
    <strong><big>System Constructor</big></strong><br>
    This folder is the main folder in the line framework. It contains all the built in class which
    are classified in to two folders which are called App and Line.
    <br><br>
    <strong><big>App</big></strong><br>
    In this folder there are three folders called Engines, Loaders, Routing. In Engines folder there
    is two files controlling.php and templating.php. controlling.php contains the logic to receive
    requests for the controllers then include the required controller file and model and break down
    the request and pass the parameters to the controller. Templating.php contains the logic to receive
    requests for the template and include the required template and break down the request and pass
    all the parameters to the template and show the page.
    Loaders folder contains two php files and one php class which are constant_loader.php, ip_checker.
    php and Loader.php. constatnt_loader.php contains all the files inclusion which are necessary in
    order the framework to work properly. Ip_checker.php contains the logic to check IP of the user of
    the application whether the IP is trusted or not. Loader class contains all the function which will
    help the developer to load (to include) the files he wants.
    Routing contains three php files IpCheck.php, Route.php and route_map.php. IpCheck.php is php class
    consists of all function used to check client IP whether it is trusted or not. Route.php is php
    class which contains all the function used for routing purpose. Route_map.php is php file used to
    map entity with its corresponding controller.
    <br><br>
    <strong><big>Line</big></strong><br>
    This folder contains built in classes in general this folder is the back bone of the frame work.
    This folder contains 6 folders those are api, Attributes, Creation, Database, Modeling and
    QureyConstruction. Api folder contains all the classes that are used by the default built in API.
    Attributes folder contains all kinds of SQL database attributes classes. Creation folder contains
    only one php class called Creator which extends controller it controls all requests from the user
    to create models, controllers and database builders.
    Database folder contains all classes used for database connection and also contains database
    configuration file. Modeling folder contains main class of Controller, Entity, Model, and Schema.
    Query Construction folder contains all the class which are used for constructing SQL query.
    <br><br>
    <strong><big>Templates</big></strong><br>
    This folder contains all the templates. At first this folder contains one folder and one file.
    System_templates is folder contains all the system templates which are used by the framework.
    And public.php is template which will be shown as the default page of line framework.
    <br><br>
    <strong><big>Other files</big></strong><br>
    Index.php is php file which used to redirect to the developer page. Sys_description.json is json
    file which describe the project and it allows developers to set trusted IP address so that any other
    IP address will not be allowed.


</p>
