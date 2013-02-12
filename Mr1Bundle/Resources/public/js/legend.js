function showHide(obiect)
{
    $('.days > .'+obiect).slideToggle('slow', function(){
        if($('.days > .'+obiect).is(':visible'))
        {
            $('#'+obiect+' > .badge').text('on');
        }
        else 
        {
            $('#'+obiect+' > .badge').text('off');
        }
    })
}


$(document).ready(function(){
   
   
    $.each($('.legend li a'), function(){
        $(this).attr('id');
        if ($('.'+$(this).attr('id')).length == 0)
        {
            $(this).hide();
        }
    });

   $('.legend li a').bind('click', function(){
       
        var id = $(this).attr('id');
        showHide(id);
       
   });

    
});