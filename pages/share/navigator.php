<nav class="navbar navbar-default navbar-fixed-top topnav" role="navigation">
    <div class="container topnav">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand topnav" href="#">Homework Collecting System</a>
        </div>
        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav navbar-right">
                <li>
                    <a href="#about">About</a>
                </li>
                <li>
                    <a href="#services">Services</a>
                </li>
                <li>
                    <a href="#contact">Contact</a>
                </li>
                <li class="dropdown">
                	<a href="#selfinfo" class="dropdown-toggle" data-toggle="dropdown">Hi, <?= $_SESSION['username']?>
                    <b class="caret"></b>   
                    </a>

                    <ul class="dropdown-menu">
                        <li><a href="#"><i class="glyphicon glyphicon-cog"></i>  Settings</a></li>
                        <li class="divider"></li>
                        <li><a href="../php/sign_out.php"><i class="glyphicon glyphicon-log-out"></i>  Sign out</a></li>
                    </ul>
                </li>
            </ul>
        </div>
        <!-- /.navbar-collapse -->
    </div>
    <!-- /.container -->
</nav>