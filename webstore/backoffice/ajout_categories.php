


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
			  
							<!-- FORMULAIRE D'AJOUT D'ARTICLE -->
							<table>
			  				<form  method="post" enctype="multipart/form-data"> 
								<tr>
									<td><label>Nom catégorie : </label></td>
									<td><input name="nom" type="text" maxlength="90" /></td>							
								</tr>
								<tr>
									<td><label>Description : </label>	</td>						
									<td><textarea name="description" type="text" /></textarea></td>									
								</tr>	
								<tr>			
									<td>Ajout image: </td>
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
		&& isset ($_POST['description']) 
		&& isset($_FILES['files']) 		
		&& $_POST['nom'] != "" 
		&& $_POST['description']!= ""
		&& $_FILES['files'])

		{
		
		
		
		$nom = $_POST['nom'];
		$desc = $_POST['description'];
				    
		
			
			//INSERTION DES DONNES DANS LA BASE SI IMAGE//
			
			foreach($_FILES['files']['tmp_name'] as $key => $tmp_name ){
					$file_name = $key.$_FILES['files']['name'][$key];
					$file_size =$_FILES['files']['size'][$key];
					$file_tmp =$_FILES['files']['tmp_name'][$key];
					$file_type=$_FILES['files']['type'][$key];						
					if($file_size > 2097152){
					$errors[]='File size must be less than 2 MB';
					echo('fichier trop gros');
					}		
					$query="INSERT into categories (nomcat, desccat, image_cat) VALUES('$nom','$desc','$file_name'); ";
					$desired_dir="categories/".$nom;
					if(empty($errors)==true){
							if(is_dir($desired_dir)==false){
								mkdir("$desired_dir", 0700);		// Create directory if it does not exist
							}
							if(is_dir("$desired_dir/".$file_name)==false){
								move_uploaded_file($file_tmp,"categories/".$nom."/".$file_name);
							}
							else{									// rename the file if another one exist
								$new_dir="categories/".$nom."/".$file_name.time();
								 rename($file_tmp,$new_dir) ;				
							}
							//insère tuple "mysql_query"
							mysql_query($query) or die ('Erreur SQL!<br />'.mysql_error());
							}
					else{
							print_r($errors);
						}
					}
			
			echo '<br> La catégorie a été inséré.';
			
						
			//ferme connexion à la base
			mysql_close();
			
			//header('Location: ajout_categories.php'); 
			
			echo'Catégorie ajoutée!!';
			
		}
			
		else {
		
			}
			
						echo ' <p><br><br> LISTE DES CATEGORIES : </p>';
						include 'liste_cat.php';

			?>
							
			  </article>
		</section>
		
		<footer>
		Footer.
		</footer>
	 </div>
	</body>
</html>