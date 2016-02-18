<body>
	<!-- navbar -->
	<div class="navbar navbar-default navbar-static-top" role="navigation">
		<div class="container">
			
			<div class="navbar-header">
				<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				</button>
				<a class="navbar-brand" href="index.php">Home</a>
			</div>
			
			<div class="navbar-collapse collapse">
				<ul class="nav navbar-nav">

					<li>
						<a href="control.php">Control-Panel</a>
					</li>


					<li class="active">
						<a href="bilder.php">Bilder</a>
					</li>

					<li>
						<a href="graph.php">Trend</a>
					</li>
<!--
					<li>
						<a href="#">Contact</a>
					</li>
-->


<?php
if($_SESSION['logged_in']==true){


					echo '<li><b>Hallo '.$_SESSION['loginname'].'</b><br>';

					echo '<a href="?logout=1">Abmelden</a></li>';

}

?>
				</ul>
			</div><!--/.nav-collapse -->
			
		</div>
	</div>
	<!-- /navbar -->