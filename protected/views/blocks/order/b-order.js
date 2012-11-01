$(function(){
	$('body').on('click','.order__apply',function(){
		$.ajax({
			'type':'POST',
			'url':'/order',
			'cache':false,
			'data':$(this).parent().serialize(),
			'success':function(data){
				if(data.result == 'success'){
					$('.order__text').detach().insertBefore('.order__box form').html(data.msg);
					$('.order__box form').remove();
				}else{
					$('.order__text').detach().insertBefore('.order__apply').html(data.msg);
					$('.order__box input [name=name]').val(data.name);
					$('.order__box input [name=email]').val(data.email);
					$('.order__box input [name=phone]').val(data.phone);
				}
			},
			'dataType':'json'
		});
		return false;
	});
});