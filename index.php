<?php

if(! empty($_FILES['folder']))
{
	// echo '<pre>';
	// var_dump($_FILES['folder']);
	

	// foreach($_FILES['folder']['full_path'] as $path){
	// 	echo '<pre>';
	// 	var_dump($path);
	// }
	// exit;
	
	$i = 0;

	foreach($_FILES['folder']['name'] as $name)
	{
		if(getimagesize($_FILES['folder']['tmp_name'][$i])){
			$full_path = $_FILES['folder']['full_path'][$i];
			
			$directory = substr($full_path, 0, strrpos($full_path, '/'));
			
			@mkdir('uploads/'.$directory, 0755, true);

			move_uploaded_file($_FILES['folder']['tmp_name'][$i], 'uploads/'.$full_path);
		}

		$i++;
	}
	
	$errors = array_unique($_FILES['folder']['error']);

	if(count($errors) == 1 && $errors[0] == 0){
		$success = 'Upload terminé!';
	}
}

?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<!-- Required meta tags -->
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<title>Upload Directory</title>

		<!-- Bootstrap CSS -->
		<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">

		<style>
			#container{margin-top: 75px;}
		</style>
	</head>
	<body>
		
		<div class="container" id="container">

			<?php if(! empty($success)):?>
				<div class="alert alert-success"><?=$success;?></div>
			<?php endif;?>

			<form action="index.php" method="post" enctype="multipart/form-data">
				<div class="form-group">
				  <label for="folder">Upload un dossier</label>
				  <input type="file" name="folder[]" class="form-control-file" webkitdirectory multiple>
				</div>

				<div class="form-group">
					<button type="submit" class="btn btn-primary">Upload</button>
				</div>
			</form>
		</div>

</body>
</html>