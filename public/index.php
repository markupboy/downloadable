<?php 

$isAjax = !empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest';
		
if(!$isAjax) {	
	
?><!DOCTYPE html>
<!--[if lt IE 7 ]> <html class="ie ie6 lte8 lte7 lte6"> <![endif]-->
<!--[if IE 7 ]>    <html class="ie ie7 lte8 lte7"> <![endif]-->
<!--[if IE 8 ]>    <html class="ie ie8 lte8"> <![endif]-->
<!--[if !IE]><!--> <html> <!--<![endif]-->

<head>
	<title>Downloadable</title>
	
	<meta charset="utf-8">

	<link rel="stylesheet" href="stylesheets/screen.css" type="text/css" media="screen" />
</head>

<body data-file="<?php echo urlencode($_GET['file']); ?>" data-base="<?php echo str_replace('index.php', '', $_SERVER['PHP_SELF']) ?>">


<?php 

}

	if(isset($_GET['file'])) {
		include('download.php'); 
	}
	include('list.php'); 

if(!$isAjax) {

?>

<script src="javascripts/compiled/application.js" type="text/javascript" charset="utf-8"></script>


</body>

</html>

<?php } ?>