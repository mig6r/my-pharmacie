

const $ = require('jquery');
require('bootstrap');
require('../css/app.scss');


require ('select2');
$("#medicament_symptomes, #symptomes").select2();

$(document).ready(function() {
    $('[data-toggle="popover"]').popover();
});
