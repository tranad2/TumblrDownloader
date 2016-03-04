<?php


require "tumblr.php-master/vendor/autoload.php";

// Authenticate via OAuth
$client = new Tumblr\API\Client(
  '9HoS8ZGbMmPI78YYCsLfoGPEvxS2CR66CsI8po7KwOY6kzbJYI',
  'vcidPJzSzqRA10DDntPpJHIwZwtaofS6VmhfbyP1DuJZQoTLXS',
  'g90OVznchXKdhjIsLtrDhnyMB9Kq9WK2rVwcO434izE8FATdoK',
  'gmB0Z5UYW1KsRue8KbABRxTbdwwjrugCF2kSyaaO2XxCvASSaX'
);

// Make the request
/*
foreach ($client->getUserInfo()->user->blogs as $blog) {
    echo $blog->name . "\n<br>";
	echo $blog->posts . "\n<br>";

	echo $blog->description . "\n<br>";
	foreach($blog->posts as $post){
		
	}
}
*/
//test
$user = 
$feedURL = 'http://ohtheastrocity.tumblr.com/api/read/';
$xml = simplexml_load_file($feedURL);

foreach($xml->posts->post as $post){
   $posts = (string) $post->{'photo-caption'}; 
   $img = (string) $post->{'photo-url'};
   echo
	"<div style='width:518px;height:300px;'>
		<div style='width:200px;height:200px;float:left;'>".'<img style="width:200px;height:200px;" src="' . $img . '" />'."
		</div><div style='width:300px;float:right;'>".$posts."</div>
	</div><br>"
   ;
}
?>