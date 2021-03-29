


var loaded = {
    designers: null,
    order: null,
    preferences: null,
    design: null,
    previews: []
};

window.onload = function(){

    $("#order_approval").hide();
    $("#assign_designer").hide();
    $("#set_to_finished").hide();
    $("#set_to_preview").hide();
    $("#receive_order").hide();

    if(constants.user !== "designer"){

        $("#designer_add_preview").hide();

    }
    if(constants.user !== "customer"){

        $("#exit_order").hide();

    }

    orderLoader();

};

function preferenceLoader() {

    let war = new XMLHttpRequest();
    war.open("POST", constants.preference_address, true);

    let data = new FormData();
    data.append("order", constants.order_id);
    war.send(data);

    war.onreadystatechange = function() {

        if (this.readyState === 4 && this.status === 200) {

            loaded.preferences= JSON.parse(this.responseText);

            setTimeout(preferenceShow, 100);

        }

    };

}

function orderLoader() {

    let object = '<div class="row">' +
        '    <div class="col pr-1">' +
        '        <div class="bg-white shadow p-2 mb-2">' +
        '            <h5 class="text-right"></h5>' +
        '        </div>' +
        '    </div>' +
        '    <div class="col pl-1">' +
        '        <div class="bg-white shadow p-2 mb-2">' +
        '        </div>' +
        '    </div>' +
        '</div>';

    let war = new XMLHttpRequest();
    war.open("POST", constants.order_address, true);

    let data = new FormData();
    data.append("order", constants.order_id);
    war.send(data);

    war.onreadystatechange = function(){

        if (this.readyState === 4 && this.status === 200) {

            loaded.order = JSON.parse(this.responseText);
            //_("order_place").innerHTML = this.responseText;
            setTimeout(orderShower(), 100);
            setTimeout(preferenceLoader(), 100);
            setTimeout(imageLoader("suggested_images/"+loaded.order.suggested_image, "suggested_image"), 100);
            setTimeout(visualization(), 10);
            if(loaded.order.status === "designing" || loaded.order.status === "preview"){
                setTimeout(loadPreviews(), 10);
            }
            setTimeout(loadDesign(), 10);

        }

    };

}

