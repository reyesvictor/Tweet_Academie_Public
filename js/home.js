$(document).ready(function () {
	getAllTweetForHome();
	createTweet(); //Important, create a tweet
	let storage_color = localStorage.getItem("color-theme");

	//GET AND SHOW ALL TWEETS BY ID ORDER
	function getAllTweetForHome() {
		ajaxGet('../../handler/tweet/getHomeTweet.php', 'all').then(all_tweets_for_home => {
			console.log('all tweets ever', all_tweets_for_home)
			$('#tweet').text('');
			displayAllTweets(all_tweets_for_home);
			if (storage_color) {
				changeColor(storage_color);
			}
		}).catch(err => console.log(err))
	}
})	