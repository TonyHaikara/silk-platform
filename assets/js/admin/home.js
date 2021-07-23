require('bootstrap');
var moment = require('moment');
require('chart.js');
require('@fortawesome/fontawesome-free/js/all.min');

class Home {
    instanceProperty = "Home";
    boundFunction = () => {
        return this.instanceProperty;
    }

    static init = function() {

    }
}

$(document).ready(function() {
    Home.init();
});
