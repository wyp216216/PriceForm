$(function(){
	//建立表单函数
	$('.submit').click(function(){
		var sql_head = $('.sql_head').val();
		var sql_content = $('.sql_content').val();
		var s = sql_content.split(" ");
		var iden = new Array;
		for(var i=0;i<s.length;i++){
			if(s[i]!==''){
				iden.push(s[i]);
			}
		};
		
		if(sql_head!=="" && iden.length!==0 ){
			var iden_Str = iden.join(',');
			var sql = {'sql_head':sql_head,'sql_content':iden_Str};
			$.ajax({
				url:'php/newly.php',
				type:'POST',
				data:sql,
				success:function(e){
					
				}
			});
			$.ajax({
				url:'php/ind.json',
				type:'POST',
				dataType:'json',
				success:function(e){
					var con='';
					var e_arr = eval(e);
					con = $('<li role="presentation"><a href="#">'+sql_head+'</a></li>');
					$('.nav_left_con').append(con);
					$('.add_table').removeClass('display_block');
					console.log($('.nav_left_con li').length)
				}
			});
		}else{
			console.log("请正确输入！");
		};
	});
	
	
})
