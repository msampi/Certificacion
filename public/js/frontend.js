
/* Objectives */

//var BASE_URL = 'http://localhost/sed/public/';
//var BASE_URL = 'http://sed.centromultimedia.com.ar/public/';
var BASE_URL = 'http://www.evaluaciononline.es/';
var objcounter = 0;




function appendWeightSelect(num){

    return '<td class="weight-column rating-column" rowspan="2">'+
                '<select id="weight-selector-'+num+'" class="form-control weight" onchange="changeWeightColor()">'+
                    '<option value="0">0%</option>'+
                    '<option value="25">25%</option>'+
                    '<option value="50">50%</option>'+
                    '<option value="75">75%</option>'+
                    '<option value="100">100%</option>'+
                '</select>'+
            '</td>';
}

function appendRatingSelect(op, disabled){


    rating = $.parseJSON(op.rating);
    var options = "";
    for(var key in rating)
        options += '<option>'+rating[key].value[op.lang]+'</option>';
	return '<td class="rating-column">'+
				'<select '+disabled+' class="form-control">'+
                    options+
				'</select>'+
			'</td>';
}

function appendPDPObjective(){
    $("#pdp-objective").append('<tr class="pdp-improvement" data-id="" data-flag="'+objcounter+'">'+
                                    '<td><textarea data-field="objective" class="form-control"></textarea></td>'+
                                    '<td><textarea data-field="meta" class="form-control"></textarea></td>'+
                                    '<td><textarea data-field="action" class="form-control"></textarea></td>'+
                                    '<td><textarea data-field="resource" class="form-control"></textarea></td>'+
                                    '<td><a onclick="$(this).parent().parent().remove()" class="btn btn-danger btn-sm"><i class="fa fa-trash" style="font-size:16px"></i></a></td>'+
                                '</tr>');
    objcounter++;
}
function appendPDPArea(target_selector, append_elem){

    var plan_id = $('#'+target_selector).val();
    var plan_text = $("#"+target_selector+" option:selected").text();
    var action_selector = $('#'+target_selector).data('child');
    var action_id = $('#'+action_selector).val();
    var action_text = $("#"+action_selector+" option:selected").text();

    $("#"+append_elem).append('<tr class="plan-action-added" data-plan="'+plan_id+'" data-action="'+action_id+'">'+
                                    '<td><input type="text" class="form-control" value="'+plan_text+'" readonly></td>'+
                                    '<td><input type="text" class="form-control" value="'+action_text+'" readonly></td>'+
                                    '<td width="2%"><a onclick="$(this).parent().parent().remove()" class="btn btn-danger btn-sm"><i class="fa fa-trash" style="font-size:16px"></i></a></td>'+
                                '</tr>');
}
function appendObjective(options){
    var stage2, stage3 = '';
    if (options.stage != 2)
      stage2 = 'disabled';
    if (options.stage != 3)
        stage3 = 'disabled';

    objcounter = parseInt(objcounter) + parseInt(options.objnum);
	$("#objectives-container").append('<table class="table table-bordered objective-table">'+
    	'<thead>'+
    		'<th colspan="6" style="background-color:#3c8dbc"><button class="btn btn-xs btn-danger" onclick="removeObjective($(this).parent().parent().parent().parent(),$(this).parent().parent().parent().parent().find(\'[data-id]\').attr(\'data-id\'), \'Esta seguro de eliminar este objetivo?\')"><i class="fa fa-trash"></i></button></th>'+
    	'</thead>'+
    	'<tbody>'+
    		'<tr>'+
    			'<td width="22%"><strong>'+options.objective+'</strong></td>'+
    			'<td class="rating-column weight-column font-white"><strong>'+options.weight+'</strong></td>'+
    			'<td><strong>'+options.reviewHY+'</strong></td>'+
    			'<td class="rating-column"><strong>Rating</strong></td>'+
    			'<td><strong>'+options.reviewFY+'</strong></td>'+
    			'<td class="rating-column"><strong>Rating</strong></td>'+
    		'</tr>'+
    		'<tr>'+
    			'<td rowspan="2"><textarea data-flag="'+objcounter+'" data-select="weight-selector-'+objcounter+'" data-id="" data-oid="" data-pid="'+options.pid+'" data-eid="'+options.eid+'" data-uid="'+options.uid+'" data-stage="objective" data-pid="'+options.pid+'"  class="form-control  objective-first-textarea textarea-small-'+objcounter+'"></textarea></td>'+
    			appendWeightSelect(objcounter)+
    			'<td><textarea disabled class="form-control textarea-small-'+objcounter+'"></textarea></td>'+
    			appendRatingSelect(options, 'disabled')+
    			'<td><textarea disabled class="form-control textarea-small-'+objcounter+'"></textarea></td>'+
    			appendRatingSelect(options, 'disabled')+
    		'</tr>'+
    		'<tr>'+
    			'<td><textarea '+stage2+' class="form-control textarea-small-'+objcounter+'"></textarea></td>'+
    			appendRatingSelect(options, stage2)+
    			'<td><textarea '+stage3+' class="form-control textarea-small-'+objcounter+'"></textarea></td>'+
    			appendRatingSelect(options, stage3)+
    		'</tr>'+
    	'</tbody>'+
    '</table>');

    $(".textarea-small-"+objcounter).wysihtml5({
        toolbar: {
            "font-styles": false, // Font styling, e.g. h1, h2, etc.
            "emphasis": true, // Italics, bold, etc.
            "lists": true, // (Un)ordered lists, e.g. Bullets, Numbers.
            "html": false, // Button which allows you to edit the generated HTML.
            "link": false, // Button to insert a link.
            "image": false, // Button to insert an image.
            "color": false, // Button to change color of font
            "blockquote": false, // Blockquote
            "size": 'xs' // options are xs, sm, lg
          }
        });
    objcounter++;
    changeWeightColor();


}

