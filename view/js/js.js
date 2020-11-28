$(document).ready(function() {

    function getSetHeight(){
        let heightNav = $("#nav").css('height');
        let heightScreen = document.documentElement.scrollHeight;
        $("#mainBlock").css('height', heightScreen - heightNav.substr(0, 2));
    }
    getSetHeight();



});