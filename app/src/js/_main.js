
let location_address = {
    _main_address: "http://localhost:82"
}

let main_pages = {

    main_display: null,

    cli_button: null,
    create_model_button: null,
    create_controller_button: null,
    create_entity_button: null,
    database_build_button: null,

    model_creation_button: null,
    controller_creation_button: null,
    entity_creation_button: null,

    warning: null,
    error: null,
    success: null,

    cli_focus: "0",
    the_cli: null,
    executed_commands: null,

    opened_page: "",
    active_nav_button: null

};




window.onload = function(){

    main_pages.main_display = _("main_display");

    main_pages.cli_button = _("cli_button");
    main_pages.create_model_button = _("create_model_button");

    main_pages.create_controller_button = _("create_controller_button");
    main_pages.create_entity_button = _("create_entity_button");

    main_pages.model_creation_button = _("model_creation_button");
    main_pages.controller_creation_button = _("controller_creation_button");
    main_pages.entity_creation_button = _("entity_creation_button");

    main_pages.the_cli = _("the_cli");
    main_pages.executed_commands = _("executed_commands");


    openClose("create_model_page", main_pages.create_model_button);
    allModels("ui");



/////////////////////////////////////////////////////////////////////////////////////


    main_pages.cli_button.onclick = function(){

        openClose("cli_page", main_pages.cli_button);

    };

    main_pages.create_model_button.onclick = function(){

        openClose("create_model_page", main_pages.create_model_button);
        allModels("ui");

    };


    //////////////////////////////////////////////////////////////////////////////

    main_pages.create_controller_button.onclick = function(){

        openClose("create_controller_page", main_pages.create_controller_button);
        allControllers("ui");

    };

    main_pages.create_entity_button.onclick = function(){

        openClose("create_entity_page", main_pages.create_entity_button);
        allEntity("ui");

    };


    //////////////////////////////////////////////////////////////////////////////

    main_pages.the_cli.onfocus = function(){

        main_pages.cli_focus = "1";

    };

    main_pages.the_cli.onblur = function () {

        main_pages.cli_focus = "0";

    };

    ///////////////////////////////////////////////////////////////////////////////

    main_pages.model_creation_button.onclick = function(){

        creatingModel();

    };

    main_pages.controller_creation_button.onclick = function () {

        creatingController();

    };

    main_pages.entity_creation_button.onclick = function(){

        creatingEntity();

    };

};

window.onkeypress = function(event){

    let key = event.keyCode;

    if(key == "13" && main_pages.cli_focus === "1"){
        executeCommand();
    }

};

function _(id){
    return document.getElementById(id);
}

function executeCommand(){

    let command = main_pages.the_cli.value;
    main_pages.executed_commands.innerHTML += "line> "+command+"\n";
    main_pages.the_cli.value = "";

    interpretCommand(command);

}

