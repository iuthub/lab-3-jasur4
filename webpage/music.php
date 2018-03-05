<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN"
 "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<title>Music Viewer</title>
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
		<link href="viewer.css" type="text/css" rel="stylesheet" />
	</head>
	<body>
		<div id="header">

			<h1>190M Music Playlist Viewer</h1>
			<h2>Search Through Your Playlists and Music</h2>
		</div>


		<div id="listarea">
			<ul id="musiclist">

				<?php
				if(isset($_REQUEST["playlist"])){
				$playlist=$_REQUEST["playlist"];
				@fopen("songs/$playlist", "r") OR die("failed to open");
				foreach (file("songs/$playlist") as $count) {
					?>
					<li class="mp3item"><a href="songs/<?=basename($count) ?>"><?= basename($count); ?></a></li>
				<?php	
				}
				}
				else
				{ 
					$songs = glob("songs/*.mp3");
					foreach ($songs as $songsfile) {
				
				 ?>

				 <li class="mp3item"><a href="songs/<?=basename($songsfile) ?>"><?= basename($songsfile)."  "?></a>
				 	<?php
				 	$size = filesize($songsfile);
				 	if($size > 0 && $size <= 1023)
				 		echo "(".$size." b)";
				 	elseif ($size > 1023 && $size <= 1048575)
				 		echo "(".round($size/1024, 2)." kb)";
				 	elseif ($size > 1048575)
				 		echo "(".round($size/1048576, 2)." mb)";
				 	?>
				 </li>
				<?php
			}
			?>
			<?php 
					$songs = glob("songs/*.txt");
					foreach ($songs as $textfile) {
				
				 ?>
				 <li class="playlistitem"><a href="songs/<?=basename($textfile) ?>"><?= basename($textfile); ?></a></li>
				<?php
			}}
			?>
			</ul>
		</div>
	</body>
</html>
