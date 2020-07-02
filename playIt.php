<?php session_start();
 include("Connection/connection.php"); 
if (!isset($_SESSION['level'])) {
	header("Location:memory_card_game.php");
}
else{
	$level = $_SESSION['level'];
	$ip_address = $_SESSION['ip_address'];
	$level_img_upload = $bdd->query('SELECT * FROM levels_img where id = \''.$level.'\'');
		while ($levels_img_row = $level_img_upload->fetch()) {
			$back_img = $levels_img_row['back_img'];
			$img1 = $levels_img_row['img1'];
			$img2 = $levels_img_row['img2'];
			$img3 = $levels_img_row['img3'];
			$img4 = $levels_img_row['img4'];
			$img5 = $levels_img_row['img5'];
			$img6 = $levels_img_row['img6'];
			$img7 = $levels_img_row['img7'];
			$img8 = $levels_img_row['img8'];
	}
	$level_img_upload->closeCursor();
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
	<embed src="level_sound/sound_1.mp3" loop="true" autostart="true" width="2"
         height="0">
 	<div class="gameContainer" id="animals_card">
		<div class="memoryCard" data-image="image_1">
			<img src="<?php echo($img1) ?>" class="front" alt="image_1">
			<img src="<?php echo($back_img) ?>" class="back" alt="image">
		</div>
		<div class="memoryCard" data-image="image_1">
			<img src="<?php echo($img1) ?>" class="front" alt="image_1">
			<img src="<?php echo($back_img) ?>" class="back" alt="image">
		</div>
		<div class="memoryCard" data-image="image_2">
			<img src="<?php echo($img2) ?>" class="front" alt="image_2">
			<img src="<?php echo($back_img) ?>" class="back" alt="image">
		</div>
		<div class="memoryCard" data-image="image_2">
			<img src="<?php echo($img2) ?>" class="front" alt="image_2">
			<img src="<?php echo($back_img) ?>" class="back" alt="image">
		</div>
		<div class="memoryCard" data-image="image_3">
			<img src="<?php echo($img3) ?>" class="front" alt="image_3">
			<img src="<?php echo($back_img) ?>" class="back" alt="image">
		</div>
		<div class="memoryCard" data-image="image_3">
			<img src="<?php echo($img3) ?>" class="front" alt="image_3">
			<img src="<?php echo($back_img) ?>" class="back" alt="image">
		</div>
		<div class="memoryCard" data-image="image_4">
			<img src="<?php echo($img4) ?>" class="front" alt="image_4">
			<img src="<?php echo($back_img) ?>" class="back" alt="image">
		</div>
		<div class="memoryCard" data-image="image_4">
			<img src="<?php echo($img4) ?>" class="front" alt="image_4">
			<img src="<?php echo($back_img) ?>" class="back" alt="image">
		</div>
		<div class="memoryCard" data-image="image_5">
			<img src="<?php echo($img5) ?>" class="front" alt="image_5">
			<img src="<?php echo($back_img) ?>" class="back" alt="image">
		</div>
		<div class="memoryCard" data-image="image_5">
			<img src="<?php echo($img5) ?>" class="front" alt="image_5">
			<img src="<?php echo($back_img) ?>" class="back" alt="image">
		</div>
		<div class="memoryCard" data-image="image_6">
			<img src="<?php echo($img6) ?>" class="front" alt="image_6">
			<img src="<?php echo($back_img) ?>" class="back" alt="image">
		</div>
		<div class="memoryCard" data-image="image_6">
			<img src="<?php echo($img6) ?>" class="front" alt="image_6">
			<img src="<?php echo($back_img) ?>" class="back" alt="image">
		</div>
		<div class="memoryCard" data-image="image_7">
			<img src="<?php echo($img7) ?>" class="front" alt="image_7">
			<img src="<?php echo($back_img) ?>" class="back" alt="image">
		</div>
		<div class="memoryCard" data-image="image_7">
			<img src="<?php echo($img7) ?>" class="front" alt="image_7">
			<img src="<?php echo($back_img) ?>" class="back" alt="image">
		</div>
		<div class="memoryCard" data-image="image_8">
			<img src="<?php echo($img8) ?>" class="front" alt="image_8">
			<img src="<?php echo($back_img) ?>" class="back" alt="image">
		</div>
		<div class="memoryCard" data-image="image_8">
			<img src="<?php echo($img8) ?>" class="front" alt="image_8">
			<img src="<?php echo($back_img) ?>" class="back" alt="image">
		</div>
	</div>

	<form id="popup1" class="overlay" method="post">
        <div class="popup">
            <h2 id="h2"><!-- wen or loss --></h2>
            <a class="close" href=# >×</a>
        <div class="content-1">
      	<!-- wen or loss -->
        </div>
            <div class="content-2">
                <p>You made <span id=finalMove> </span> moves </p>
                <p>Score <span id=score> </span> </p>
                <p>in <span id=totalTime> </span> </p>
            </div>
            <div class="btn_box">
              	<button id="menu" onclick="menu()" class="btn" name="menu_btn">
                    <a>Menu</a>
               	</button>
               	<button id="play_again" onclick="playAgain()" class="btn">
                    <a>Play again</a>
               	</button>
               	<button id="next" onclick="nextLevel()" class="btn" name="next_level_btn">
                    <a>Next level</a>
               	</button>
            </div>
        </div>
    </form>
    <?php
    	if(isset($_POST["next_level_btn"])){
    		$next_level_yes_no = $bdd->query('SELECT * FROM users_level where user_Ip_address = \''.$ip_address.'\'');
    		while ($previous_level = $next_level_yes_no->fetch()) {
    			$previous = $previous_level['user_level'];
    		}
    		$next = $level + 1;
    		// echo "<script>alert('$previous');</script>";
    		// echo "<script>alert('$level');</script>";
    		// echo "<script>alert('$next');</script>";
    		if ($previous == $level) {
    			$bdd->exec('UPDATE users_level SET user_level = \''.$next.'\' where user_Ip_address = \''.$ip_address.'\'');
    			$_SESSION['level'] = $next;
				echo "<script>window.open('playIt.php?level=$next','_self');</script>";
    		}
    		else if ($previous > $level){
    			$_SESSION['level'] = $next;
				echo "<script>window.open('playIt.php?level=$next','_self');</script>";
    		}
		}
		if (isset($_POST["menu_btn"])) {
			echo "<script>window.open('memory_card_game.php','_self');</script>";
		}
    ?>
	<script src="memory_card_game.js"></script>
</body>
</html>