<!DOCTYPE html>
<html>
<style>

.button {
  display: inline-block;
  border-radius: 4px;
  background-color: #529ECC;
  border: none;
  color: #FFFFFF;
  text-align: center;
  font-size: 28px;
  padding: 20px;
  width: 100%;
  transition: all 0.5s;
  cursor: pointer;
  margin: 5px;
}
.button span {
  cursor: pointer;
  display: inline-block;
  position: relative;
  transition: 0.5s;
}

.button span:after {
  content: 'Alpha';
  position: absolute;
  opacity: 0;
  top: 0;
  right: -70px;
  transition: 0.5s;
}

.button:hover span {
  padding-right: 80px;
}

.button:hover span:after {
  opacity: 1;
  right: 0;
}

input[type=submit] {
  display: inline-block;
  border-radius: 4px;
  background-color: #529ECC;
  border: none;
  color: #FFFFFF;
  text-align: center;
  font-size: 28px;
  padding: 10px;
  width: 200px;
  transition: all 0.5s;
  cursor: pointer;
  min-width: 200px;
}

input[type=submit]:hover{
  background-color: #197AB6;

}

body{
	padding-top: 170px;
	background-image: url("Vintage Sky.png");
	background-size: cover;
	overflow: auto;
}
</style>

<body>
<div style="width:450px; margin: 0 auto;">
		<button class="button" style="vertical-align:middle"><span>TumblrDownloader</span></button>
</div>

<?php

require "tumblr.php-master/vendor/autoload.php";

//String parsing
$str_array = array();
$target_user = $_POST['user_query'];
$target_filter = $_POST['filter_query'];
$trimmed = trim($target_filter);
$token = strtok($trimmed, ",");
if(isset($_POST['width']) && ""!=trim($_POST['width'])){

	$width_query = $_POST['width'];
}
else
	$width_query = null;

if(isset($_POST['height']) && ""!=trim($_POST['height'])){

	$height_query = $_POST['height'];
}
else
	$height_query = null;


if(isset($_POST['filter_query'])){
	$i = 0;
	while($token != false){
		$str_array[$i] = $token;
		//echo "Word=$token<br>";
		$token = strtok(",");
		$token = trim($token);
		$i++;
	}

}
// Authenticate via OAuth
$client = new Tumblr\API\Client(
  '9HoS8ZGbMmPI78YYCsLfoGPEvxS2CR66CsI8po7KwOY6kzbJYI',
  'vcidPJzSzqRA10DDntPpJHIwZwtaofS6VmhfbyP1DuJZQoTLXS',
  'g90OVznchXKdhjIsLtrDhnyMB9Kq9WK2rVwcO434izE8FATdoK',
  'gmB0Z5UYW1KsRue8KbABRxTbdwwjrugCF2kSyaaO2XxCvASSaX'
);

$limit = 50;
$feedURL = 'http://';
$feedURL = $feedURL . $target_user;
$query = array();

if(isset($_POST['filter_query']) && $_POST['filter_query']!=""){
	foreach($str_array as $str){
		$feedURL .= '.tumblr.com/api/read/?start=0&num='.$limit.'&tagged='.$str;
		$xml = simplexml_load_file($feedURL);

		$query = array();
		
		//Store images into array
		foreach($xml->posts->post as $post){
			if(strlen((string)$post->{'photo-url'})>0){
			   $capt = (string) $post->{'photo-caption'}; 
			   $img = (string) $post->{'photo-url'};
			   list($width, $height) = getimagesize($img);
			   
			   $post_arr = array($capt,$img,$width,$height,$str);
			   array_push($query,$post_arr);
		   }
		}
		
		$f_arr = array();
		
		foreach($query as $filter){
			
			if($width_query!=null && $filter[2]<$width_query && $height_query!=null && $filter[3]<$height_query){
				array_push($f_arr, $filter);
			}
			else if($width_query!=null && $filter[2]<$width_query && $height_query==null){
				array_push($f_arr,$filter);
			}
			else if($height_query!=null && $filter[3]<$height_query && $width_query==null){
				array_push($f_arr,$filter);
			}
			else if($width_query==null && $height_query==null){
				array_push($f_arr,$filter);
			}
		}
		
		
		
		echo	
				"<table border='1' style='width:100%; background-color:#FFFFFF;'>
				<tr>
					<th>Caption</th>
					<th>Image</th>
					<th>Width</th>
					<th>Height</th>
					<th>Tag</th>
				</tr>
				";
		//Display images
		foreach($f_arr as $arr){
			
			echo
			"
			<tr>
			<td style='text-align:center;word-wrap:break-word; max-width:200px;'>".$arr[0]."</td>";
			echo "
			<td style='text-align:center;'>
				<a href='".$arr[1]."'download='myimage'><img style='width:50px;' src='".$arr[1]."'/></a>
			</td>
			<td style='text-align:center;'>".$arr[2]."</td>
			<td style='text-align:center;'>".$arr[3]."</td>
			<td style='text-align:center;'>".$arr[4]."</td>
			</tr>
			";
			
		}
		echo "</table>";
	}
}
else{

	$feedURL .= '.tumblr.com/api/read/?start=0&num='.$limit;
	$xml = simplexml_load_file($feedURL);
	$j = 0;
	$query = array();
	
	//Store images into array
	foreach($xml->posts->post as $post){
		if(strlen((string)$post->{'photo-url'})>0){
		   $capt = (string) $post->{'photo-caption'}; 
		   $img = (string) $post->{'photo-url'};
		   list($width, $height) = getimagesize($img);
		   
		   $post_arr = array($capt,$img,$width,$height);
		   array_push($query,$post_arr);
	   }
	}
	
	$f_arr = array();
	
	foreach($query as $filter){

		if($width_query!=null && $filter[2]<$width_query && $height_query!=null && $filter[3]<$height_query){
			array_push($f_arr, $filter);
		}
		else if($width_query!=null && $filter[2]<$width_query && $height_query==null){
			array_push($f_arr,$filter);
		}
		else if($height_query!=null && $filter[3]<$height_query && $width_query==null){
			array_push($f_arr,$filter);
		}
		else if($width_query==null && $height_query==null){

			array_push($f_arr,$filter);
		}
	}
	
	
	
	echo	
			"<table border='1' style='width:100%; background-color:#FFFFFF'>
			<tr>
				<th>Caption</th>
				<th>Image</th>
				<th>Width</th>
				<th>Height</th>
			</tr>
			";
	//Display images
	foreach($f_arr as $arr){
		
		echo
		"
		<tr>
		<td style='text-align:center;word-wrap:break-word; max-width:200px;'>".$arr[0]."</td>";
		echo "
		<td style='text-align:center;'>
			<a href='".$arr[1]."'download='myimage'><img style='width:50px;' src='".$arr[1]."'/></a>
		</td>
		<td style='text-align:center;'>".$arr[2]."</td>
		<td style='text-align:center;'>".$arr[3]."</td>
		</tr>
		";
		
	}
	echo "</table>";
}
?>
</body>
</html>