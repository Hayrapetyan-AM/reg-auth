<?php
		
		/**
		 * 
		 */
		class user
		{
			private $email;
			private $pass;
			function __construct($email, $password)
			{
				$this->email = $email;
				$this->pass = $password;
			}

			public function reg()
			{
				require('dbConn.php');
				$checkQuery = $db->prepare("SELECT `email` FROM `users` WHERE `email` = ?"); // подготавливаем запрос, который проверит есть ли в базе никнейм введеный с инпута.
		 		$checkQuery->execute([$this->email]); // подставляем значение инпута никнейм и выполняем запрос.
		 		$checkQuery = $checkQuery->fetch(PDO::FETCH_OBJ); //получаем значения. 

		 	  	if (empty($checkQuery)) // если запрос провалился
		 	  	{
					 	  	try 
					 	  	{
						 			$query = $db->prepare('INSERT INTO users(email, password) VALUES(?, ?)'); // подготавливаем запрос для записи в бд нового пользователя
						 			$query->execute([$this->email, $this->pass]); // подставляем данные и выполяем запрос
						 			self::verify();
						 			echo '<div class="alert alert-success m-auto container">Please Check you email. You need to verify yourself in 1 hour.</div>'; // вывод об успешной регистрации
					 		  }catch (PDOException $e)
					 		  {
								  echo '<div class="alert alert-danger m-auto container">ERROR! ' . $e->getMessage() . '</div>'; // сообщение ерор в случаи ошибки
								  die(); // завершение скрипта
					 			}
		 	  	}else echo '<div class="alert alert-danger container m-auto">ERROR: email already exists! </div>'; // сообщение ерора, что такой никнейм уже существует, поскольку запрос в переменной $checkQuery удался - сверху.
		 	  	die();
		 	  	header('Location:' . $_SERVER['PHP_SELF']); //редирек на самого себя, чтобы очистить будер пост
			}

			public function auth()
			{
				require('dbConn.php');
				try{
					$query = $db->prepare('SELECT * FROM `users` WHERE `email` = ?'); // подготавливаем запрос который выберет все значения связанные с введеным email
					$query->execute([$this->email]); // подсталяем никнейм и выполняем
					$user = $query->fetch(PDO::FETCH_OBJ); // получаем данные в виде объекта
				}catch(PDOException $e){
					echo "Error. " . $e->getMessage();
				}
				
				if ($user && password_verify($this->pass, $user->password)) // если запрос удался и есть пееменная $user, и если проверка на подлинность пароля в базе и пароля введенного удалась
				{	
							// session_start();
							// $_SESSION['email'] = $this->email;
							setcookie("user-email", $this->email,time()+3600);
							echo '<div class="alert alert-success m-auto container">Success!</div>'; // вывод об успешной авторизации
							header('Location: profil.php'); // редирект 
					
				}else echo '<div class="alert alert-danger m-auto container">ERROR: wrong password or email</div>'; // вывод ошибки
			}

			static function statusCheck($user_email)
			{	
					 require('dbConn.php');
				 	 try
				 	 {
				 	 	$statusQuery = $db->prepare('SELECT status FROM `users` WHERE `email` = ?');
					 	$statusQuery->execute([$user_email]);
					 	$statusQuery = $statusQuery->fetch(PDO::FETCH_OBJ);
				 	 }catch(PDOException $e)
				 	 {
				 	 	echo '<div class="alert alert-danger m-auto container">ERROR! ' . $e->getMessage() . '</div>';
				 	 }
					
					if ($statusQuery->status == "need2verify") {
						?>
						<form method="post">
							<div class="alert alert-danger m-auto container mt-5" style="width: 600px;">
						    <div class="row">
							 	<div class="col-md-5">
							 		<h6>You need to verify yourself!</h6>
							 	</div>

							 	<div class="col-lg-5">
							 		<input type="text" class="form-control" placeholder="verification code" name="verification_code">
							 	</div>

							 	<div class="col-lg-2">
							 		<button type="submit" class="form-control btn btn-danger" name="submit">Verify</button>
							 	</div>

							</div>
							</div>
						</form>
						<?
						if (isset($_POST['submit'])) 
						{
							if ($_POST['verification_code'] == $_COOKIE['verify']) 
							{
								try
							 	 {
							 	 	$query = $db->prepare("UPDATE users SET status = 'verified' WHERE email = ?");
									$query->execute([$user_email]);
									header("Location:" . $_SERVER['PHP_SELF']);
							 	 }catch(PDOException $e)
								 {
								 	echo '<div class="alert alert-danger m-auto container">ERROR! ' . $e->getMessage() . '</div>';
								 }
							}
						}
					}


					if ($statusQuery->status == "verified") 
					{
						
						echo '<div class="alert alert-success m-auto text-center mt-5 container">Success! Now you are verified</div>';
						
					}
					
			}

			public function verify()
			{
									
									$rand_nubmer = mt_rand(100000,999999);
									//$_SESSION['verification_code'] = $rand_nubmer;
									setcookie("verify", $rand_nubmer, time()+3600);
									$message = 	"Welcome. Copy this numbers and paste it into reg-verification form \n" . $rand_nubmer;
										
										$m = mail($this->email, 'Email verification', $message,'From: hayrapetyan2203@gmail.com');
			}
		}
?>
					