function removeObjective(elem, id, message){

    if (confirm(message))
        $.ajax({
          type: "POST",
          url: BASE_URL+'objectives/delete',
          data: {'_token': $('input[name=_token]').val(), 'id': id},
          success: function(){
            $(elem).remove();
          },
          error: function(){
            $(elem).remove();
          },
          dataType: 'json'
        });
}

function getTotalWeight(){
    var total = 0;
    $('.weight').each(function(){
        total += parseInt($(this).val());
    })
    return total;
}



function changeWeightColor(){
    if (getTotalWeight() != 100){
        $('.weight-column').css('background-color','#dd4b39');
         $("#add-objective").show();
    }
    else{
        $('.weight-column').css('background-color','#00a65a');
        $("#add-objective").hide();
    }

}

function getObjectivesDataToSave(){

    var elements = Array();
    var data;
    var flag = null;

    $('textarea').each(function(){
        data = {
            stage: $(this).data('stage'),
            entry: $(this).data('entry'),
            id: $(this).attr('data-id'),
            uid: $(this).data('uid'),
            eid: $(this).data('eid'),
            pid: $(this).data('pid'),
            oid: $(this).data('oid'),
            selector: $("#"+$(this).data('select')).val(),
            description: $(this).val(),
            flag: $(this).data('flag')
        };

        elements.push(data);
    });

    return JSON.stringify(elements);

}

function getCompetitionsDataToSave(){

    var elements = {'comments': [],'ratings': []};

    var data;

    $('textarea').each(function(){
        data = {
            stage: $(this).data('stage'),
            id: $(this).data('id'),
            uid: $(this).data('uid'),
            eid: $(this).data('eid'),
            cid: $(this).data('cid'),
            entry: $(this).data('entry'),
            comment: $(this).val()

        };

        elements.comments.push(data);
    });

    $('.bh-selector').each(function(){
        data = {
            id: $(this).data('id'),
            bid: $(this).data('bid'),
            uid: $(this).data('uid'),
            eid: $(this).data('eid'),
            stage: $(this).data('stage'),
            entry: $(this).data('entry'),
            rating: $(this).val()
        };

        elements.ratings.push(data);
    });

    return JSON.stringify(elements);

}

