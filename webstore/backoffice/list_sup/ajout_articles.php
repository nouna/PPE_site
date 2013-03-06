

<!doctype html>
<html lang="fr">

<?php
	//connexion BDD //
	$base = mysql_connect('localhost', 'root', '');
	mysql_select_db('webstore', $base);
?>
		<head>
		  <meta http-equiv="Content Type" content="text/html; charset= iso-8859-1">
		  <title>Gadgets de Geek</title>
		  <link rel="stylesheet" href="style.css">
		  <script src="script.js"></script>
		  
		   <!-- Including the Lobster font from Google's Font Directory -->
        <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Lobster" />

        <!-- Enabling HTML5 support for Internet Explorer -->

        <!--[if lt IE 9]>

          <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>

        <![endif]-->

		</head>
	
	<body>
	
	<div class="content">
		<header>
		
			<div id="page">
			<h1 id="header"> </h1>
			</div>

		</header>
		

		<section>
			  <article>			  
			  
			  <?php 
			$sql = "SELECT * FROM categories ORDER BY id ";
		
			$requete = mysql_query($sql, $base) or die ( "ERREUR SQL" .mysql_errno()."<br> type erreur:".mysql.error()."<br>\n");
		
			  ?>
			  
							<!-- FORMULAIRE D'AJOUT D'ARTICLE -->
							<table>
			  				<form  method="post" enctype="multipart/form-data"> 
								<tr>
									<td><label>Nom : </label></td>
									<td><input name="nom" type="text" maxlength="90" /></td>							
								</tr>
								<tr>
									<td><label>Titre : </label>	</td>						
									<td><input name="titre" type="text" maxlength="90" /></td>									
								</tr>	
								<tr>
									<td><label>Description : </label></td>
									<td><textarea type='text' name="description"></textarea></td>
								</tr>
								<tr>
									<td><label>Description courte: </label></td>
									<td><textarea type='text' name="descriptionbis"></textarea></td>
								</tr>
								<tr>
									<td><label>Prix : </label></td>
									<td><input name="prix" type="text" maxlength="20" /></td>							
								</tr>			
								<tr>
									<td><label>Quantité en stock: </label></td>
									<td><input name="qte" type="text" maxlength="20" /></td>
								</tr>
								<tr>
									<td><label>Poids d'un article: </label></td>
									<td><input name="poids" type="text" maxlength="20" /></td>
								</tr>
								<tr>
									<td><label>Catégories de l'article: </label></td>
									
									
									<td>
									
									<?php while ($result = mysql_fetch_object($requete) ) { 

									echo ( "<input type='checkbox' name='catcheck[]' value='$result->id'> $result->nomcat" );
									
									}
									?>
									
									</td>
								</tr>
								<tr>			
									<td>Ajout images: </td>
									<td><input type="file" name="files[]" multiple/></td>
								</tr>						
								<tr><td colspan="100%"><input type = "submit" value="valider"></td></tr>
							</form>
							</table>
							
							<br>
							<br>
							<br>
							
							<?php 
							
		if (isset($_POST['nom']) 
		&& isset($_POST['titre']) 
		&& isset ($_POST['description']) 
		&& isset ($_POST['descriptionbis'])
		&& isset ($_POST['prix']) 
		&& isset ($_POST['qte'])
		&& isset ($_POST['poids'])
		&& isset($_FILES['files']) 	
		&&isset($_POST['catcheck'])		
		&& $_POST['nom'] != "" 
		&& $_POST['titre'] != "" 
		&& $_POST['description']!= "" 
		&& $_POST['descriptionbis']!= ""  
		&& $_POST['prix']!= ""  
		&& $_POST['qte'] != "" 
		&& $_POST['poids'] != "")
		
		{
		
		$nom = $_POST['nom'];
		$titre = $_POST['titre'];
		$desc = $_POST['description'];
		$desc2 = $_POST['descriptionbis'];
		$prix = $_POST['prix'] ;
		$qte = $_POST['qte'] ;
		$poids = $_POST['poids'];
				    
			//insère le tuple "mysqlquery" 
			$sql='INSERT INTO produits (nomproduit, titreproduit, description_produit, cree_le , modifie_le , prixproduit, petite_description, quantite, poids_produit) 
			VALUES( "'.$nom.'" , "'.$titre.'" , "'.$desc.'", NOW() , NOW(),"'.$prix.'", "'.$desc2.'" ,"'.$qte.'","'.$poids.'")';
			

			mysql_query($sql) or die ('Erreur SQL!'.$sql.'<br />'.mysql_error());
			

			$test = mysql_insert_id();

			echo 'L id test est de: ' , $test, '   ' ;

			
			//INSERTION DES IMAGES//
			
			foreach($_FILES['files']['tmp_name'] as $key => $tmp_name ){
					$file_name = $key.$_FILES['files']['name'][$key];
					$file_size =$_FILES['files']['size'][$key];
					$file_tmp =$_FILES['files']['tmp_name'][$key];
					$file_type=$_FILES['files']['type'][$key];						
					if($file_size > 2097152){
					$errors[]='File size must be less than 2 MB';
					echo('fichier trop gros');
					}		
					$query="INSERT into images (Produits_ID, FILE_NAME, FILE_SIZE, FILE_TYPE) VALUES('$test', '$file_name','$file_size','$file_type'); ";
					$desired_dir="../produits/".$test;
					if(empty($errors)==true){
							if(is_dir($desired_dir)==false){
								mkdir("$desired_dir", 0700);		// Create directory if it does not exist
							}
							if(is_dir("$desired_dir/".$file_name)==false){
								move_uploaded_file($file_tmp,"../produits/".$test."/".$file_name);
							}
							else{									// rename the file if another one exist
								$new_dir="../produits/".$test."/".$file_name.time();
								 rename($file_tmp,$new_dir) ;				
							}
							//insère tuple "mysql_query"
							mysql_query($query) or die ('Erreur SQL!<br />'.mysql_error());
							}
					else{
							print_r($errors);
						}
					}
			
			echo '<br> Le produit a été inséré.';
			
			/////////AJOUT CAT ///
			for ($i=0;$i<sizeof($_POST['catcheck']);$i++) {
				
		 
				$numcat = $_POST['catcheck'][$i];	
				
				$query = "INSERT INTO produits_vers_cat (Produits_id, categories_id) VALUES ( '$test' , '$numcat' )";
				$result = mysql_query($query, $base)  or die('Erreur SQL ! '.$query.'<br/>'.mysql_error());
			 
				echo "numéro de cat :".$numcat ;
				
			 
				}
			
			
			
						
			//ferme connexion à la base
			mysql_close();
			
			//header('Location: ajout_articles.php'); 
			
		}
			
		else {

			//echo 'Les variables ne sont pas déclarées';		
		
			}
			
						include 'liste.php';

			?>
							
			  </article>
		</section>
		
		<footer>
		Footer.
		</footer>
	 </div>
	</body>
</html>