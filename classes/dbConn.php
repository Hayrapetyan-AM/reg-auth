<?php
				  try{
					  $db = new PDO('mysql:host=sql6.freemysqlhosting.net;dbname=sql6460015', 'sql6460015', 'WFINDrcMbi');
					  $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
					}catch (PDOException $e) {
					  print "Error!: " . $e->getMessage();
					  die();
					}
?>