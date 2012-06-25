<!DOCTYPE html>
<?php
//CONFIG:
$yourname = 'Lisandro Lorea';
//Your name
$userid = '1165389';
//Your Dropbox user id, ie. what follows https://dl.dropbox.com/u/
$folder_name = 'Portfolio';
//The name of your autofolio folder inside Dropbox/public/
?>
<html>
	<head>
		<title>Autofolio</title>
	</head>
	<body style="background: #222222">
		<h1 style="color: #e2a540; border-bottom: solid 1px #e2a540"><?= $yourname ?> - Portfolio</h1>
		<div>
		<?php
		$file = fopen("https://dl.dropbox.com/u/$userid/$folder_name/dir.txt", "r") or exit("Unable to open file!");
		//Open directory listing generated with batch script
		$cur_file = '';		//Read each line of the directory listing
		while (!feof($file)) {
			$cur_file = fgets($file); //get next line
			$cur_file = strstr($cur_file, $folder_name . '\\');	//drop everything in the path before $folder_name
			$cur_file = str_replace("\\", "/", $cur_file);		//replace windows '\' with unix '/'
			$cur_file = str_replace(" ", "%20", $cur_file);		//and spaces with the correspondent htmlentity
			$cur_file = preg_replace("/[^[:alnum:][:punct:]]/","",$cur_file); 	//remove windows CRLF
			echo "<img src='https://dl.dropbox.com/u/$userid/" . $cur_file . "' style='height: 200px; padding: 5px' onMouseOver=\"this.style.cssText='height: 500px'\" onMouseOut=\"this.style.cssText='height: 200px'\" />&nbsp;";
		}
		fclose($file);
		?>
		</div>
	</body>
</html>