function getValorationsDataToSave(){

    var elements = {'comments': [],'ratings': []};

    var data;

    $('textarea').each(function(){
        data = {
            stage: $(this).data('stage'),
            id: $(this).data('id'),
            uid: $(this).data('uid'),
            eid: $(this).data('eid'),
            cid: $(this).data('cid'),
            entry: $(this).data('entry'),
            comment: $(this).val()

        };

        elements.comments.push(data);
    });

    $('.bh-selector').each(function(){
        data = {
            id: $(this).data('id'),
            bid: $(this).data('bid'),
            uid: $(this).data('uid'),
            eid: $(this).data('eid'),
            stage: $(this).data('stage'),
            entry: $(this).data('entry'),
            rating: $(this).val()
        };

        elements.ratings.push(data);
    });

    return JSON.stringify(elements);

}

function getPDPDataToSave(){

    var elements = {'comments': [],'improvements': []};
    var data;

    $('textarea.comment').each(function(){
        data = {
            stage: $(this).data('stage'),
            id: $(this).data('id'),
            uid: $(this).data('uid'),
            eid: $(this).data('eid'),
            entry: $(this).data('entry'),
            comment: $(this).val()
        };

        elements.comments.push(data);
    });
    $('.pdp-improvement').each(function(){
        data = {
            id: $(this).data('id'),
            objective: $(this).find('textarea[data-field="objective"]')[0].value,
            meta: $(this).find('textarea[data-field="meta"]')[0].value,
            action: $(this).find('textarea[data-field="action"]')[0].value,
            resource: $(this).find('textarea[data-field="resource"]')[0].value,
            flag:$(this).data('flag')
        };

        elements.improvements.push(data);
    });

    return JSON.stringify(elements);

}

function objectivesSave(){
    $("#saving-label").show();

    $.ajax({
      type: "POST",
      url: BASE_URL+'objectives/save',
      data: {'_token': $('input[name=_token]').val(), 'data': getObjectivesDataToSave()},
      success: function(data){
        $("#saving-label").hide();
        $('[data-flag]').each(function(){
           $(this).attr('data-id', parseInt(data[$(this).data('flag')]) );

        })
      },
      dataType: 'json'
    });

}

function competitionsSave(){
    $("#saving-label").show();
    $.ajax({
      type: "POST",
      url: BASE_URL+'competitions/save',
      data: {'_token': $('input[name=_token]').val(), 'data': getCompetitionsDataToSave()},
      success: function(){
        $("#saving-label").hide();
      },
      dataType: 'json'
    });

}

function valorationsSave(){
    $("#saving-label").show();
    $.ajax({
      type: "POST",
      url: BASE_URL+'valorations/save',
      data: {'_token': $('input[name=_token]').val(), 'data': getValorationsDataToSave()},
      success: function(){
        $("#saving-label").hide();
      },
      dataType: 'json'
    });

}

function pdpSave(){
    $("#saving-label").show();
    $.ajax({
      type: "POST",
      url: BASE_URL+'pdp/save',
      data: {'_token': $('input[name=_token]').val(), 'data': getPDPDataToSave()},
      success: function(data){
        $('[data-flag]').each(function(){
           $(this).attr('data-id', parseInt(data[$(this).data('flag')]) );

        })
        $("#saving-label").hide();
      },
      dataType: 'json'
    });

}

function getAverage(elemclass){
  var sum = 0;
  var count = 0;
  $('.'+elemclass).each(function(){
    sum += parseInt($(this).val());
    count++;
  })
  return sum/(count/2);
}



$(function(){

    $('.pdp-selector').change(function(){
        child_selector = $('#'+$(this).data('child'));
        child_selector.empty();
        options = plans[$(this).val()];

        options.forEach(function(action){
            child_selector.append('<option value="'+action.id+'">'+action.desc+'</option>');
        })
    })

    $('#average-comp-user-half').html(getAverage('sel-us-half'));
    $('#average-comp-evaluator-half').html(getAverage('sel-ev-half'));
    $('#average-comp-user-full').html(getAverage('sel-us-full'));
    $('#average-comp-evaluator-full').html(getAverage('sel-ev-full'));

    $('.sel-ev-half').change(function(){
      $('#average-comp-evaluator-half').html(getAverage('sel-ev-half'));

    });
    $('.sel-ev-full').change(function(){
      $('#average-comp-evaluator-full').html(getAverage('sel-ev-full'));
    });
    $('.sel-us-half').change(function(){
      $('#average-comp-user-half').html(getAverage('sel-us-half'));

    });
    $('.sel-us-full').change(function(){
      $('#average-comp-user-full').html(getAverage('sel-us-full'));
    });







})