function orderShower(){

    let target = _("order_place");

    _("order_status").innerHTML = loaded.order.status;

    target.innerHTML += '<div class="row">' +
        '    <div class="col pr-1">' +
        '        <div class="bg-white shadow p-2 mb-2">' +
        '            <h5 class="text-right">Order Id</h5>' +
        '        </div>' +
        '    </div>' +
        '    <div class="col pl-1">' +
        '        <div class="bg-white shadow p-2 mb-2"><h5 class="text-left">'+loaded.order.id+'</div> </h5>' +
        '    </div>' +
        '</div>';

    target.innerHTML += '<div class="row">' +
        '    <div class="col pr-1">' +
        '        <div class="bg-white shadow p-2 mb-2">' +
        '            <h5 class="text-right">Full Name</h5>' +
        '        </div>' +
        '    </div>' +
        '    <div class="col pl-1">' +
        '        <div class="bg-white shadow p-2 mb-2">' +
        '           <h5 class="text-left">'+loaded.order.full_name+'</h5>' +
        '        </div>' +
        '    </div>' +
        '</div>';

    target.innerHTML += '<div class="row">' +
        '    <div class="col pr-1">' +
        '        <div class="bg-white shadow p-2 mb-2">' +
        '            <h5 class="text-right">Email</h5>' +
        '        </div>' +
        '    </div>' +
        '    <div class="col pl-1">' +
        '        <div class="bg-white shadow p-2 mb-2">' +
        '           <h5 class="text-left">'+loaded.order.email+'</h5>' +
        '        </div>' +
        '    </div>' +
        '</div>';

    target.innerHTML += '<div class="row">' +
        '    <div class="col pr-1">' +
        '        <div class="bg-white shadow p-2 mb-2">' +
        '            <h5 class="text-right">Phone Number</h5>' +
        '        </div>' +
        '    </div>' +
        '    <div class="col pl-1">' +
        '        <div class="bg-white shadow p-2 mb-2">' +
        '           <h5 class="text-left">'+loaded.order.phone_number+'</h5>' +
        '        </div>' +
        '    </div>' +
        '</div>';

    target.innerHTML += '<div class="row">' +
        '    <div class="col pr-1">' +
        '        <div class="bg-white shadow p-2 mb-2">' +
        '            <h5 class="text-right">Order Date</h5>' +
        '        </div>' +
        '    </div>' +
        '    <div class="col pl-1">' +
        '        <div class="bg-white shadow p-2 mb-2">' +
        '           <h5 class="text-left">'+loaded.order.order_date+'</h5>' +
        '        </div>' +
        '    </div>' +
        '</div>';

    target.innerHTML += '<div class="row">' +
        '    <div class="col pr-1">' +
        '        <div class="bg-white shadow p-2 mb-2">' +
        '            <h5 class="text-right">Return Date</h5>' +
        '        </div>' +
        '    </div>' +
        '    <div class="col pl-1">' +
        '        <div class="bg-white shadow p-2 mb-2">' +
        '           <h5 class="text-left">'+loaded.order.return_date+'</h5>' +
        '        </div>' +
        '    </div>' +
        '</div>';

    target.innerHTML += '<div class="row">' +
        '    <div class="col pr-1">' +
        '        <div class="bg-white shadow p-2 mb-2">' +
        '            <h5 class="text-right">Amount</h5>' +
        '        </div>' +
        '    </div>' +
        '    <div class="col pl-1">' +
        '        <div class="bg-white shadow p-2 mb-2">' +
        '           <h5 class="text-left">'+loaded.order.amount+'</h5>' +
        '        </div>' +
        '    </div>' +
        '</div>';

    target.innerHTML += '<div class="row">' +
        '    <div class="col pr-1">' +
        '        <div class="bg-white shadow p-2 mb-2">' +
        '            <h5 class="text-right">Phone Number</h5>' +
        '        </div>' +
        '    </div>' +
        '    <div class="col pl-1">' +
        '        <div class="bg-white shadow p-2 mb-2">' +
        '           <h5 class="text-left">'+loaded.order.phone_number+'</h5>' +
        '        </div>' +
        '    </div>' +
        '</div>';

    target.innerHTML += '<div class="row">' +
        '    <div class="col pr-1">' +
        '        <div class="bg-white shadow p-2 mb-2">' +
        '            <h5 class="text-right">Payment</h5>' +
        '        </div>' +
        '    </div>' +
        '    <div class="col pl-1">' +
        '        <div class="bg-white shadow p-2 mb-2">' +
        '           <h5 class="text-left">'+loaded.order.payment+' Birr</h5>' +
        '        </div>' +
        '    </div>' +
        '</div>';

    target.innerHTML += '<div class="row">' +
        '    <div class="col pr-1">' +
        '        <div class="bg-white shadow p-2 mb-2">' +
        '            <h5 class="text-right">Additional Preference</h5>' +
        '        </div>' +
        '    </div>' +
        '    <div class="col pl-1">' +
        '        <div class="bg-white shadow p-2 mb-2">' +
        '           <p class="card-text text-left">'+loaded.order.text+'</p>' +
        '        </div>' +
        '    </div>' +
        '</div>';

}

function preferenceShow(){

    let target = _("preference_place");

    for(let i = 0; i < loaded.preferences.length; i++){

        let pref = loaded.preferences[i];

        target.innerHTML += '<div class="row">' +
            '    <div class="col pr-1">' +
            '        <div class="bg-white shadow p-2 mb-2">' +
            '            <h5 class="text-right">'+(pref.name.toUpperCase().replace("_"," "))+'</h5>' +
            '        </div>' +
            '    </div>' +
            '    <div class="col pl-1">' +
            '        <div class="bg-white shadow p-2 mb-2"><h5 class="text-left">'+pref.value+'</div> </h5>' +
            '    </div>' +
            '</div>';

    }

    /*
    target.innerHTML += '<div class="row">' +
        '    <div class="col pr-1">' +
        '        <div class="bg-white shadow p-2 mb-2">' +
        '            <h5 class="text-right">Full Name</h5>' +
        '        </div>' +
        '    </div>' +
        '    <div class="col pl-1">' +
        '        <div class="bg-white shadow p-2 mb-2">' +
        '           <h5 class="text-left">'+loaded.order.full_name+'</h5>' +
        '        </div>' +
        '    </div>' +
        '</div>';

    target.innerHTML += '<div class="row">' +
        '    <div class="col pr-1">' +
        '        <div class="bg-white shadow p-2 mb-2">' +
        '            <h5 class="text-right">Email</h5>' +
        '        </div>' +
        '    </div>' +
        '    <div class="col pl-1">' +
        '        <div class="bg-white shadow p-2 mb-2">' +
        '           <h5 class="text-left">'+loaded.order.email+'</h5>' +
        '        </div>' +
        '    </div>' +
        '</div>';

    target.innerHTML += '<div class="row">' +
        '    <div class="col pr-1">' +
        '        <div class="bg-white shadow p-2 mb-2">' +
        '            <h5 class="text-right">Phone Number</h5>' +
        '        </div>' +
        '    </div>' +
        '    <div class="col pl-1">' +
        '        <div class="bg-white shadow p-2 mb-2">' +
        '           <h5 class="text-left">'+loaded.order.phone_number+'</h5>' +
        '        </div>' +
        '    </div>' +
        '</div>';
        */

}

