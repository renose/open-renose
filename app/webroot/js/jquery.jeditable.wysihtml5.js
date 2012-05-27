var wysihtml5_editor;
$.editable.addInputType('wysihtml5', {    
    element : function(settings, original) {        
        var container = $('<div id="wysihtml5">');
        $(this).append(container);
        $(container).attr('class', 'wysihtml5');
        
        /*var toolbar = $('<div id="wysihtml5-toolbar">');
        $(container).append(toolbar);
        $(toolbar).css('display', 'none');
        
        var toolbar_commands = $('<ul class="commands">');
        $(toolbar).append(toolbar_commands);
        
        var command_bold = $('<li data-wysihtml5-command="bold" class="command" href="javascript:;" unselectable="on"></li>');
        $(toolbar_commands).append(command_bold);
        var command_italic = $('<li data-wysihtml5-command="italic" class="command" href="javascript:;" unselectable="on"></li>');
        $(toolbar_commands).append(command_italic);*/
        
        var toolbar = $('#wysihtml5-toolbar').clone();
        toolbar.attr('id', 'my-wysihtml5-toolbar');
        $(container).append(toolbar);
        
        var input = $('<textarea id="wysihtml5-textarea">');
        $(container).append(input);
        
        return(container);
    },
    plugin: function(settings, original) {
        wysihtml5_editor = new wysihtml5.Editor("wysihtml5-textarea", {
            toolbar: "my-wysihtml5-toolbar",
            parserRules:  wysihtml5ParserRules
        });
    },
    submit_data: function (settings, original) {
        return {
            value: wysihtml5_editor.textarea.element.value
        };
    }
         
});