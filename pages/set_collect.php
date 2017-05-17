<?php
	session_start();
	$username=$_SESSION['username'];
    $userid=$_SESSION['userid'];
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

	<title>Operations</title>

    <!--link and script-->
    <?php include("./share/lib.html"); ?>

    <meta name="description" content="set_collect">
    <link href="../css/set_collect.css" rel="stylesheet">

</head>
<body>
	<?php if(isLoggedIn()): ?>
	<!-- Navigation -->
    <?php include("./share/navigator.php"); ?>

	<!-- Header -->
    <a name="about"></a>
    <div class="intro-header">
        <div class="container">

            <div class="row">
                <div class="col-lg-12">
                    <div class="intro-message">
                 
                        <br>
                        <ul class="list-inline intro-social-buttons">
                            <li>
                                <a href="./setup_classes.php" class="btn btn-default btn-lg"><i class='glyphicon glyphicon-cog'></i>
                                <span class="network-name">Set Up Classes</span></a>
                            </li>
                            <li>
                                <a href="./collect_classes.php" class="btn btn-default btn-lg"><i class='glyphicon glyphicon-download-alt'></i>
                                <span class="network-name">Collect Homework</span></a>
                            </li>  
                            <li>
                                <a href="./check.php" class="btn btn-default btn-lg"><i class='glyphicon glyphicon-check'></i>
                                <span class="network-name">Check</span></a>
                            </li>            
                        </ul>
                    </div>
                </div>
            </div>

        </div>
        <!-- /.container -->

    </div>

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