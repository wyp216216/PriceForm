$(function(){
	var delete_name=$('.delete_name')
	$.ajax({
		url:'php/field.json',
		type:'POST',
		success:function(e){
			var e_arr = eval(e);
			var con = '';
			for(var i=0;i<e_arr.header.length;i++){
				con+='<div class="form-group"><label class="col-md-3 control-label"><p>'+e_arr.header[i]+'</p></label><div class="col-md-9"><input type="text" class="form-control sql_head" id="inputEmail3"></div></div>';
			}
			$('.modify_form').prepend(con);
		}
	})
})
$('.submit').click(function(){
	var sheel=$('.delete_name').text();
	var x = $('.sql_head').length;
	var x_val=[];
	for(var i=0;i<x;i++){
		x_val.push($('.sql_head').eq(i).val());
	}
	var write=x_val.join(',');
	$.ajax({
		url:'php/modify_table.php',
		type:'POST',
		data:{'sheel':sheel,'write':write},
		success:function(e){
			$('.add_table').removeClass('display_block');
			$('.table_warp *').remove();
			nav_con();
		}
	})
})
