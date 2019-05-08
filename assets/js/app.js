

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

console.log('Hello Webpack Encore! Edit me in assets/js/app.js!!!');