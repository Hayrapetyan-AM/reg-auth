<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Lab-3</title>
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css">
</head>
<body class="bg-dark text-white">
<?php 
		
		if (!isset($_GET['show']) || $_GET['show'] == "Sign-up") 
		{
			require_once __DIR__ . ('/includes/signup.php');
		}

		if ($_GET['show'] == "Sign-in") 
		{
			require_once __DIR__ . ('/includes/signin.php');
		}
?>
</body>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"></script>
</html>