function interpretCommand(command){

    let cmd = command.split(" ");
    let size = cmd.length;

    if(cmd[0] === "absoft"){
        if(cmd[1] === "createModel"){
            if(size > 2){
                createModel(cmd[2], "command");
            }else{
                main_pages.executed_commands.innerHTML += "line> Model name should be set after createModel \n";
            }

        }else if(cmd[1] === "createController"){
            if(size > 2){
                createController(cmd[2], "command");
            }else{
                main_pages.executed_commands.innerHTML += "line> Controller name should be set after createController \n";
            }

        }else if(cmd[1] === "createEntity"){
            if(size > 2){
                createEntity(cmd[2], "command");
            }else{
                main_pages.executed_commands.innerHTML += "line> Entity name should be set after createEntity \n";
            }

        }else if(cmd[1] === "createInitializer"){
            if(size > 2){
                createInitializer(cmd[2], "command");
            }else{
                main_pages.executed_commands.innerHTML += "line> Initializer name should be set after createInitializer \n";
            }

        }else if(cmd[1] === "buildDatabase"){
            if(size > 2){
                buildDatabase(cmd[2], "command");
            }else{
                main_pages.executed_commands.innerHTML += "line> there should be entity name to execute or all to build all table should be set after buildDatabase \n";
            }

        }
        else if(cmd[1] === "initialize"){
            if(size > 2){
                initialize(cmd[2], "command");
            }else{
                main_pages.executed_commands.innerHTML += "line> there should be Model name to initialize after initialize command\n";
            }

        }

        else if(cmd[1] === "list"){
            if(size > 2){
                if(cmd[2] === "Models" || cmd[2] === "models"){
                    allModels("command");
                }else if(cmd[2] === "Controllers" || cmd[2] === "controllers" || cmd[2] === "controller" || cmd[2] === "controllers"){
                    allControllers("command");
                }else if(cmd[2] === "Entities" || cmd[2] === "entities" || cmd[2] === "Entity" || cmd[2] === "entity"){
                    allEntity("command");
                }else{
                    main_pages.executed_commands.innerHTML += "line> there should type of object name you want to list \n say one of the following \n \tModels \n \tEntities \n \tControllers \n";
                }
            }else{
                main_pages.executed_commands.innerHTML += "line> there should type of object name you want to list \n say one of the following \n \tModels \n \tEntities \n \tControllers \n";
            }
        }
        else if(cmd[1] === "update"){

            update();

        }
        else if(cmd[1] === "clear"){
            main_pages.executed_commands.innerHTML = "line> Line framework version 1.0 command line interface 2020 \n";
        }
        else{
            main_pages.executed_commands.innerHTML += "line> unknown command '"+cmd[1]+"' \n";
        }
    }else{
        main_pages.executed_commands.innerHTML += "line> 'absoft' should be the first word in the command \n";
    }

}

function creatingModel(){

    let name_input = _("modelNameInput").value;
    let also_controller = _("m_controller");
    let also_entity = _("m_entity");
    let checks = 0;



    displayWarning("", 1);
    displayError("", 1);
    displaySuccess("", 1);

    if(also_entity.checked){
       checks += 1;
    }else{
        displayWarning("entity may not be defined yet for the model "+name_input+". if it is not defined you have to create the entity manually. <br>");
    }

    if(also_controller.checked){
        checks += 2;
    }else{
        displayWarning("controller may not be created yet for the model "+name_input+". if it is not created you may have to create the controller manually. <br>");
    }

    if(checks === 1){
        createEntity(name_input, "ui");
        createModel(name_input+"Model", "ui", "1");
        createInitializer(name_input+"Initializer", "ui");
    }else if(checks === 2){
        createModel(name_input+"Model", "ui");
        createInitializer(name_input+"Initializer", "ui");
        createController(name_input+"Controller", "ui");
    }else if(checks === 3){
        createEntity(name_input, "ui");
        createModel(name_input+"Model", "ui", "1");
        createInitializer(name_input+"Initializer", "ui");
        createController(name_input+"Controller", "ui");
        setTimeout(mapping(name_input, name_input+"Controller", "ui"), 1000);
    }else{
        createModel(name_input+"Model", "ui");
    }

}

function creatingController(){

    let name_input = _("controllerNameInput").value;
    let also_model = _("c_model");
    let checks = 0;

    displayWarning("", 1);
    displayError("", 1);
    displaySuccess("", 1);

    if(also_model.checked){
        checks = 1;
    }else{
        displayWarning("model may not be created yet for the controller "+name_input+". if it is not created you may have to create the model manually. <br>");
    }

    if(checks === 1){
        createModel(name_input+"Model", "ui");
        createController(name_input+"Controller", "ui");
    }else{
        createController(name_input+"Controller", "ui");
    }

}

