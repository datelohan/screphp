<?php 
require_once 'vendor/autoload.php';
use Abraham\TwitterOAuth\TwitterOAuth;

function scrapeTwitter($username, $numTweets) {
    $consumerKey = 'xqnYRejRR5jhoesYLJTrUdXP1';
    $consumerSecret = 'PyuGFFiCP0cEA7qsMjEC5ceRPq1PIaUGxngySXUb2snJ3MSxoS';
    $accessToken = '1596726740713447424-Y7joG9WVuoUuM2F08GK5qBumbRd0ID';
    $accessTokenSecret = 'MHAbrS3jcpmklXuLoo5lf6KA0ifCDSS1XSKrDv1Uhe2Y3';

    $connection = new TwitterOAuth($consumerKey, $consumerSecret, $accessToken, $accessTokenSecret);
    $statuses = $connection->get("statuses/user_timeline", ["screen_name" => $username, "count" => $numTweets]);

    $tweets = [];

    foreach ($statuses as $status) {
        $tweet = new stdClass();
        $tweet->text = $status->text;
        $tweet->timestamp = $status->created_at;
        $tweets[] = $tweet;
    }

    return $tweets;
}
$username = "xetdaspromocoes";
$numTweets = 1;
$tweets = scrapeTwitter($username, $numTweets);

foreach ($tweets as $tweet) {
    echo "Tweet: " . $tweet->text . "\n";
    echo "Timestamp: " . $tweet->timestamp . "\n\n";
}


?>