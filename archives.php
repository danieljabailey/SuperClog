<?php
	require("settings.php");
?>
<!DOCTYPE html>
<html>

<head>
	<title><?php echo $blogTitle; ?></title>
	<link rel="stylesheet" type="text/css" href="<?php echo $blogRoot; ?>styles.css" />
	<?php
	if ($GAEnabled){
		include("ga.php");
	}
	?>
</head>

<body class='clog_body'>

<div class='clog_title' >
<h1><?php echo $blogHead; ?></h1>
<a class="clog_toplink" href="<?php echo $blogRoot; ?>">Home</a>
<a class="clog_toplink" href="<?php echo $blogRoot; ?>archives.php">Archives</a>
<?php
if ($postmode == "show"){
	echo "<a class='clog_toplink' href='" . $blogRoot . "post.php'>Post</a>";
}
?>
</div>

<?php
	$lsin = file_get_contents(".lsout");
	$ls = explode("\n", $lsin);
	foreach($ls as $file) {
		if (preg_match('/^\./', $file)) continue;
		if ($file === "") continue;

		$post = file_get_contents("{$blogPosts}$file");
		$title = strtok($post, "\n");

		echo "<a class='clog_link' id='$file'>";
		echo "<div class='clog_post_div'>\n";
		if ($urlstyle == 'ugly'){
			echo "<a class='clog_title' href='{$blogRoot}viewpost.php?post=" . urlencode($file) . "'>$title</a>\n";
		}
		if ($urlstyle == 'fancy'){
			echo "<a class='clog_title' href='{$blogRoot}post/" . urlencode($file) . "'>$title</a>\n";
		}

		$date = date('d-m-Y H:i T', $file);
		echo "<span class='clog_date'>$date</span>\n";
		echo "</div>\n</a>\n\n";
	}
?>

</body>

</html>
