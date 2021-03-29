function _(id){
    return document.getElementById(id);
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

function getPrice(id){





}

function approveDesign(design) {

    let formObject = _("approval_form_"+design);
    let price = _("price_input_"+design).value;
    //let approveObject = _("successive_"+design);

    let war = new XMLHttpRequest();
    war.open("POST", constants.approve_address, true);

    let data = new FormData();

    if(price !== ""){

        data.append("design", design);
        data.append("price", price);
        war.send(data);

        war.onreadystatechange = function() {

            if (this.readyState === 4 && this.status === 200) {

                let result = JSON.parse(this.responseText);

                if(result.status){
                    formObject.innerHTML = "<h5>Approved</h5>";
                    _("price_display_"+design).innerHTML = '<strong>Price: </strong>'+price+' Birr';
                }else{
                    formObject.innerHTML = "<h5>"+result.message+"</h5>";
                }

            }

        };

    }else{
        alert("set Price first");
    }

}

function rejectDesign(design) {

    let formObject = _("approval_form_"+design);
    let price = _("price_input_"+design).value;
    //let approveObject = _("successive_"+design);

    let war = new XMLHttpRequest();
    war.open("POST", constants.reject_address, true);

    let data = new FormData();

    data.append("design", design);
    war.send(data);

    war.onreadystatechange = function() {

        if (this.readyState === 4 && this.status === 200) {

            let result = JSON.parse(this.responseText);

            if(result.status){
                formObject.innerHTML = "<h5>Rejected</h5>";
            }else{
                formObject.innerHTML = "<h5>"+result.message+"</h5>";
            }

        }

    };

}
