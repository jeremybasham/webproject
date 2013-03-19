/**
 * main.js file
 */
 
 
 /**
 * drop down menu effect
 */
 

jQuery(document).ready(function($) {
    $('#menu-main-menu > li').hover(
        function () {
            //show its submenu
            $(this).children('ul').stop().slideDown(100);

 
        }, 
        function () {
            //hide its submenu
            $(this).children('ul').stop().slideUp(100);
        }
    );
     
});