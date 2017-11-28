(function(){
	$.ajax({
		url:'php/load.php',
		type:'POST',
		success:function(e){
			if(e!==false&&e!==""){
				window.location.href='index.html';
				console.log(e);
			}
		}
	})
}());
$(function(){
	
	$('.btn').click(function(){
		var username = $('input[type=username]').val();
		var passname = $('input[type=password]').val();
		$.ajax({
			url:'php/login.php',
			type:'POST',
			data:{'username':username,'password':passname},
			success:function(e){
				if(e==true){
					window.location.href='index.html';
					console.log(e);
				}else{
					console.log('请正确输入！'+e);
					console.log(typeof(e))
				}
			}
			
		})
	})
})