function creatingEntity(){

    let name_input = _("entityNameInput").value;
    let also_controller = _("e_controller");
    let also_model = _("e_model");
    let checks = 0;

    displayWarning("", 1);
    displayError("", 1);
    displaySuccess("", 1);

    if(also_model.checked){
        checks += 1;
    }else{
        displayWarning("model may not be defined yet for the entity "+name_input+". if it is not defined you have to create the entity manually. <br>");
    }

    if(also_controller.checked){
        checks += 2;
    }else{
        displayWarning("controller may not be created yet for the model "+name_input+". if it is not created you may have to create the controller manually. <br>");
    }

    if(checks === 1){
        createEntity(name_input, "ui");
        createModel(name_input+"Model", "ui", "1");
    }else if(checks === 2){
        createEntity(name_input, "ui");
        createController(name_input+"Controller", "ui");
        setTimeout(mapping(name_input, name_input+"Controller", "ui"), 1000);
    }else if(checks === 3){
        createEntity(name_input, "ui");
        createModel(name_input+"Model", "ui", "1");
        createController(name_input+"Controller", "ui");
        setTimeout(mapping(name_input, name_input+"Controller", "ui"), 1000);
    }else{
        createEntity(name_input, "ui");
    }

}

function createInitializer(model_name, place) {

    alert("initializer creator called");

    let index = model_name.indexOf("Initializer");
    let address = "";

    try{

        if(index > 0 && model_name.substr(index) === "Initializer"){

            let str = model_name.slice(0,1).toUpperCase() + model_name.substr(1);

            address = location_address._main_address +"/system_call/create_init/"+str;

            let method = "POST";
            let ajax = new XMLHttpRequest();

            ajax.open(method, address, true);
            ajax.send();
            ajax.onreadystatechange = function(){

                if(this.readyState === 4 && this.status === 200){
                    let response = JSON.parse(this.responseText);
                    if(place === "command"){

                        if(response.status === "1"){
                            main_pages.executed_commands.innerHTML += "line> "+ response.success_message+"\n";
                        }else{
                            main_pages.executed_commands.innerHTML += "line> "+response.error_message+"\n";
                        }

                    }else{

                        if(response.status === "1"){
                            displaySuccess(response.success_message+"<br>");
                        }else{
                            displayError(response.error_message+"<br>");
                        }

                    }
                }

            };

        }else{
            if(place === "command"){
                main_pages.executed_commands.innerHTML += "line> Initializer name should contain 'Initializer' at last \n";
            }else{
                displayError("Initializer name should contain 'Initializer' at last <br>");
            }
        }

    }catch (ex) {
        displayError(ex.message);
    }

}

function createModel(model_name, place, table_name = "") {

    let index = model_name.indexOf("Model");
    let address = "";

    try{

        if(index > 0 && model_name.substr(index) === "Model"){

            let str = model_name.slice(0,1).toUpperCase() + model_name.substr(1);

            if(table_name !== "" && table_name === "1"){
                address = location_address._main_address + "/system_call/model/"+str+"/"+str.slice(0,index);
            }else{
                address = location_address._main_address + "/system_call/model/"+str;
            }

            let method = "POST";
            let ajax = new XMLHttpRequest();

            ajax.open(method, address, true);
            ajax.send();
            ajax.onreadystatechange = function(){

                if(this.readyState === 4 && this.status === 200){
                    let response = JSON.parse(this.responseText);
                    if(place === "command"){

                        if(response.status === "1"){
                            main_pages.executed_commands.innerHTML += "line> "+ response.success_message+"\n";
                        }else{
                            main_pages.executed_commands.innerHTML += "line> "+response.error_message+"\n";
                        }

                    }else{

                        if(response.status === "1"){
                            displaySuccess(response.success_message+"<br>");
                        }else{
                            displayError(response.error_message+"<br>");

                        }

                    }
                }

            };

        }else{
            if(place === "command"){
                main_pages.executed_commands.innerHTML += "line> Model name should contain 'Model' at last \n";
            }else{
                displayError("Model name should contain 'Model' at last <br>");
            }
        }

    }catch (ex) {
        displayError(ex.message);
    }

}

