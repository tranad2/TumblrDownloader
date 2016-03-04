<!DOCTYPE html>
<html>
<link rel="stylesheet" href="w3.css">
<style>
.button {
  display: inline-block;
  border-radius: 10px;
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
  border-radius: 10px;
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
input[type=file]{
	float: left;
}
input[type=text]{
	margin-right:auto;
	margin-left: auto;
}
body{
	padding-top: 170px;
	background-image: url("Vintage Sky.png");
	background-size: cover;
	overflow: auto;
}
</style>
<head>
	<title>TumblrDownloader</title>
</head>

<body>
<div style="margin: 0 auto;">
	<div style="width:450px; margin: 0 auto;">
		<button class="button" style="vertical-align:middle"><span>TumblrDownloader</span></button>
	</div>

	<div style="width:800px; margin-right:auto; margin-left:auto;">
	  <div style="width:500px; padding-top: 20px; margin: 0 auto;">
	  <form action="back.php" method="post" enctype="multipart/form-data">
		<input type="text" placeholder="User" name="user_query" style="width: 100%; text-align:left;" required>
		<input type="text" placeholder="Filter" name="filter_query" style="width: 100%; text-align:left;">
		<div>
			<input type="text" placeholder="Width" name="width" style="width: 50%; text-align:left; float:left">
			<input type="text" placeholder="Height" name="height" style="width: 50%; text-align:left; float:right">
		</div>
		<div style="width:200px; margin-right:auto; margin-left:auto; padding-top: 20px;">
			<input type="submit" value="Submit">
		</div>
	  </form>
	  </div>
	</div>
</div>

</body>
</html>