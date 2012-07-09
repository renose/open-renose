jQuery.fn.hide_element = function(url){
    return this.each(function(){
        $(this).find('.hide-checkbox').click(function () {
                var element = $(this).parent().find('.hide-element');
                var checked = $(this).is(':checked');
                var data = $(this).data();
                data.value = checked ? 1 : 0;

                $.ajax({
                    url : url,
                    type: 'POST',
                    dataType: 'JSON',
                    data: data,
                    success : function(data)
                    {
                        if(data.status.code > 0)
                        {
                            if(data.data)
                                element.fadeOut();
                            else
                                element.fadeIn();

                            $.jGrowl('Änderung erfolgreich gespeichert.');
                        }
                        else
                        {
                            console.log(data);
                            $.jGrowl(data.message, { header: 'Fehler', life: 10000 });
                        }
                    }
                });

            });
            
            var checkbox = $(this).find('.hide-checkbox');
            checkbox.ready(function () {
                var element = $(checkbox).parent().find('.hide-element');

                if($(checkbox).is(':checked'))
                    element.hide();
            });
    });
}