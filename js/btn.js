$(function(){	
	//取消建立表单
	$('.cancel').one('click',function(){
		$('.add_table').removeClass('display_block');
		$('.table_warp *').remove();
	});
})