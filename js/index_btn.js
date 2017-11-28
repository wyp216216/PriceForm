$(function(){
		//建立表单
	var table_warp=function(warp,html){
		$('.add_table').addClass('display_block');
		$.post(html,function(data){
			$(warp).html(data);
		});
	};
	var table_object = [
			{
				'class':'.create',
				'warp':'.table_warp',
				'html':'add_table.html'
				},
			{
				'class':'.mod_table',
				'warp':'.table_warp',
				'html':'modify_table.html'
			},
			{
				'class':'.delete_table',
				'warp':'.table_warp',
				'html':'delete_table.html'
			}
		];
	function create(obj){
			$(obj.class).on('click',function(){
				table_warp(obj.warp,obj.html);
			});
	};
	create(table_object[0]);
	create(table_object[1]);
	create(table_object[2]);
	
		//左侧按钮
	$('.nav_left_con').on('click','li',function(){
		$(this).siblings().removeClass('active');
		$(this).siblings().removeClass('delete_name');
		$(this).addClass('active');
		$(this).addClass('delete_name');
		var t = $(this).text();
		$.ajax({
			url:'php/nav_btn.php',
			type:'POST',
			data:{'sheel':t},
			success:function(e){
				nav_head();
				nav_con();
			}
		})
	});

	$('.table').on('click','.delete_btn',function(){
		var sheel = $('.delete_name').text();
		console.log(sheel);
		var keyword = $('.table>thead th').eq(0).text();
		var data = $(this).parent().parent().children().eq(0).text();
		$(this).parent().parent().remove();
		$.ajax({
			url:'php/delete_data.php',
			type:'POST',
			data:{'sheel':sheel,'keyword':keyword,'data':data},
			success:function(e){
				console.log(e);
			}
		})
	})

})