function imageLoader(image_name, tag_id){

    let imageObject = _(tag_id);

    let war = new XMLHttpRequest();
    war.open("POST", constants.image_address, true);

    let data = new FormData();
    data.append("image", image_name);
    war.send(data);

    war.onreadystatechange = function() {

        if (this.readyState === 4 && this.status === 200) {

            imageObject.src = this.responseText;
            //console.log(imageObject);

            //alert("response for "+tag_id+" has just received");

        }

    };

}

function _(id){
    return document.getElementById(id);
}

function visualization(){

    if(loaded.order.status === "request" && constants.user === "admin"){
        $("#order_approval").show(1500);
    }
    else if(loaded.order.status === "payed" && constants.user === "admin"){
        $("#assign_designer").show(1500);
        setTimeout(loadDesigners(), 10);
    }
    else if(loaded.order.status === "designing" && constants.user === "admin"){
        $("#set_to_preview").show(1500);
    }
    else if(loaded.order.status === "printing" && constants.user === "admin"){
        $("#set_to_finished").show(1500);
    }
    else if(loaded.order.status === "printing" && constants.user === "admin"){
        $("#set_to_finished").show(1500);
    }

    if(loaded.order.status === "finished" && constants.user === "customer"){
        $("#receive_order").show(1500);
    }

}

function loadPreviews(){

    let war = new XMLHttpRequest();
    war.open("POST", constants.preview_address, true);

    let data = new FormData();
    data.append("order", constants.order_id);
    war.send(data);

    war.onreadystatechange = function() {

        if (this.readyState === 4 && this.status === 200) {

            let temp = JSON.parse(this.responseText);

            if(temp == null || temp.length === 0){
                loaded.previews = [];
                _("previews_container").innerHTML = "<h5>No Previews Yet</h5>";
            }
            else{
                loaded.previews = temp;
                setTimeout(previewShow(), 10);
            }
            //_("order_place").innerHTML = this.responseText;


        }

    };

}

function loadDesign(){

    let war = new XMLHttpRequest();
    war.open("POST", constants.design_address, true);

    let data = new FormData();
    data.append("design", loaded.order.design);
    war.send(data);

    war.onreadystatechange = function() {

        if (this.readyState === 4 && this.status === 200) {

            loaded.design = JSON.parse(this.responseText);

            if(loaded.design != null){
                _("order_design").innerHTML += '<div class="card">' +
                    '                <img class="card-img-top" src="" id="selected_design" alt="Card image cap">' +
                    '                <div class="card-body">' +
                    '                    <h5 class="card-title" id="design_title"><strong>Title: '+loaded.design.name+'</strong> </h5>' +
                    '                    <h5 class="card-title" id="design_designer"><strong>Designer: '+loaded.design.designer+'</strong> </h5>' +
                    '                </div>' +
                    '            </div>';

                setTimeout(imageLoader("design_images/"+loaded.design.image, "selected_design"), 20);

            }
            else{
                _("order_design").innerHTML += "<h4>No Design</h4>";
            }
            //_("order_place").innerHTML = this.responseText;

        }

    };

}

function previewImageLoader(){

    let prev = null;
    for(let i=0; i<loaded.previews.length; i++){
        prev = loaded.previews[i];
        setTimeout(imageLoader("preview_images/"+prev.image, "preview_"+prev.id), 10);
    }

}

