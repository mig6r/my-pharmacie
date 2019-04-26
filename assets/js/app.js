
import('../css/app.scss');
const $ = require('jquery');
import('bootstrap');

$(document).ready(function() {
    $('[data-toggle="popover"]').popover();
});
