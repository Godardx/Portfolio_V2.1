<?php
$param = parse_ini_file('db.ini');

if(isset($_POST['email'])) {
    $mail=$_POST['email'];
} else {
	$mail="";
}

if(isset($_POST['name'])) {
    $pseudo=$_POST['name'];
} else {
    $pseudo="";
}

if(isset($_POST['message'])) {
    $msg=$_POST['message'];
} else {
    $msg="";
}


if (empty($mail)) {
		echo 'Tout les champs doivent être remplis';
    } else {
		
      try{
          $dbh = new PDO($param['url'], $param['user'], $param['pass']);
      }catch(PDOException $e){
          echo("Erreur de connexion");
          exit;
      }
      $query = "INSERT INTO message(mail, pseudo, msg) VALUES(?,?,?)";
      $sql = $dbh->prepare($query);
      $sql->execute([$mail,$pseudo,$msg]);
      $dbh = null;
      echo('Message envoyé !');
      exit;
  }

?>