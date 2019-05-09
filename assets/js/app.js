

let $ = require('jquery');
require('bootstrap');
require('../css/app.scss');
//require('./main.js');
//require('./map-custom.js')


require ('select2');
$("#medicament_symptomes, #symptomes").select2();

$(document).ready(function() {
    $('[data-toggle="popover"]').popover();
});

$(document).ready(function(){
    $(".tablerowhref").click(function() {
        window.document.location = $(this).data("href");
    });
})

$(document).ready(function(){
    $(".tablerowhref").mouseover(function() {
        //window.document.location = $(this).data("href");

    });
})