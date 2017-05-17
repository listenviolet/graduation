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
	<title>Classes</title>

	<!--link and script-->
    <?php include("./share/lib.html"); ?>

    <meta name="description" content="student classes list">

    <link href="../css/stu_classes.css" rel="stylesheet">

    <script src="../js/stu_classes.js" type="text/javascript"></script>
    
</head>

<body>
	<?php if(isLoggedIn()): ?>
	<!-- Navigation -->
    <?php include("./share/navigator.php"); ?>

    <div class="main-part">
    	<div class="container">
			<h1>Student Classes</h1>
				<div id="stu_classes" class="container">
				</div>
				
				<div>
					 <button class="btn btn-default"><a href="#"><i class="glyphicon glyphicon-backward"></i> Go Back To Operations</button>
				</div>
			</form>
		</div>
	</div>

	<!-- Footer -->
    <?php include("./share/footer.html");?>

   <!-- jQuery -->
    <script src="../js/lib/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="../js/lib/bootstrap.min.js"></script>


	<?php else:?>
	<script type="text/javascript">
		window.location.href="../login/login.html";
	</script>
	<?php endif; ?>

</body>
</html>

