$.editable.addInputType('wysihtml5', {
    element : function(settings, original) {
        settings.wysihtml5 = new Array();
        settings.wysihtml5.editor = null;
        settings.wysihtml5.uuid = Math.uuid();
        
        var container = $('<div />');
        $(container).attr('id', settings.wysihtml5.uuid);
        $(container).attr('class', 'wysihtml5');
        $(this).append(container);
        
        var toolbar = $('#wysihtml5-toolbar').clone();
        $(toolbar).attr('id', settings.wysihtml5.uuid + '-toolbar');
        $(toolbar).attr('class', 'wysihtml5-toolbar');
        $(container).append(toolbar);
        
        var textarea = $('<textarea />');
        $(textarea).attr('id', settings.wysihtml5.uuid + '-textarea');
        if (settings.rows) {
            textarea.attr('rows', settings.rows);
        } else if (settings.height != "none") {
            textarea.height(settings.height);
        }
        if (settings.cols) {
            textarea.attr('cols', settings.cols);
        } else if (settings.width != "none") {
            textarea.width(settings.width);
        }
        $(container).append(textarea);
        
        return(container);
    },
    plugin: function(settings, original) {
        settings.wysihtml5.editor = new wysihtml5.Editor(settings.wysihtml5.uuid + '-textarea', {
            toolbar: settings.wysihtml5.uuid + '-toolbar',
            parserRules:  wysihtml5ParserRules
        });
    },
    get_data: function (settings, original) {
        return {
            value: settings.wysihtml5.editor.textarea.element.value
        };
    }
});