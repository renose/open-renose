/*
* jquery.textlimiter.js
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
*/

(function( $ ){

    var methods = {

        init : function( options ) {

            var settings = {
                maxCharsPerRow : 105,                   // limit max chars per row
                maxRows : 10,                           // max rows allowed
                text : '%r rows or %c characters left'  // customize text, %r is placeholder for rowCount, %c for chars
            }

            return this.each(function(){

                if ( options ) {
                    $.extend( settings, options );
                }

                var obj = $(this);
                obj.parent().append('<p class="textlimiter"></p>');

                obj.keyup(function(){
                    obj.textlimiter('limitText', settings);
                    return false;
                });

            });

        },

        limitText : function( settings ) {

            return this.each(function(){
                var obj = $(this);
                var text = obj.val();

                // max chars per row
                var maxCharsTotal = settings.maxCharsPerRow * settings.maxRows;

                var rowsInText = text.split(/\n|\f/).length;
                var charsInText = text.length;

                var rowsLeft = settings.maxRows - rowsInText;
                var charsLeft = (settings.maxCharsPerRow * rowsLeft) - charsInText;

                var textString = settings.text.replace(/(%r)/, rowsLeft);
                textString = textString.replace(/(%c)/, charsLeft);

                if(charsLeft <= 0 || rowsLeft <= 0) {
                    obj.val(text.substr(0, (text.length -1) ));
                }

                obj.parent().find('p.textlimiter').text(textString);

            });

        }
    };

    $.fn.textlimiter = function( method ) {

        if ( methods[method] ) {
            return methods[method].apply( this, Array.prototype.slice.call( arguments, 1 ));
        } else if ( typeof method === 'object' || ! method ) {
            return methods.init.apply( this, arguments );
        } else {
            $.error( 'Method ' +  method + ' does not exist on jQuery.textlimiter' );
        }

    };

})( jQuery );