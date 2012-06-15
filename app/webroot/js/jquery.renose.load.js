jQuery(document).ready(function(){

    $("a.calendar-week-link")
        .tipTip({
            maxWidth: "auto",
            edgeOffset: 2
        })
    ;

    // load indicator for pdf export
    jQuery('#renose-print')
        .loadindicator({
            text : 'PDF wird generiert'
        })
    ;


});