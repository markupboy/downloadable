<?php 
	include('libs/markdown.php');
	
	$path = './files/'.$_GET['file']; 
	$dir_handle = @opendir($path) or die("Unable to open $path");
?>

<div class="container info">
	<h1 class="title"><?php echo urldecode($_GET['file']); ?></h1>
	<a class="button back" href="./">&times;</a>
	<div class="markdown">
		<?php echo markdown(file_get_contents("files/".$_GET['file']."/readme.markdown")); ?>
		<?php
			while ($file = readdir($dir_handle)) {
				if($file == "." || $file == ".." || $file == "readme.markdown" )
					continue;
				echo "<a href='$path/$file' class='download'><b></b> Download <strong>$file</strong></a>";
			} 
		?>
		
	</div>
</div>

<?php
	closedir($dir_handle);
?>
