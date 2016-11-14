var itemCounter = -1;
var exerciseCounter = 1;
function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $('#image')
                .attr('src', e.target.result)
                .width(140)
                .height(140);
        };

        reader.readAsDataURL(input.files[0]);
    }
}

function addItemToRemove(id) {
    $("#remove-item-list").val($("#remove-item-list").val()+','+id);
}
function addOptionToRemove(id) {
    $("#remove-option-list").val($("#remove-option-list").val()+','+id);
}

function removeManyListItem(elem, id) {

    $(elem).parent().parent().remove();
    if ($(".item-list .panel-body").children().length == 0)
        $(".item-list .panel-body ").append('<div class="callout callout-info">'+
                                                '<p>Sin datos</p>'+
                                            '</div>');

}


function getInputType(type)
{
   
    if (type == 'competency'){
        var input = '<div class="col-md-5"><label>Indicador Positivo</label><textarea           name="items['+itemCounter+'][positivo]" class="form-control"></textarea></div>';
    
        input +='<div class="col-md-5"><label>Indicador Negativo</label><textarea name="items['+itemCounter+'][negativo]" class="form-control"></textarea></div>';
                
    }
    if (type == 'rating'){
        var input = '<div class="col-md-2"><label>Valor</label><input type="text"           name="items['+itemCounter+'][value]" class="form-control"></div>';
    
        input +='<div class="col-md-8"><label>Nombre</label><input type="text" name="items['+itemCounter+'][name]" class="form-control"></div>';
              
    }
    if (type == 'questionary'){
        var input = '<div class="col-md-8"><label>Pregunta</label><input type="text"           name="question['+itemCounter+'][question]" class="form-control"></div>';
    
        input +='<div class="col-md-2"><label style="display:block">&nbsp;</label><a class="btn btn-primary btn-full" onclick="addSubItem(this,'+itemCounter+')">Agregar opción</a></div>';
              
    }
    itemCounter--;
    return input;
    
}

function addSubItem(elem, number){
    
        $(elem).parent().parent().append('<div class="row">'+
                               '<div class="col-md-8 col-md-offset-1">'+
                                    '<label>Opción</label>'+
                                    '<input type="text" name="question['+number+'][option]['+itemCounter+']" class="form-control">'+
                                '</div>'+
                                '<div class="col-md-2"><label style="display:block">&nbsp;</label>'+
                                    '<a class="btn btn-danger btn-full" onclick="removeManyListItem(this);"><i class="glyphicon glyphicon-trash"></i> Eliminar</a>'+
                                '</div></div>');
    
        itemCounter--;
        

}

$(function () {
    
    $(".textarea").wysihtml5();
    $(".select2").select2();

    var $editor = $(".textarea-small-disabled").wysihtml5({
        toolbar: {
            "font-styles": false, // Font styling, e.g. h1, h2, etc.
            "emphasis": true, // Italics, bold, etc.
            "lists": true, // (Un)ordered lists, e.g. Bullets, Numbers.
            "html": false, // Button which allows you to edit the generated HTML.
            "link": false, // Button to insert a link.
            "image": false, // Button to insert an image.
            "color": false, // Button to change color of font
            "blockquote": false, // Blockquote
            "size": 'xs', // options are xs, sm, lg
          }
        });
    $editor.attr('disabled','disabled');
    

    $(".textarea-small").wysihtml5({
        toolbar: {
            "font-styles": false, // Font styling, e.g. h1, h2, etc.
            "emphasis": true, // Italics, bold, etc.
            "lists": true, // (Un)ordered lists, e.g. Bullets, Numbers.
            "html": false, // Button which allows you to edit the generated HTML.
            "link": false, // Button to insert a link.
            "image": false, // Button to insert an image.
            "color": false, // Button to change color of font
            "blockquote": false, // Blockquote
            "size": 'xs', // options are xs, sm, lg
          }
        });
   

   

    $(".item-list-button").click(function(){

        var type = $(this).data('type');
        if ($(".item-list .panel-body").children().length == 1)
            $(".item-list .panel-body .callout").remove();

        var inputs = getInputType(type);
        
        $(".item-list .panel-body").append('<div class="row">'+
                                    inputs+
                                '<div class="col-md-2"><label style="display:block">&nbsp;</label>'+
                                    '<a class="btn btn-danger btn-full" onclick="removeManyListItem(this);"><i class="glyphicon glyphicon-trash"></i> Eliminar</a>'+
                                '</div></div>');
        

    });
    
    
    
    $("#exercise-list-button").click(function(){
        $('#exercise-list').append('<li>'+
            '<div class="alert alert-success alert-dismissible handle">'+
                '<input type="hidden" name="exercise['+exerciseCounter+'][id]" value="-1">'+
                '<input type="hidden" name="exercise['+exerciseCounter+'][exercise_id]" value="'+$('#exercise-list-select').val()+'">'+
                '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>'+
                '<h4><i class="icon fa fa-check"></i> '+$('#exercise-list-select option:selected').text()+'</h4>'+
                '<div class="col-md-6">'+
                    '<strong>Desde: </strong>'+
                    '<input class="exercise-input datemask" type="text" name="exercise['+exerciseCounter+'][from]" >'+
                    '<strong> a las: </strong><input class="exercise-input-hour hourmask" name="exercise['+exerciseCounter+'][from_hour]" type="text">'+ 
                    '<strong> hs </strong>'+
                '</div>'+
                '<div class="col-md-6 pull-right">'+
                    '<strong>Hasta: </strong>'+
                    '<input class="exercise-input datemask" type="text" name="exercise['+exerciseCounter+'][to]">'+
                    '<strong> a las: </strong><input class="exercise-input-hour hourmask"  name="exercise['+exerciseCounter+'][to_hour]"  type="text">'+ 
                    '<strong> hs </strong>'+
                '</div>'+
            '</div>'+
        '</li>')
        $(".datemask").inputmask("dd/mm/yyyy", {"placeholder": "dd/mm/yyyy"});
        $(".hourmask").inputmask("hh:mm", {"placeholder": "hh:mm"});
        exerciseCounter++;
    });
    
    $("#competency-list-button").click(function(){
        $('#competency-list').append('<li>'+
            '<div class="alert alert-success alert-dismissible handle">'+
                '<input type="hidden" name="exercise['+exerciseCounter+'][id]" value="-1">'+
                '<input type="hidden" name="exercise['+exerciseCounter+'][exercise_id]" value="'+$('#competency-list-select').val()+'">'+
                '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>'+
                '<h4><i class="icon fa fa-check"></i> '+$('#competency-list-select option:selected').text()+'</h4>'+
            '</div>'+
        '</li>')
        exerciseCounter++;
    });
    
    $(".todo-list").sortable({
        placeholder: "sort-highlight",
        handle: ".handle",
        forcePlaceholderSize: true,
        zIndex: 999999
      });



});

    