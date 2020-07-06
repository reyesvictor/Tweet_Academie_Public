$( document ).ready(function() 
{
    $('.search-newConversation-form').submit(function(e)
	{	
		e.preventDefault();
		let content = $('#search-conversation').val();
		if (content.length > 25)
		{
			alert("Pseudo introuvable (25 caractères max)");
        }
        else if (content.length < 3)
        {
            alert("Pseudo introuvable (3 caractères minimum)");
        }
		else
		{
			let data_send_newConversation = 
			{ 
				'pseudoUserToSearch' : $('#search-conversation').val(), 
			};
			let data_newConversation = data_send_newConversation;
			$.ajax({
				url: "../../handler/chat/searchConversation.php",
				method: "POST", 
				data: {data_newConversation},
				//dataType: 'json',
				success: function(data_newConversation) 
				{
					window.location.href = "conversation.php?chat="+content;
				}, error: function(jqXHR, exception) {
				handleAjaxError(jqXHR, exception);
				}
				});
		}
		  return false;
	});
});
