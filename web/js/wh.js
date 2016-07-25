
$('.glyphicon-plus').click(function() {

	if($(this).hasClass('plus_unlocked')){

		var table = $(this).attr("table_name");
		var id = $(this).attr("table_id");
		var _url = "/api/lock_element/" + table + "/" + id;

		$.ajax({
			url: _url,
			success: function(result)
			{
        		alert(result['was_locked_already']);
    		}});

		//$('#current_shipment_table > tbody:last-child').append('<tr><td>S</td><td>B</td><td>C</td><td>D</td><td>E</td></tr>');
		//$(this).addClass('locked').removeClass('plus_unlocked');
	}



});


$('.tree-toggle').click(function () {
	$(this).parent().children('ul.tree').toggle(200);
});

$(function() {
		$('.tree-toggle').parent().children('ul.tree').toggle(200);
		
});
