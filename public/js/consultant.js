function exerciseSave(){
    $("#saving-label").show();
    $.ajax({
      type: "POST",
      url: BASE_URL+'/consultant/save',
      data: {'_token': $('input[name=_token]').val(), 'form': $('form').serializeArray(), 'data': data},
      success: function(){
        $("#saving-label").hide();
      },
      dataType: 'json'
    });

}

$(function(){

   $(".textarea").wysihtml5();
    
   var $editor = $(".textarea-disabled").wysihtml5();
   $editor.attr('disabled','disabled');


})
