$( document ).ready(function() 
{
	myKeyUp('#newTweet-content', cibler);

	function cibler(e, here) {		
		verif = $('#newTweet-content').val();
		console.log(e);
		if ( verif.match(/@/) ) { //all matches erif.match(/@[a-zA-Z]/g)
			arr = verif.split(' ');
			for (let i = 0; i < arr.length; i++) {
				if ( arr[i].charAt(0) == '@' ) {
					console.log(arr[i]);
					displayAt(arr[i]);
				} 
			}
		} else {
			$(`#cibler-list`).remove();
		}
	}

	function displayAt(cib) {
		window.cib = cib;
		ajaxGet("../../handler/tweet/getUsername.php", cib).then( list => {
			if ( !list || list.length == 0 ) { 
				$(`#cibler-list`).remove(); //supprier le menu si personne a été choisie
				return;
			} 
			let cib_list = '';
			for (let i = 0; i < list.length; i++) {
				console.log(list[i]);
				cib_list = cib_list.concat(`<li><a class='color-theme username_tweet_opt'>${list[i]['username']}</a></li>`);
			}
			
			div = `<span id='cibler-list'>
			<ul>${cib_list}<ul>
			<span>`;

			//Affichage dynamique
			$(`#cibler-list`).remove(); //supprier le menu si personne a été choisie
			$(`#newTweet-content`).after(div);
			myOnClick('.username_tweet_opt', autoFill);
			let storage_color = localStorage.getItem("color-theme");
			if (storage_color){
				changeColor(storage_color);
			}
		})
	}

	function autoFill(e, here) {
		console.log('marche autofiller');
		$(`#cibler-list`).remove(); //supprier le menu si personne a été choisie

		cursorPos = $('#newTweet-content').prop('selectionStart');
    var v = $('#newTweet-content').val();
    var textBefore = v.substring(0,  cursorPos);
    var textAfter  = v.substring(cursorPos, v.length);
		$('#newTweet-content').val(textBefore + here.innerHTML + textAfter);
		
		// val = here.innerHTML;
		// old = $('#newTweet-content').val();
		// newval = old.replace(window.cib, `@${val}`);
		// $('#newTweet-content').val(newval);
	}
});

