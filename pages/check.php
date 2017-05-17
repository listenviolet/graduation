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

    <meta name="description" content="check">
    <link href="../css/check_hw.css" rel="stylesheet">
    <script src="../js/check.js" type="text/javascript"></script>

</head>
<body>
	<?php if(isLoggedIn()): ?>
	<!-- Navigation -->
    <?php include("./share/navigator.php"); ?>

    <div class="main-part">
        <div class="container">
            <h2>Check Homework</h2>
            <div class="check-div" id="check-div">
            	<div class="col-lg-6">
        		    <div class="input-group">
        		        <input type="text" class="form-control" placeholder="Please enter the certification code..." id="check_input" >
        		        <span class="input-group-btn">
        		            <button class="btn btn-default" type="button" id="check">Check</button>
        		        </span>
        		    </div>
        		</div>
            </div>
        </div>  
        <hr>
        <div class="container">
            <div id="result" name="result" class="col-lg-6">
                <div class="input-group">
                    <input type="text" id="input_result" class="form-control" readonly="true" placeholder="Result...">
                    <span class="input-group-btn">
                        <input type="button" class="btn btn-success" name="download" id="download" value="Download" disabled>
                    </span>
                </div>
            </div>
        </div>
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