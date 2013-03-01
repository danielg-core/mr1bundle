
function hide(obiect)
{
    $('.days > '+obiect).slideUp('slow');
}

function show(obiect)
{
    $('.days > .'+obiect).slideDown('slow');
}
// function to display properly workssssssss
function showtwo(assign,types)
{
    if(assign.length > 0 && types.length > 0)
    {
      hideAll();
      $.each(assign, function(index, value) {

        $.each(types, function(key, val) {

            $('.days > .'+value+'.'+val).slideDown('slow');

         });
      }); 
    }
    else if(assign.length > 0)
    {
         hideAll();
         $.each(assign, function(key, val) {

             $('.days > .'+val).slideDown('slow');

         });
    }
    else if(types.length > 0)
    {
        hideAll();
         $.each(types, function(key, val) {

             $('.days > .'+val).slideDown('slow');

         });
    }
    else
    {
        seeAll();
    }
       
}

function showHide(obiect)
{
    $('.days > .'+obiect).slideToggle('slow', function(){
       /* if($('.days > .'+obiect).is(':visible'))
        {
            $('#'+obiect+' > .badge').text('on');
        }
        else 
        {
            $('#'+obiect+' > .badge').text('off');
        }*/
    })
}

function hideAll()
{
    $('.days > a').hide();
}

function seeAll()
{
    hideAll();
    $('.days > a').slideDown();
}

function verify(obiect)
{
   var checked = $('#'+obiect+':checked').val()?true:false
   return checked;
}

function getParentId()
{
   var id = $(this).closest("ul").attr("id")
   return id;
}

function positionateModal()
{
  var windowWidth = $(window).width();
  var modalWidth = $("#myModal").width();
  var left = (windowWidth - modalWidth)/2;
  $("#myModal").css('left', left);   
}

$(document).ready(function(){
    
    //assignment links
    $('.days a').bind('click', function(){
       var param = $(this).attr('data-toggle');
       
       if(param == 'modal')
       {
            $("#myModal").html('');
           var rel = $(this).attr('rel');
           $.ajax({
    		type:"POST",
    		url:"ajax",
                data: {'file':rel},
    		success: function(data)
                {
                  $("#myModal").html(data);
                  positionateModal();
                }
           });
       }
    });
    
    $(window).resize(function(){
      positionateModal();
    });
   
    // each for checkboxes
    $.each($('.legend li input[type=checkbox]'), function(){
        var selector = $(this).attr('id');
        selector = "."+selector.replace(" ", ".");
        if ($(selector).length == 0)
        {
            $(this).parent().hide();
        }
    });

   // with checkboxes
  
   $('.legend li input[type=checkbox]').bind('click', function(){
        var assign = [];
        var types = [];
        var id = '';
        hideAll();
       $.each($('.legend li input[type=checkbox]'), function(){
           
          id = $(this).attr('id');
          
          if(verify(id))
          {
              var parent = $(this).closest("ul").attr("id");
              
              id = id.replace(" ", ".");
              
              if (parent == 'assignment')
              {
                 assign.push(id)
              }
              else if(parent == 'types')
              {
                  types.push(id); 
              }
          }
       });
       showtwo(assign,types);
    });

});