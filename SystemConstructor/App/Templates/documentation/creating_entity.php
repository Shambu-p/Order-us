<?php
/**
 * Created by PhpStorm.
 * User: Abnet
 * Date: 5/30/2020
 * Time: 10:01 AM
 */
?>

<h3 class="display-4">Creating Database Builder</h3>

<p>

    <big>
        You can create database builder manually inside the DatabaseBuilder folder. Database builder
        name should be plural noun and it should start with Capital letter. And the name should not have
        space. For spacing you can use under score. And all database builders should contain the following.
    </big>

</p>
<br><br>
<img src="../../../images/doc_img2.png" alt="">
<br><br>
<p>

    <big>

        The other way to create database builder is to use graphical user interface. As the following. <br>

        Step 1:	navigate to index.php inside your project folder using your favorite browser. For example,
        in my case my project folder is name abdi so http://localhost/abdi/ then the GUI will be shown to
        you as follows.

    </big>

</p>
<br><br>
<img src="../../../images/doc_img3.png" alt="">
<br><br>
<p>

    <big>
        Step 2:	select Create Entity from the top bar then set the name of the entity and if you want to
        create model and controller for the database builder you can select the check box or unselect the
        check box otherwise. If you select ‘also create controller’ then entity controller mapping will be
        done for you automatically.
    </big>

</p>
<br><br>
<img src="../../images/doc_img4.png" alt="">
<br><br>
<p>

    <big>
        There is another way to create database builders. It using CLI (Command Line Interface).<br>
        Step 1:	navigate to index.php inside your project folder using your favorite browser. For example,
        in my case my project folder is name abdi so http://localhost/abdi/ then the GUI will be shown to
        you as follows.
    </big>

</p>
<br><br>

<img src="../../images/doc_img5.png" alt="">

<br><br>
<p>

    <big>
        Step 2:	then select Open CLI from the top nav bar. after that write the following command.
        absoft createEntity entity_name after creating the base things automatically or manually you
        should set attributes. In line framework all attributes will extend the class Attribute and
        class Attribute has many function.
        Those are:-
    </big>

</p>
<br><br>
<img src="../../images/doc_img6.png" alt="">
<br><br>
<p>

    <big>
        Some attributes extend all properties and some will not. In line framework there are 9 attributes those are string, autoincrement, text, int, date, time, double, float, timestamp.
        <br><br>
        Strings extends all of attributes properties and implement all but sing and autoincrement properties. By default, attribute string set to nullable and length 30.<br>
        <br>
        Text extends all of the attribute properties and implement all but sing, autoincrement and set Primary key properties. By default, attribute text is set to nullable and the length is 100.<br>
        <br>
        Int extends all of the attribute properties and implement all. By default, attribute int set to nullable, signed, autoincremented and length 11.
        <br>
        <br>
        Date extends all of the attribute properties and implements all but length, autoincrement and sign. By default, attribute date set to nullable.
        <br><br>
        Time extends all of the attribute properties and implements all but length, autoincrement and sing. By default, attribute date is set to nullable.
        <br><br>
        Double extends all of the attribute properties and implement all but length, autoincrement and primary key. By default, attribute double set to nullable and signed.
        <br><br>
        Float extends all of the attribute properties and implement all but autoincrement. By default, attribute float set to nullable, signed and length 11.
        <br><br>
        Timestamp extends all of the attribute properties and implement all but autoincrement, sign and length. By default, attribute timestamp is set to nullable.
        <br><br>
        To change the name of the primary key you can set the PRIMARY_KEY attribute to whatever your attribute name is. Also, you can change the database attribute DATABASE to the database server
        you want to set in this version Microsoft SQL server and My SQL server are supported. For My SQL you can set the database attribute to ‘mysql’ for MS SQL server you can set the Database
        attribute to ‘mssql’.
    </big>

</p>
