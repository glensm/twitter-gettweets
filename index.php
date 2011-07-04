<?php
/*
	Simple script to grab a users tweets
*/
	$twittername = "glensm";
	$amount = "50"; // up to 200
	$feed = 'http://api.twitter.com/1/statuses/user_timeline.json?count='.$amount.'&screen_name='.$twittername;

/* 
	Grab users tweets
*/

	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $feed);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	$json = curl_exec($ch);
	$headerdata = curl_getinfo($ch);
	curl_close($ch);
	
	// Make sure the correct http status is returned
	$headerresult = $headerdata['http_code'];
	switch ($headerresult) {
		case $headerresult == 200:
			$status = true;
			break;
		case $headerresult == 400:
			echo "<h3>That user doesn't exist.</h3>";
			$status = false;
			break;
		case $headerresult == 404:
			echo "<h3>That user doesn't exist.</h3>";
			$status = false;
			break;
		case $headerresult == 502:
			echo "<h3>Twitter network is overloaded, please refresh in a moment.</h3>";
			$status = false;
			break;
		default:
			$status = false;
			break;
	}
	if($status){
		// Put json into array
		$tweetfeed=json_decode($json,true);
			
		// Fulltweet is for the whole tweet.
		if($json == true){
			foreach($tweetfeed as $id =>$tweet){
				echo $tweet['text']."\n\n";
			}
		}
	}
?>