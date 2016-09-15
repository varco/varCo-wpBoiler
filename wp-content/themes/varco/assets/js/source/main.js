/*jslint browser: true */
/*global $, jQuery, alert, console, GoCactusBoilerplate:true */

var console = console || { log: function() { 'use strict'; } };

window.GoCactusBoilerplate = window.GoCactusBoilerplate || {};

(function($) {

// all Javascript code goes here
'use strict';

    $.App = function () {

        return {
            initialized: false,
            elements: {},
            settings: {
                debug: false,
                host_url: 'http://' + window.location.hostname + '/',
                pathname: document.location.pathname
            },

            init: function () {

                if (this.settings.debug) { console.log('init()'); }

                if (this.initalized) { return false; }
                this.initialized = true;

                var funct = GoCactusBoilerplate.App(),
                    w = jQuery( window ).width();

                // dom elements
                this.elements.body =  jQuery('body', 'html');
                this.elements.debug = jQuery('#txtDebug', this.elements.body);

                //Show debug if settings specify
                if (this.elements.debug.val()) {
                    this.settings.debug = true;
                    this.initDebug();
                }

                //Listen for device orientation changes
                window.addEventListener('orientationchange', funct.doOnOrientationChange);

                //Queue our load order
                jQuery(document).foundation();
                funct.topbarInit();
                funct.setJSDate(this);
                funct.windowListener(w);
                funct.doOnOrientationChange();

            },

            doOnOrientationChange: function () {
                switch(window.orientation) {
                    case -90:
                    case 90: //landscape
                break;
                default: //portrait
                break;
                }
            },

            initDebug: function () {

                if (this.settings.debug) { console.log('initDebug()'); }

                jQuery(this.elements.body).append('<div id="debug-message"></div>');
                jQuery('#debug-message').append('<p class="small">small</p><p class="medium">medium</p><p class="large">large</p><p class="exlarge">extra large</p>');
                jQuery(window).resize(function () {
                    jQuery('#debug-message').empty();
                    jQuery('#debug-message').append('<p class="small">small</p><p class="medium">medium</p><p class="large">large</p><p class="exlarge">extra large</p>');
                    jQuery('#debug-message').append('<p>width: ' + window.innerWidth + '</p>');
                });

            },

            topbarInit : function () {

                // mobile navigation
                jQuery("#mobile-nav-open, #mobile-nav-close").click(function(){
                });

                jQuery("#mobile-options-open, #mobile-options-close").click(function(){
                });

                // search button
                jQuery( ".primary-nav .search-button" ).click(function() {
                    jQuery(".top-bar-section #search-form-wrapper").toggle();
                });

            },

            windowListener: function (w) {
                jQuery( window ).resize( function(){
                    if( w != jQuery( window ).width() ){
                        w = jQuery( window ).width();
                        GoCactusBoilerplate.App().matchHeight();
                    }
                });
            },
            setJSDate: function () {
                var d = new Date();
                this.elements.currentYear = jQuery('.current-year', this.elements.body);
                this.elements.currentYear.html(d.getFullYear());
            },
            exploder: function (s, i, c) {
                var a = s.split(c),
                    a = a.filter(function(n){ return n !== "" }); ;
                if(!i || i === -1) {
                    return a;
                } else {
                    return a[i];
                }
            }
        };

    };

})(GoCactusBoilerplate);

jQuery(document).ready(function() {
    'use strict';
    GoCactusBoilerplate.App().init();
});
