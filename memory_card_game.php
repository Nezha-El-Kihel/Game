<?php session_start(); include("Connection/connection.php"); ?>
<?php
	//whether ip is from share internet
	if (!empty($_SERVER['HTTP_CLIENT_IP']))   
	  {
	    $ip_address = $_SERVER['HTTP_CLIENT_IP'];
	  }
	//whether ip is from proxy
	elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))  
	  {
	    $ip_address = $_SERVER['HTTP_X_FORWARDED_FOR'];
	  }
	//whether ip is from remote address
	else
	  {
	    $ip_address = $_SERVER['REMOTE_ADDR'];
	  }
	  $_SESSION['ip_address'] = $ip_address;
	// echo $ip_address;
?>
<?php
	$user_exist = $bdd->query('SELECT * FROM users_level where user_Ip_address = \''.$ip_address.'\'');
		//Return 1 if user exist in database
		$count_user = $user_exist->rowCount();
		if ($count_user == 0) {
			$addUser = 'INSERT INTO users_level(user_Ip_address) VALUES (\''.$ip_address.'\')';
			$new_user_create = $bdd->exec($addUser);
		}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>Memory Gard Game</title>
	<link rel="stylesheet" type="text/css" href="memory_card_game.css">
	<meta charset="utf-8">
	<meta http-equiv= x-ua-compatible content= ie=edge>
	<meta name= viewport content= width=device-width initial-scale=1>
	<link rel= stylesheet href= "https //maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<script src= "https //ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
	<script src= "https //maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
</head>
<body>
	<section class="menu">
		<h1>Memory Card Game</h1>
		<form id="levels" method="post">
		<input type="hidden" id="btnClickedValue" name="btnClickedValue" value="" />
			<ul>
				<?php 
					$user_info = $bdd->query('SELECT * FROM users_level where user_Ip_address = \''.$ip_address.'\'');
					while ($info = $user_info->fetch()) {
						$id = $info['id'];
						$user_level = $info['user_level'];
					}
					for ($level=1; $level < 11; $level++) { 
						?>
							<li>
								<span>Level <?php echo $level ?></span>
										<?php
											if($level <= $user_level) {
												?>
												<button name="submit_play_btn" class="play_btn" 
												id="<?php echo $level; $var = $level ?>">
												<i class="fa fa-forward"></i>
												<?php
											}
											else{
												?>
												<button name="submit_no_play_btn" class="play_btn"
												onclick="submit_no_play_btn()"
												id="<?php echo $level; $var = $level ?>">
												<i class="fa fa-lock"></i>
												<?php
											}
											?>
								</button>
							</li>
						<?php
					} 
					if(isset($_POST["submit_play_btn"])){
						$level_number = $_POST['btnClickedValue'];
						$_SESSION['level'] = $level_number;
						echo "<script>window.open('playIt.php?level=$level_number','_self');</script>";
					}
					if(isset($_POST["submit_no_play_btn"])){
						echo "<script>alert('This level is locked');</script>";
					}
				?>
			</ul>
		</form>
	</section>
	<script src="memory_card_game.js"></script>
</body>	
</html>