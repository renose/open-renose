jQuery.fn.editbox = function(url){
    return this.each(function(){
        $(this).find('.edit-delete').hide();
        $(this).find('.edit-delete').click(function() {
            var that = this;
            var data = $(that).parent().data();
            data.value = null;
            
            $.ajax({
                url: url,
                type: 'POST',
                dataType: 'JSON',
                data: data,
                success: function(data) {
                    if(data.status.code > 0)
                    {
                        $(that).parent().find('.edit-textbox').attr('data-exists', 'false');
                        $(that).parent().find('.edit-textbox').html('-');
                        $.jGrowl('Löschen erfolgreich.');
                    }
                    else
                    {
                        console.log(data);
                        $.jGrowl(data.message, { header: 'Fehler', life: 10000 });
                    }
                }
            });

            return false;
        });

        $(this).mouseenter(function() {
            if($(this).find('.edit-textbox').attr('data-exists') == 'true')
                $(this).find('.edit-delete').css('display', '');
        });
        $(this).mouseleave(function() {
            $(this).find('.edit-delete').css('display', 'none');
        });

        $(this).find('.edit-textbox').editable(url, {
            type: 'wysihtml5',
            loadtext: 'Bitte warten...',
            indicator: 'Speichern...',
            placeholder: '-',
            tooltip: 'Zum Ändern klicken...',
            submit: 'Speichern',
            cancel: 'Abbrechen',
            height: 'none',
            width: 'none',
            rows: 10,
            submitdata: function(value, settings) {
                return $(this).parent().data();
            },
            callback : function(value, settings) {

                var data = jQuery.parseJSON(value);

                if(data.status.code > 0)
                {
                    $(this).html(data.data);
                    $(this).attr('data-exists', 'true');
                    $.jGrowl('Änderung erfolgreich gespeichert.');
                }
                else
                {
                    console.log(data);
                    $.jGrowl(data.message, { header: 'Fehler', life: 10000 });

                    $(this).html('Fehler');
                }

            }
        });
    });
}