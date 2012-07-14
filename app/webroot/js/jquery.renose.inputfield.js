jQuery.fn.inputfield = function(url){
    return this.each(function(){
        $(this).change(function() {
            var that = this;
            var data = $(that).data();
            data.value = $(that).val();
            
            if(data.autocomplete)
                data.autocomplete = null;
            
            $.ajax({
                url: url,
                type: 'POST',
                dataType: 'JSON',
                data: data,
                success: function(data) {
                    if(data.status.code > 0)
                    {
                        $(this).val(data.data);
                        $.jGrowl('Änderung erfolgreich gespeichert.');
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
    });
}