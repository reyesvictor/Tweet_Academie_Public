function searchTagAndTweets(e, here=null) {
	if ( !here ) {
		verif = $('#search-content').val();
		e.preventDefault(); // Empêche l'événement 
		if ( verif == '') {
			alert('Type your search.'); 
			return false;
		}
		if ( verif.length > 140) {
			alert('Your search is too long.'); 
			return false;
		}
		verif = sqlClean(verif);
	} else {
		verif = here.innerHTML;
	}
	let data_newSearch = { 'content-search' : verif };
	$.ajax({ 
		url: "../../handler/tweet/getSearchTweet.php",
		method: "POST", 
		data: {data_newSearch},
		dataType: 'json',
		success: function(data_searchResult) 
		{
			console.log('Affichage de la Recherche');
			console.log(data_searchResult);
			$('#tweet').text('');
			$('#user_profile_information').text('');
			$('#feedtab_user').text('');
			displayAllTweets(data_searchResult);
			let storage_color = localStorage.getItem("color-theme");
			if (storage_color){
				changeColor(storage_color);
			}
			myOnClick(`.user-to-search`, setLocalProfile);

		}, error: function (jqXHR, exception){
			handleAjaxError(jqXHR, exception);
		}
		});
		return false;
}

$( document ).ready(function() 
{
	$('#search-content-form').submit(function(e)
	{	
		searchTagAndTweets(e);
	});
});