function previewShow(){

    let object = '<div class="card" style="width: 18rem;">' +
        '  <img class="card-img-top" src=".../100px180/" alt="Card image cap">' +
        '  <div class="card-body">' +
        '    <h5 class="card-title">Card title</h5>' +
        '    <a href="#" class="btn btn-primary">Go somewhere</a>' +
        '  </div>' +
        '</div>';

    let target = _("previews_container");

    let prev = null;
    let html_text = '';

    for(let i=0; i<loaded.previews.length; i++){

        prev = loaded.previews[i];

        if(constants.user === "designer"){

            html_text += '<div class="card mb-2" id="preview_card_'+prev.id+'">' +
                '  <img class="card-img-top" src="" id="preview_'+prev.id+'" width="100%" alt="Card image cap">' +
                '  <div class="card-body">' +
                '    <h5 class="card-title" id="preview_status_'+prev.id+'">'+prev.status+'</h5>' +
                '    <button onclick="deletePreview(\'preview_card_'+prev.id+'\', '+prev.id+')" class="btn btn-danger">Delete</button>' +
                '  </div>' +
                '</div>';

        }
        else if(constants.user === "admin"){

            html_text += '<div class="card mb-2" id="preview_card_'+prev.id+'">' +
                '  <img class="card-img-top" src="" id="preview_'+prev.id+'" width="100%" alt="Card image cap">' +
                '  <div class="card-body">' +
                '    <h5 class="card-title" id="preview_status_'+prev.id+'">'+prev.status+'</h5>' +
                '    <button onclick="grantPreview(\'preview_status_'+prev.id+'\', '+prev.id+')" class="btn btn-success">Grant</button>' +
                '    <button onclick="declinePreview(\'preview_status_'+prev.id+'\', '+prev.id+')" class="btn btn-danger">Decline</button>' +
                '  </div>' +
                '</div>';

        }

        else{
            html_text += '<div class="card mb-2" id="preview_card_'+prev.id+'">' +
                '  <img class="card-img-top" src="" id="preview_'+prev.id+'" width="100%" alt="Card image cap">' +
                '  <div class="card-body">' +
                '    <h5 class="card-title" id="preview_status_'+prev.id+'">'+prev.status+'</h5>' +
                '    <a href="'+constants.preview_select_address+'/'+prev.id+'/'+constants.order_id+'" class="btn btn-success">Select</a>' +
                '  </div>' +
                '</div>';
        }

        //if(i === 0){
            //console.log(prev);
            //setTimeout(imageLoader("preview_images/"+prev.image, "preview_"+prev.id), (i+1)*5);
        //}

    }

    target.innerHTML += html_text;
    previewImageLoader();

}

function loadDesigners() {

    let object = '<div class="row">' +
        '    <div class="col pr-1">' +
        '        <div class="bg-white shadow p-2 mb-2">' +
        '            <h5 class="text-right"></h5>' +
        '        </div>' +
        '    </div>' +
        '    <div class="col pl-1">' +
        '        <div class="bg-white shadow p-2 mb-2">' +
        '        </div>' +
        '    </div>' +
        '</div>';

    let war = new XMLHttpRequest();
    war.open("POST", constants.user_address, true);

    //let data = new FormData();
    //data.append("order", constants.user_address);
    war.send();

    war.onreadystatechange = function() {

        if (this.readyState === 4 && this.status === 200) {

            loaded.designers = JSON.parse(this.responseText);
            //_("order_place").innerHTML = this.responseText;

            if(loaded.designers != null){

                for(let i=0; i<loaded.designers.length; i++){

                    let temp = loaded.designers[i];

                    _("assign_designer_select").innerHTML += '<option value="'+temp.username+'">'+temp.f_name+' '+temp.l_name+'</option>';

                }

            }

        }

    };

}

function grantPreview(target_tag, preview){

    let target = _(target_tag);

    let war = new XMLHttpRequest();
    war.open("POST", constants.preview_grant_address, true);

    let data = new FormData();
    data.append("preview", preview);
    war.send(data);

    war.onreadystatechange = function() {

        if (this.readyState === 4 && this.status === 200) {

            let result = JSON.parse(this.responseText);
            //_("order_place").innerHTML = this.responseText;

            if(result.status){

                target.innerHTML = "Granted";

            }else{

                target.innerHTML = result.message;

            }

        }

    };

}

function declinePreview(target_tag, preview){

    let target = _(target_tag);

    let war = new XMLHttpRequest();
    war.open("POST", constants.preview_decline_address, true);

    let data = new FormData();
    data.append("preview", preview);
    war.send(data);

    war.onreadystatechange = function() {

        if (this.readyState === 4 && this.status === 200) {

            let result = JSON.parse(this.responseText);
            //_("order_place").innerHTML = this.responseText;

            if(result.status){

                target.innerHTML = "Declined";

            }else{

                target.innerHTML = result.message;

            }

        }

    };

}

function deletePreview(target_card, preview){

    //let target = _(target_card);

    let war = new XMLHttpRequest();
    war.open("POST", constants.preview_delete_address, true);

    let data = new FormData();
    data.append("preview", preview);
    war.send(data);

    war.onreadystatechange = function() {

        if (this.readyState === 4 && this.status === 200) {

            let result = JSON.parse(this.responseText);
            //_("order_place").innerHTML = this.responseText;

            if(result.status){

                $("#"+target_card).hide()

            }else{

                _(target_card).innerHTML = result.message;

            }

        }

    };

}
