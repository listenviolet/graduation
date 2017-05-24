<?php
	$folder = "moviedb/".$_GET["film"];
	$info = get_info($folder);
?>

<!DOCTYPE html>
<html>
	<head>
		<title>Rancid Tomatoes</title>
		<meta charset="utf-8" />
		<link href = "movie.css" type="text/css" rel="stylesheet"/>
	</head>

	<body>
		<a id = "back" href = "home.html"><img src="imges/goback.png" alt="Back" /></a>
		<div id = "banner">
			<img src="images/rancidbanner.png" alt = "Rancid Tomatoes" />
		</div>
		
		<h1><?= get_title($info) ?></h1>
	
		<div id="right-content">
			<div>
				<img src="<?= get_overview_image_path($folder) ?>" alt="general overview" />
			</div>
			<dl>
			<?php
				$overview = file ($folder."/overview.txt");
				foreach ($overview as string){
					$dtdd = explode (":",$string);					
			?>
					<dt><?= $dtdd[0]?></dt>
					<dd><?= $dtdd[1]?></dd>
				<?php }?>
			</dl>			
		</div>
		
		<div id="left-content">
			<div id="left-banner">	
				<img src="<?= get_overall_rating_image_path($info) ?>" alt="<?= get_overall_rating_image_alt($info) ?>" />
				<?=get_overll_rating($info) ?>%
			</div>
			
			<div id="left-column">
				<?php
					$files=glob($folder."/review*.txt");
					$n=count($files)-(int)(count($files)/2);
					$k=0;
					foreach($files as $file){
						if($k==$n){
					}
				?>
			</div>
		</div>
		
	</body>
</html>

<?php
function get_info($folder){
	return file($folder."/info.txt");
}

function get_title($info){  
	return $info[0]."(".$info[1].")";
}

function get_overview_image_path($folder){
	return $folder."/overview.png";
}

function get_overall_rating($info){
	return $info[2];	
}

function get_overall_rating_image_path($info){
	if(get_overall_rating($info)>=60)
		return "images/freshlarge.png";
	return "images/rottenlarge.png";
}

function get_overall_rating_image_alt($info){
	if(get_overall_rating($info)>=60)
		return "Fresh";
	return "Rotten";	
}
?>
