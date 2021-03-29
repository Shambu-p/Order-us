

let variables = {

    first: null,
    second: null,
    third: null,
    fourth: null

};

window.onload = function (){

    variables.first = _("first");
    variables.second = _("second");
    variables.third = _("third");
    variables.fourth = _("fourth");



    variables.first.onmouseenter = function (){
        onHover(variables.first);
    };
    variables.first.onmouseleave = function (){
        onBlur(variables.first);
    };
    variables.second.onmouseenter = function (){
        onHover(variables.second);
    };
    variables.second.onmouseleave = function (){
        onBlur(variables.second);
    };
    variables.third.onmouseenter = function (){
        onHover(variables.third);
    };
    variables.third.onmouseleave = function (){
        onBlur(variables.third);
    };
    variables.fourth.onmouseenter = function (){
        onHover(variables.fourth);
    };
    variables.fourth.onmouseleave = function (){
        onBlur(variables.fourth);
    };


};

function _(id) {

    return document.getElementById(id);
}

function onHover(element) {

    element.className = "col animate shadow p-3 mb-5 bg-white rounded";

}

function onBlur(element){

    element.className = "col animate";

}