var timer;
var nav_head=function(){
	$.ajax({
		url:'php/field.json',
		type:'POST',
		dataType:'json',
		success:function(e){
			var e_arr = eval(e);
			var con = '';
			for(var i=0;i<e_arr.header.length;i++){
				con= "<th>"+e_arr.header[i]+"</th>"+con;
			}
			con = '<tr>'+con+'<th>删除/修改</th></tr>';
			$('.table>thead').html(con);
		}
	})	
};
var nav_left = function(){
	$.ajax({
		url:'php/ind.json',
		type:'POST',
		dataType:'json',
		success:function(e){
			var con='';
			var e_arr = eval(e);
			for(var i=0;i<e_arr.length;i++){
				con += '<li role="presentation"><a href="#">'+e_arr[i]+'</a></li>';
			}
			$('.nav_left_con').html(con);
		}
	});
};
var nav_con = function(){
	var con_url='tableData/'+$('.delete_name').text()+'.json';
	$.ajax({
	url:con_url,
	type:"POST",
	dataType:'json',
	success:function(e){
		if(e!==null){
			var con_e='';
			var e_arr=eval(e);
				for(var i=0;i<e_arr.length;i++){
					var con='';
					for(var j=0;j<e_arr[i].length;j++){
						con+='<td>'+e_arr[i][j]+'</td>';
					}
				con_e+='<tr>'+con+'<td><button class="btn btn-danger btn-xs delete_btn">删除</button></td></tr>';
				}
				$('.table>tbody').html(con_e);
			}else{
				$('.table>tbody').empty();
			}
		}
	})
};
$(function(){
	nav_left();
})