function createController(controller_name, place){

    let index = controller_name.indexOf("Controller");

    try{

        if(index > 0 && controller_name.substr(index) === "Controller"){

            let str = controller_name.slice(0,1).toUpperCase() + controller_name.substr(1);

            let method = "POST";
            let address = location_address._main_address + "/system_call/controller/"+str;
            let ajax = new XMLHttpRequest();
            //let data = new FormData();
            //data.add("controller_name", str);

            ajax.open(method, address, true);
            ajax.send();
            ajax.onreadystatechange = function(){

                if(this.readyState === 4 && this.status === 200){

                    let response = JSON.parse(this.responseText);
                    if(place === "command"){

                        if(response.status === "1"){
                            main_pages.executed_commands.innerHTML += "line> "+ response.success_message+"\n";
                        }else{
                            main_pages.executed_commands.innerHTML += "line> "+response.error_message+"\n";
                        }

                    }else{

                        if(response.status === "1"){
                            displaySuccess(response.success_message+"<br>");
                        }else{
                            displayError(response.error_message+"<br>");
                        }

                    }

                }

            };

        }else{

            if(place === "command"){
                main_pages.executed_commands.innerHTML += "line> controller name should contain 'Controller' at last \n";
            }else{
                displayError("controller name should contain 'Controller' at last <br>");
            }

        }

    }catch (ex) {
        displayError(ex.message);
    }

}

function createEntity(entity_name, place){

    try{

        if(entity_name.length > 3){

            let str = entity_name.slice(0,1).toUpperCase() + entity_name.substr(1);

            let method = "POST";
            let address = location_address._main_address + "/system_call/entity/"+str;
            let ajax = new XMLHttpRequest();

            ajax.open(method, address, true);
            ajax.send();
            ajax.onreadystatechange = function(){

                if(this.readyState === 4 && this.status === 200){
                    let response = JSON.parse(this.responseText);
                    if(place === "command"){

                        if(response.status === "1"){
                            main_pages.executed_commands.innerHTML += "line> "+ response.success_message+"\n";
                        }else{
                            main_pages.executed_commands.innerHTML += "line> "+response.error_message+"\n";
                        }

                    }else{

                        if(response.status === "1"){
                            displaySuccess(response.success_message+"<br>");
                        }else{
                            displayError(response.error_message+"<br>");
                        }

                    }
                }

            };

        }else{
            if(place === "command"){
                main_pages.executed_commands.innerHTML += "line> The entity name should be greater than 3 characters \n";
            }else{
                displayError("The entity name should be greater than 3 characters <br>");
            }
        }

    }catch (ex) {
        displayError(ex.message);
    }

}

function initialize(model, place){

    try{

        if(model.length > 7 && model.indexOf("Model") > 2){

            let method = "POST";
            let address = "";

            let str = model.slice(0,1).toUpperCase() + model.substr(1);
            address = location_address._main_address + "/system_call/initialize/"+str;

            let ajax = new XMLHttpRequest();

            ajax.open(method, address, true);
            ajax.send();
            ajax.onreadystatechange = function(){

                if(this.readyState === 4 && this.status === 200){

                    let response = JSON.parse(this.responseText);

                    if(place === "command"){

                        if(response.status === "1"){
                            main_pages.executed_commands.innerHTML += "line> " + response.success_message +"\n";
                        }else{
                            main_pages.executed_commands.innerHTML += "line> "+response.error_message +"\n";
                        }

                    }else{

                        if(response.status === "1"){
                            displaySuccess(response.success_message+"<br>");
                        }else{
                            displayError(response.error_message+"<br>");
                        }

                    }

                }

            };

        }else{
            if(place === "command"){
                main_pages.executed_commands.innerHTML += "line> The entity name should be greater than 3 characters \n";
            }else{
                displayError("The entity name should be greater than 3 characters <br>");
            }
        }

    }catch (ex) {
        displayError(ex.message);
    }

}

