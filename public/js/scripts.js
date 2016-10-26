
/* Autoload image upload */
var BASE_URL = 'http://localhost/sed/public/admin/';
//var BASE_URL = 'http://sed.centromultimedia.com.ar/public/';

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

function removeManyListItem(elem, id) {

    $(elem).parent().parent().remove();
    if ($(".many-list .panel-body").children().length == 1)
        $(".many-list .panel-body ").append('<div class="callout callout-info">'+
                                                '<p>Esta valoración no tiene valores</p>'+
                                            '</div>');

}


function multilangItemShow(lang, parent, button)
{
    
    $(parent).find(".multilang").each(function(index){
        if ($(this).data('lang') != lang )
            $(this).hide();
        else
            $(this).show();
        

    });

    $(parent).find("a").each(function(index){
        $(this).removeClass('active');
    });

    $(button).addClass('active');

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
    
    $(':password').val('');

    $(".many-list-button").click(function(){

        
        if ($(".many-list .panel-body").children().length == 2)
            $(".many-list .panel-body .callout").remove();
        
        var inputs = '';
        id = Math.random().toString(36).replace(/[^a-z]+/g, '');

        for (var key in languages) {
                
                inputs+='<input type="text" data-lang="'+languages[key]+'" name="values['+id+']['+key+']" class="form-control multilang">';
        }

        $(".many-list .panel-body").append('<div class="row"><div id='+id+' class="col-md-10">'+
                                    inputs+
                                '</div>'+
                                '<div class="col-md-2">'+
                                    '<a class="btn btn-danger" onclick="removeManyListItem(this);"><i class="glyphicon glyphicon-trash"></i> Eliminar</a>'+
                                '</div></div>');

        $("#"+id).each(function(){

            $(this).find(".multilang").each(function(index){

                if (index != 0){
                    $(this).hide();
                    $(this).parent().append('<a class="btn btn-xs btn-danger" onclick="multilangItemShow(\''+$(this).data('lang')+'\', this.parentElement, this)" style="margin:2px">'+$(this).data('lang')+'</a>');
                
                }
                else
                    $(this).parent().append('<a class="btn btn-xs btn-danger active" onclick="multilangItemShow(\''+$(this).data('lang')+'\', this.parentElement, this)" style="margin:2px">'+$(this).data('lang')+'</a>');
                
            })

        });
        
        
    });

    $(".documents-list-button").click(function(){

        
        if ($(".documents-list .panel-body").children().length == 2)
            $(".many-list .panel-body .callout").remove();

        $(".documents-list .panel-body").append('<div class="row"><div class="col-md-10">'+
                                    '<input type="file" style="margin-top:5px" name="docs[][value]">'+
                                '</div>'+
                                '<div class="col-md-2">'+
                                    '<a class="btn btn-danger" onclick="removeManyListItem(this);"><i class="glyphicon glyphicon-trash"></i> Eliminar</a>'+
                                '</div></div>');
        

        
    });

   

    $(".behaviour-list-button").click(function(){

        
        if ($(".behaviour-list .panel-body").children().length == 2)
            $(".behaviour-list .panel-body .callout").remove();

        var inputs = '';
        id = Math.random().toString(36).replace(/[^a-z]+/g, '');
        for (var key in languages) {
                
                inputs+='<textarea data-lang="'+languages[key]+'" name="behaviours['+id+']['+key+']" class="form-control multilang"></textarea>';
        }

        $(".behaviour-list .panel-body").append('<div class="row"><div id='+id+' class="col-md-10">'+
                                    inputs+
                                '</div>'+
                                '<div class="col-md-2">'+
                                    '<a class="btn btn-danger" onclick="removeManyListItem(this);"><i class="glyphicon glyphicon-trash"></i> Eliminar</a>'+
                                '</div></div>');

        $("#"+id).each(function(){

            $(this).find(".multilang").each(function(index){

                if (index != 0){
                    $(this).hide();
                    $(this).parent().append('<a class="btn btn-xs btn-danger" onclick="multilangItemShow(\''+$(this).data('lang')+'\', this.parentElement, this)" style="margin:2px">'+$(this).data('lang')+'</a>');
                
                }
                else
                    $(this).parent().append('<a class="btn btn-xs btn-danger active" onclick="multilangItemShow(\''+$(this).data('lang')+'\', this.parentElement, this)" style="margin:2px">'+$(this).data('lang')+'</a>');
                
            })

        });
        

    });



    $(".multilang-group").each(function(){

        $(this).find(".multilang").each(function(index){

            if (index != 0){
                $(this).hide();
                $(this).parent().append('<a class="btn btn-xs btn-danger" onclick="multilangItemShow(\''+$(this).data('lang')+'\', this.parentElement, this)" style="margin:2px">'+$(this).data('lang')+'</a>');
            
            }
            else
                $(this).parent().append('<a class="btn btn-xs btn-danger active" onclick="multilangItemShow(\''+$(this).data('lang')+'\', this.parentElement, this)" style="margin:2px">'+$(this).data('lang')+'</a>');
            
        })

    });

    $(".new-post").keyup(function(){
       
        if (!this.value)
            $(".post-list").prop( "disabled", false );
        else
            $(".post-list").prop( "disabled", true );

    })

   





});

    