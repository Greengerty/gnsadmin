function confirmItemDelete() 
{
    if (confirm("Вы подтверждаете удаление?")) {
        return true;
    } else {
        return false;
    }
}

function onoff(obj, module, id) 
{
	$.post( module, {})
	.done(function( data ) {
		if(data == 1){
			$(obj).find('i').removeClass('no-active');
			$(obj).find('i').addClass('active');
		}
		else{
			$(obj).find('i').removeClass('active');
			$(obj).find('i').addClass('no-active');
		}
  	});
}