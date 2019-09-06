<?php 
		session_start();

 ?>

<html>
<head>
	<title>Start</title>
	<link rel="stylesheet" type="text/css" href="./css/base.css">
</head>
<body>
	<video autoplay loop muted>
		<source src="./static/video.mp4"></source>
	</video>
	<header>
		<!-- <video autoplay muted loop>
			<source src="video.mp4" type="video/mp4"></source>
		</video> -->
		<h1>Web Munshi</h1>
		<p>Your personal Money recorder book</p>
		<div class="anchor">
			<?php if(isset($_SESSION["logged_in"]) && !empty($_SESSION["user_id"])) { ?>
				<a href="./user/expense.php">Go to profile...</a>
			<?php } else { ?>
				<a href="./login.php">Start Using...</a>
			<?php } ?>
		</div>
	</header>

	<article>
		<section id="expense">
			<div><img style="width: 900px; height: 590px;" src="./static/expense.png"></div>

			<div id="expense_div">
				<span style="font-size: 2em; font-weight: bold;">E</span>xpense deparment handles your daily basis expense record. So just type in your daily money output
				and forget your tension of remembering.
			</div>
		</section>
		<br><br>
		<section id="income">
			<div id="income_div">
				<span style="font-size: 2em; font-weight: bold;">I</span>ncome deparment does the same as expense department. Only difference being in money input record
				it saves.
			</div>
			<div><img style="height: 600px;" src="./static/record_img.png"></div>
		</section>
	</article>
	<!-- <br><br> -->
	<!-- <div class="divider"></div> -->
	<article>
		<section id="desc">
			Web Munshi is a personal money recorder of expense and income. One can free register into this site
			and jump right into it to record his money exchanges. Not only this site provides record system of daily
			basis. Also provides monthly basis report of both income and expense. Which may help you understand your
			monthly budget and focus on savings more than ever. So If you don't have an account here, what are you waiting for 
			then? Register now. 
			<?php if(!isset($_SESSION["logged_in"])) { ?>
				<a href="register.php">Click here</a>
			<?php } ?>
		</section>
	</article>
	<!-- <br><br> -->
	<footer>
		<p>www.projectmunshi.com</p>
	</footer>
</body>
</html>