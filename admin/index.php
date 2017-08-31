<?php 
$db = new PDO("mysql:host=localhost;dbname=commerce;charset=utf8","root","");

if(!empty($_POST)){
    $nom = htmlspecialchars($_POST['nom']);
    $rue = htmlspecialchars($_POST['rue']);
    $cp = htmlspecialchars($_POST['cp']);
    $ville = htmlspecialchars($_POST['ville']);
    $pays = htmlspecialchars($_POST['pays']);
    $phone = htmlspecialchars($_POST['phone']);
    $fix = htmlspecialchars($_POST['fix']);
    $mail = htmlspecialchars($_POST['mail']);
    $cat = htmlspecialchars($_POST['cat']);
    $icons = htmlspecialchars($_POST['icons']);
    $desmarqueur = htmlspecialchars($_POST['desmarqueur']);
    $des = htmlspecialchars($_POST['des']);
				
  if(!empty($nom) AND !empty($rue) AND !empty($cp) AND !empty($ville) AND !empty($pays) AND !empty($phone) AND !empty($fix) AND !empty($mail) AND !empty($cat)AND !empty($icons)AND !empty($desmarqueur) AND !empty($des))
  {
    $prepare = $db->prepare("INSERT INTO commerce(nom, rue, cp, ville, pays, phone, fix, mail, cat, icons, desmarqueur, des) VALUES(?,?,?,?,?,?,?,?,?,?,?,?)");
    $prepare->execute([$nom, $rue, $cp, $ville, $pays, $phone, $fix, $mail, $cat, $icons, $desmarqueur, $des]);
   
  }
}

?> 

<html>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<body>
      <h1>Bienvenue  !!!</h1>
      <h2>Entrez le commerce ici  :</h2>
      <center>
        <form method="post">
          <div class="form-group">
            <label for="nom">Nom:</label><input type="text" class="form-control mx-sm-3" name="nom" placeholder="nom" id="nom" width="50" ><br>
            
            <div class="form-group">
 									<label for="nom">nom</label><input type="text" name="nom" placeholder="nom" id="nom" class="form-control">
						</div>
						<div class="form-group">
 									<label for="rue">rue</label><input type="text" name="rue" placeholder="rue" id="rue" class="form-control">
						</div>
            <div class="form-group">
 									<label for="cp">cp</label><input type="text" name="cp" placeholder="cp" id="cp" class="form-control">
						</div>
             <div class="form-group">
 									<label for="ville">ville</label><input type="text" name="ville" placeholder="ville" id="ville" class="form-control">
						</div>
             <div class="form-group">
 									<label for="pays">pays</label><input type="text" name="pays" placeholder="pays" id="pays" class="form-control">
						</div>    
            <div class="form-group">
 									<label for="phone">phone</label><input type="text" name="phone" placeholder="phone" id="phone" class="form-control">
						</div> 
             <div class="form-group">
 									<label for="fix">fix</label><input type="text" name="fix" placeholder="fix" id="fix" class="form-control">
						</div>   
            <div class="form-group">
 									<label for="mail">mail</label><input type="text" name="mail" placeholder="mail" id="mail" class="form-control">
						</div>   
            <div class="form-group">
 									<label for="cat">cat</label><input type="text" name="cat" placeholder="cat" id="cat" class="form-control">
						</div> 
            <div class="form-group">
 									<label for="icons">icons</label><input type="text" name="icons" placeholder="icons" id="icons" class="form-control">
						</div>
            <div class="form-group">
 									<label for="desmarqueur">desmarqueur</label><input type="text" name="desmarqueur" placeholder="desmarqueur" id="desmarqueur" class="form-control">
						</div>
            <div class="form-group">
 									<label for="des">des</label><input type="text" name="des" placeholder="des" id="des" class="form-control">
						</div>
            
          </div>

            <input type="submit" value="Valider">
        </form>
      </center>
  <style>
    .echovert
{
color: green;
}
  </style>
</body>