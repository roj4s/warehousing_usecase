
$('.glyphicon-plus').click(function() {

	var _this = $(this);

	if(_this.hasClass('plus_unlocked')){

		
		var table = $(this).attr("table_name");
		var id = $(this).attr("table_id");
		var _url = "/api/addelement/" + table + "/" + id;

		$.ajax({
			url: _url,
			success: function(result)
			{
        		
        		var alert_type = "success";
        		if(result['ok']){

        			
				_this.addClass('locked').removeClass('plus_unlocked');
				$('#current_shipment_table > tbody:last-child').append('<tr table_name="'+ table +'" table_id="' + id + '"><td>' + result['warehouse'] + '</td><td>' + result['pallet'] + '</td><td>' + result['master'] + '</td><td>' + result['imei']+ '</td><td><span class="glyphicon glyphicon-minus minus_unlocked" table_name="' + table + '" table_id="' + id +'"></span></td></tr>');


        		}
        		else{
        			alert_type = "error";
        		}

        		$.notify(result['msg'], alert_type);     	
        		

    		}});
		
	}



});

$('.glyphicon-minus').click(function() {

	var _this = $(this);
	if(_this.hasClass('plus_unlocked')){

		var table = $(this).attr("table_name");
		var id = $(this).attr("table_id");
		var _url = "/api/delelement/" + table + "/" + id;

		$.ajax({
			url: _url,
			success: function(result)
			{
        		
        		var alert_type = "success";
        		if(result['ok']){

        			$("tr[table_name='"+ table +"'][table_id='" + id + "']").remove();
        			alert(result['unlock_this']);
        		}
        		else{
        			alert_type = "error";
        		}

        		$.notify(result['msg'], alert_type);     	
        		

    		}});

	}

});


$('.tree-toggle').click(function () {
	$(this).parent().children('ul.tree').toggle(200);
});

$(function() {
		$('.tree-toggle').parent().children('ul.tree').toggle(200);
		
});
