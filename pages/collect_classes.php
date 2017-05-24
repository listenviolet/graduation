<?php
	session_start(); 
	$username=$_SESSION['username'];
	function isLoggedIn(){
		if(isset($_SESSION['username'])){
			return ture;
		}
		else{
			return false;
		}
	}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Collect Homeworks</title>

    <!--link and script-->
    <?php include("./share/lib.html"); ?>

    <meta name="description" content="collect choose a class">
    <link href="../css/collect_classes.css" rel="stylesheet">
    <script src="../js/collect_class.js" type="text/javascript"></script>
    
</head>
<body>
	<?php if(isLoggedIn()): ?>
	<!-- Navigation -->
    <?php include("./share/navigator.php"); ?>

    <div class="collect-class">
	    <div class="container">
			<h2>Choose Class:</h2>
			<form id="collectclassForm" action="collect_hw.php" method="post" enctype="multipart/form-data">
				<div id="collect_class">
				</div>
			</form>
			<button class="btn btn-default"><a href="./set_collect.php"><i class="glyphicon glyphicon-backward"></i> Go Back To Operations</button>
		</div>
	</div>
    <!--Footer-->
	<?php include("./share/footer.html");?>

    <!-- jQuery -->
    <script src="../js/lib/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="../js/lib/bootstrap.min.js"></script>



	<?php else:?>
	<script type="text/javascript">
		window.location.href="./login.html";
	</script>
	<?php endif; ?>
</body>
</html>