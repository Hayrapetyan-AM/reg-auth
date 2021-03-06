 <!DOCTYPE html>
 <html lang="en">
 <head>
 	<meta charset="UTF-8">
 	<meta name="viewport" content="width=device-width, initial-scale=1.0">
 	<title>Welcome <?=$_COOKIE['user-email'] ?></title>
 	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css">
 </head>
 <body class="bg-dark text-white">
<?php 
		require_once __DIR__.("/classes/user.php");
		
		if (isset($_COOKIE['user-email'])) 
        {
            user::statusCheck($_COOKIE['user-email']);
        }else
        {
           echo '<div class="alert alert-danger m-auto container mt-5">ERROR! Please sign in again</div>'; 
           //exit();
        }
?>
 </body>
 <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"></script>
 </html>