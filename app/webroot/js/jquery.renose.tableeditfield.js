jQuery.fn.tableeditfield = function(save_url, delete_url){
    return this.each(function(){
        $(this).find('.edit-delete').hide();
        $(this).find('.edit-delete').click(function() {
            var that = this;
            $.ajax({
                url: delete_url,
                type: 'POST',
                dataType: 'JSON',
                data: $(that).parent().data(),
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
        
        $(this).find('.edit-textbox').editable(save_url, {
            loadtext: 'bitte warten...',
            indicator: 'speichern...',
            placeholder: '-',
            tooltip: 'Zum Ändern klicken...',
            submit: 'Ändern',
            cancel: 'Abbrechen',
            height: 'none',
            width: 'none',
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