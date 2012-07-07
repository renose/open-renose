jQuery.fn.editfield = function(url){
    return this.each(function(){
        $(this).editable(url, {
            loadtext: 'bitte warten...',
            indicator: 'speichern...',
            placeholder: '-',
            tooltip: 'Ändern',
            submit: 'Speichern',
            cancel: 'Abbrechen',
            submitdata: function(value, settings) {
                return $(this).data();
            },
            callback : function(value, settings) {
                var data = jQuery.parseJSON(value);

                if(data.status.code > 0)
                {
                    $(this).html(data.data);
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