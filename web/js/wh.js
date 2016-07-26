
var warehouse_destiny = "";
var transporter = "";

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
                $('.shipment-panel .panel-heading').text("Shipment panel  Current cost: " + result['current_cost']);
                $('.shipment-panel .panel-heading').val("Shipment panel  Current cost: " + result['current_cost']);


        		}
        		else{
        			alert_type = "error";
        		}

        		$.notify(result['msg'], alert_type);     	
        		

    		}});
		
	}



});



$(document).on('click', '.glyphicon-minus',function() {


	var _this = $(this);

	if(_this.hasClass('minus_unlocked')){

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

        			var unlock_this = result['unlock_this'];	
        			for (i = 0; i < unlock_this.length; i++) {
        				obj = unlock_this[i];
        				$("span.glyphicon-plus[table_name='" + obj['tableName']+"'][table_id='" + obj['tableId'] +  "']").addClass('plus_unlocked').removeClass('locked');

        			}

                    $('.shipment-panel .panel-heading').text("Shipment panel  Current cost: " + result['current_cost']);
                    $('.shipment-panel .panel-heading').val("Shipment panel  Current cost: " + result['current_cost']);

        			
        		}
        		else{
        			alert_type = "error";
        		}

        		$.notify(result['msg'], alert_type);     	
        		

    		}});

	}

});

$(".submit-btn").click(
            function(){

                if(transporter == "")
                    $.notify("Transporter not specified", "error");

                if(warehouse_destiny == "")
                    $.notify("Warehouse not specified", "error");

                else{

                var _url = '/api/submit/' + warehouse_destiny + '/' + transporter;

                $.ajax({
                    url: _url,
                    success: function(result)
                    {
                        
                        var alert_type = "success";
                        if(result['ok']){

                            $.notify(result['msg'], alert_type);

                            setTimeout(function(){ location.reload(); }, 2000);


                        }
                        else{
                            $.notify(result['msg'], "error");
                        }

                    }});



            }


            });



$('.tree-toggle').click(function () {
	$(this).parent().children('ul.tree').toggle(200);
});

$(function() {
		$('.tree-toggle').parent().children('ul.tree').toggle(200);

        $(".dropdown-menu li .wh_list_item").click(function(){

            $(".btn_wh_dropdown:first-child").text($(this).text());
            $(".btn_wh_dropdown:first-child").val($(this).text());
            warehouse_destiny = $(this).attr('wh_id');


            });

        $(".dropdown-menu li .tr_list_item").click(function(){

            $(".btn_tr_dropdown:first-child").text($(this).text());
            $(".btn_tr_dropdown:first-child").val($(this).text());

            transporter = $(this).attr('tr_id');

            });
		
});