function buildDatabase(entity_name, place){

    try{

        if(entity_name.length >= 3 || entity_name === "all"){

            let method = "POST";
            let address = "";

            if(entity_name === "all"){

                address = location_address._main_address + "/system_call/build_all_table";
            }else{
                let str = entity_name.slice(0,1).toUpperCase() + entity_name.substr(1);
                address = location_address._main_address + "/system_call/build_table/"+str;
            }

            let ajax = new XMLHttpRequest();

            ajax.open(method, address, true);
            ajax.send();
            ajax.onreadystatechange = function(){

                if(this.readyState === 4 && this.status === 200){

                    let response = JSON.parse(this.responseText);

                    if(place === "command"){

                        if(entity_name === "all"){

                            //main_pages.executed_commands.innerHTML += ;

                            main_pages.executed_commands.innerHTML += "\t \t executing Entities \n";

                            for(let i = 0; i < (response.messages).length; i++){

                                main_pages.executed_commands.innerHTML += "line> \t" + response.messages[i]+"\n";

                            }

                        }
                        else{

                            if(response.status === "1"){
                                main_pages.executed_commands.innerHTML += "line> " + response.success_message +"\n";
                            }else{
                                main_pages.executed_commands.innerHTML += "line> "+response.error_message +"\n";
                            }

                        }

                    }else{

                        if(response.status === "1"){
                            displaySuccess(response.success_message+"<br>");
                        }else{
                            displayError(response.error_message+"<br>");
                        }

                    }

                }

            };

        }else{
            if(place === "command"){
                main_pages.executed_commands.innerHTML += "line> The entity name should be greater than 3 characters \n";
            }else{
                displayError("The entity name should be greater than 3 characters <br>");
            }
        }

    }catch (ex) {
        displayError(ex.message);
    }

}

function mapping(entity_name, controller_name, place){

    let model_str = entity_name.slice(0,1).toUpperCase() + entity_name.substr(1);
    let control_str = controller_name.slice(0,1).toUpperCase() + controller_name.substr(1);

    let method = "POST";
    let address = location_address._main_address + "/system_call/mapping/"+model_str+"/"+control_str;
    let ajax = new XMLHttpRequest();

    ajax.open(method, address, true);
    ajax.send();
    ajax.onreadystatechange = function(){

        if(this.readyState === 4 && this.status === 200){

            let response = JSON.parse(this.responseText);

            if(place === "command"){

                if(response.status === "1"){
                    main_pages.executed_commands.innerHTML += "line> "+ response.success_message+"\n";
                }else{
                    main_pages.executed_commands.innerHTML += "line> "+response.error_message+"\n";
                }

            }else{

                if(response.status === "1"){
                    displaySuccess(response.success_message+"<br>");
                }else{
                    displayError(response.error_message+"<br>");
                }

            }

        }

    };

}

function openClose(id, button){

    if(id !== main_pages.opened_page){

        _(id).style.display = "";
        button.classList.add("active");

        if(main_pages.opened_page !== "" && main_pages.active_nav_button !== null){

            _(main_pages.opened_page).style.display = "none";
            main_pages.active_nav_button.classList.remove("active");

        }

        main_pages.opened_page = id;
        main_pages.active_nav_button = button;

    }

}

function allModels(place){

    let model_display = _("all_model_display");
    let method = "POST";
    let address = location_address._main_address + "/system_call/all_model";
    let ajax = new XMLHttpRequest();

    ajax.open(method, address, true);
    ajax.send();
    ajax.onreadystatechange = function(){

        if(this.readyState === 4 && this.status === 200){
            let response = JSON.parse(this.responseText);
            if(place === "command"){

                if(response.status === "1"){

                    main_pages.executed_commands.innerHTML += "line> \t all models \n";
                    for(let i = 0; i < (response.models).length; i++){

                        main_pages.executed_commands.innerHTML += "\t " + response.models[i] + "\n";

                    }

                }else{
                    main_pages.executed_commands.innerHTML += "line> "+response.error_message+"\n";
                }

            }else{

                model_display.innerHTML = "";

                if(response.status === "1"){

                    for(let i = 0; i < (response.models).length; i++){

                        model_display.innerHTML += '<li class="list-group-item bg-light">'+response.models[i]+'</li>';

                    }

                }else{

                    model_display.innerHTML += response.error_message + "<br>";

                }

            }
        }

    };

}

function checkModel(model_name){

}

