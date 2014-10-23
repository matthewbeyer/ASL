$(function(){
    $('[data-method]').append(function(){
        return "\n"+
        "<form action='"+$(this).attr('href')+"' method='POST' style='display:none'>\n"+
        "   <input type='hidden' name='_method' value='"+$(this).attr('data-method')+"'>\n"+
        "</form>\n"
    })
    .attr('href', '#')
    .click(function() {
        if($(this).attr('data-method') == "delete") {
            var strConfirm;
            if($(this).attr('data-confirm') != null) {
                strConfirm = $(this).attr('data-confirm');
            } else {
                strConfirm = "Are you sure? This cannot be undone.";
            }
            if(!confirm(strConfirm)) {
                return false;
            }
        }
        $(this).find("form").submit();
    });
});