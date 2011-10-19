<?php 
	$path = './files/'; 
	$dir_handle = @opendir($path) or die("Unable to open $path");
?>
<div class="container <?php if(isset($_GET['file'])) { ?>hide<?php } ?>" id="files">
	<h1 class="title">Downloadable</h1>
	<ul class="files">
		<?php
			while ($file = readdir($dir_handle)) {
				if($file == "." || $file == ".." || $file == "index.php" )
					continue;
				echo "<li><a href='".urlencode($file)."'>$file</a></li>";
			} 
		?>
	</ul>
</div>
<?php
	closedir($dir_handle);
?>