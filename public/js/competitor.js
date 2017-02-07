function autoperceptionSave(){
    $("#saving-label").show();
    $.ajax({
      type: "POST",
      url: BASE_URL+'/competitor/autoperceptionSave',
      data: {'_token': $('input[name=_token]').val(), 'form': $('form').serializeArray(), 'exercise_id':exercise_id},
      success: function(){
        $("#saving-label").hide();
      },
      dataType: 'json'
    });

}

function knowledgeSave(){
    $("#saving-label").show();
    $.ajax({
      type: "POST",
      url: BASE_URL+'/competitor/knowledgeSave',
      data: {'_token': $('input[name=_token]').val(), 'form': $('form').serializeArray(), 'exercise_id':exercise_id},
      success: function(){
        $("#saving-label").hide();
      },
      dataType: 'json'
    });

}

$(function(){

   $(".textarea").wysihtml5();


})
