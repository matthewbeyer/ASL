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
            if(!confirm("Are you sure you want to do this? You will have to add this person again if you decide you want them back.")) {
                return false;
            }
        }
        $(this).find("form").submit();
    });
});