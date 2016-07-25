
$('.glyphicon-plus').click(function() {

	var _this = $(this);

	if(_this.hasClass('plus_unlocked')){

		
		var table = $(this).attr("table_name");
		var id = $(this).attr("table_id");
		var _url = "/api/lock_element/" + table + "/" + id;

		$.ajax({
			url: _url,
			success: function(result)
			{
        		
        		var alert_type = "alert-success";
        		if(result['ok']){

        			
				_this.addClass('locked').removeClass('plus_unlocked');
				$('#current_shipment_table > tbody:last-child').append('<tr><td>' + result['warehouse'] + '</td><td>' + result['pallet'] + '</td><td>' + result['master'] + '</td><td>' + result['imei']+ '</td><td>-</td></tr>');

        		}
        		else{
        			alert_type = "alert-warning";
        		}

        		// $('<div class="row notification"><div class="col-md-8"></div><div class="alert alert-success col-md-4"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><span class="notification-msg">Some message </span></div></div>').insertAfter('.notification');
        		$.notify("Fuck yeah", "success");

    		}});
		
	}



});


$('.tree-toggle').click(function () {
	$(this).parent().children('ul.tree').toggle(200);
});

$(function() {
		$('.tree-toggle').parent().children('ul.tree').toggle(200);
		
});
