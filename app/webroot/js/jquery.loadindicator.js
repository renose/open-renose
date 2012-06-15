/*
* jquery.loadindicator.js
*
* Copyright (c) 2011-2012 open reNose team <info at renose.de>.
* Simon Wörner, Patrick Hafner and Daniel Greiner.
*
* This file is part of open reNose.
*
* open reNose is free software: you can redistribute it and/or modify
* it under the terms of the GNU General Public License as published by
* the Free Software Foundation, either version 3 of the License, or
* (at your option) any later version.
*
* open reNose is distributed in the hope that it will be useful,
* but WITHOUT ANY WARRANTY; without even the implied warranty of
* MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
* GNU General Public License for more details.
*
* You should have received a copy of the GNU General Public License
* along with open reNose.  If not, see <http ://www.gnu.org/licenses/>.
*
*/

(function( $ ){

    var methods = {

	init : function( options ) {

	    var settings = {
		text : 'PDF wird generiert'
	    }

	    return this.each(function(){

		if ( options ) {
		    $.extend( settings, options );
		}

		var obj = $(this);

                jQuery('body').append('<div id="renose-print-load"><p></p></div>');
                jQuery('body').find('div#renose-print-load p').text(settings.text);

		obj.click(function() {
                    obj.loadindicator('start', settings);
                    return false;
                });

	    });

	},

	start : function( settings ) {

	    return this.each(function(){
		var obj = $(this);

                jQuery('body').find('div#renose-print-load').show();

                obj.loadindicator('ajaxRequest', settings);

	    });

	},

	ajaxRequest : function ( settings ) {

	    return this.each(function() {
		var obj = jQuery(this);

                var dataLink = obj.data('link');

                if(!dataLink) {
                    dataLink = obj.attr('href');
                }

                $.load(dataLink, null, function() {
                    jQuery('body').find('div#renose-print-load').hide();
                });

	    });

	}

    };

    $.fn.loadindicator = function( method ) {

	if ( methods[method] ) {
	    return methods[method].apply( this, Array.prototype.slice.call( arguments, 1 ));
	} else if ( typeof method === 'object' || ! method ) {
	    return methods.init.apply( this, arguments );
	} else {
	    $.error( 'Method ' +  method + ' does not exist on jQuery.loadindicator' );
	}

    };

})( jQuery );