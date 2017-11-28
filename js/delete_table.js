$(function(){
	$('.submit').one('click',function(){
		var delete_name = $('.delete_name').text();
		var active = $('.delete_name').html();
		$.ajax({
			url:'php/delete_table.php',
			type:'POST',
			data:{'sheel':delete_name},
			success:function(e){
				$('.delete_name').remove();
				$('.add_table').removeClass('display_block');
			}
		})
	});
})