function allControllers(place){

    let display_element = _("all_controller_display");
    let method = "POST";
    let address = location_address._main_address + "/system_call/all_controller";
    let ajax = new XMLHttpRequest();

    ajax.open(method, address, true);
    ajax.send();
    ajax.onreadystatechange = function(){

        if(this.readyState === 4 && this.status === 200){
            let response = JSON.parse(this.responseText);
            if(place === "command"){

                if(response.status === "1"){

                    main_pages.executed_commands.innerHTML += "line> \t all Controllers \n";
                    for(let i = 0; i < (response.controllers).length; i++){

                        main_pages.executed_commands.innerHTML += "\t " + response.controllers[i] + "\n";

                    }

                }else{
                    main_pages.executed_commands.innerHTML += "line> "+response.error_message+"\n";
                }

            }else{

                display_element.innerHTML = "";

                if(response.status === "1"){

                    for(let i = 0; i < (response.controllers).length; i++){

                        display_element.innerHTML += '<li class="list-group-item bg-light">'+response.controllers[i]+'</li>';

                    }

                }else{

                    display_element.innerHTML += response.error_message + "<br>";

                }

            }
        }

    };

}

function checkController(controller_name){

}

function allEntity(place){

    let display_element = _("all_entity_display");
    let method = "POST";
    let address = location_address._main_address + "/system_call/all_entity";
    let ajax = new XMLHttpRequest();

    ajax.open(method, address, true);
    ajax.send();
    ajax.onreadystatechange = function(){

        if(this.readyState === 4 && this.status === 200){
            let response = JSON.parse(this.responseText);
            if(place === "command"){

                if(response.status === "1"){

                    main_pages.executed_commands.innerHTML += "line> \t all entities \n";
                    for(let i = 0; i < (response.entitys).length; i++){

                        main_pages.executed_commands.innerHTML += "\t " + response.entitys[i] + "\n";

                    }

                }else{
                    main_pages.executed_commands.innerHTML += "line> "+response.error_message+"\n";
                }

            }else{

                display_element.innerHTML = "";

                if(response.status === "1"){

                    for(let i = 0; i < (response.entitys).length; i++){

                        display_element.innerHTML += '<li class="list-group-item bg-light">'+response.entitys[i]+'</li>';

                    }

                }else{

                    display_element.innerHTML += response.error_message + "<br>";

                }

            }
        }

    };

}

function checkEntity(entity_name){

}

function displaySuccess(message, refresh = "") {

    let object = _("success");

    if(refresh !== ""){
        object.innerHTML = "";
    }else{

        if(main_pages.success !== null){
            clearTimeout(main_pages.success);
        }

        object.innerHTML += message;
        object.style.display = "";

        main_pages.success = setTimeout(function(){
            object.style.display = "none";
        }, 3000);
    }

}

function displayWarning(message, refresh = "") {

    let object = _("warning");

    if(refresh !== ""){
        object.innerHTML = "";
    }else{

        if(main_pages.warning !== null){
            clearTimeout(main_pages.warning);
        }

        object.innerHTML += message;
        object.style.display = "";

        main_pages.warning = setTimeout(function(){
            object.style.display = "none";
        }, 3000);
    }

}

function displayError(message, refresh = "") {

    let object = _("error");

    if(refresh !== ""){
        object.innerHTML = "";
    }else{

        if(main_pages.error !== null){
            clearTimeout(main_pages.error);
        }

        object.innerHTML += message;
        object.style.display = "";

        main_pages.error = setTimeout(function(){
            object.style.display = "none";
        }, 3000);

    }

}

function update(){

    try{

        let method = "POST";
        let address = "";

        address = location_address._main_address + "/system_call/update";

        let ajax = new XMLHttpRequest();

        ajax.open(method, address, true);
        ajax.send();
        ajax.onreadystatechange = function(){

            if(this.readyState === 4 && this.status === 200){

                let response = this.responseText;

                main_pages.executed_commands.innerHTML += "\t \t Updating Framework please don't interrupt or reload the page, the system might crash.\n";

                main_pages.executed_commands.innerHTML += response + "\n";

            }

        };

    }catch (ex) {
        displayError(ex.message);
    }

}

//https://www.youtube.com/watch?v=MpXQTD54X64 time=50
