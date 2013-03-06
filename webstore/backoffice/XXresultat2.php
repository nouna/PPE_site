

<?php
	//connexion BDD //
	$base = mysql_connect('localhost', 'root', '');
	mysql_select_db('webstore', $base);

		/*$nom = $_POST['nom'];
		$titre = ;
		$desc = $_POST['description'];
		$desc2 = $_POST['descriptionbis'];
		$prix = $_POST['prix'] ;
		$qte = $_POST['qte'] ;
		$poids = $_POST['poids'];
		
		echo "Nom : " ; $nom ;
		echo "Titre : ". $titre; 
		echo " <br> Desc : ".$desc;
		echo " <br> Desc2 : ". $desc2;
		echo " <br> Prix : ". $prix ;
		echo " <br> Qte : ". $qte ;
		echo " <br> Poids : ". $poids;*/

		
		//teste si variables du formulaire st bien déclarées
		
		if (isset($_POST['nom']) 
		&& isset($_POST['titre']) 
		&& isset ($_POST['description']) 
		&& isset ($_POST['descriptionbis'])
		&& isset ($_POST['prix']) 
		&& isset ($_POST['qte'])
		&& isset ($_POST['poids'])
		&& isset($_FILES['files']) 		
		&& $nom != "" 
		&& $titre != "" 
		&& $desc!= "" 
		&& $desc2!= ""  
		&& $prix!= ""  
		&& $qte != "" 
		&& $poids != "")
		
		{
				    
			//insère le tuple "mysqlquery" 
			$sql='INSERT INTO produits (nomproduit, titreproduit, description_produit, cree_le , modifie_le , prixproduit, petite_description, quantite, poids_produit) 
			VALUES( "'.$nom.'" , "'.$titre.'" , "'.$desc.'", NOW() , NOW(),"'.$prix.'", "'.$desc2.'" ,"'.$qte.'","'.$poids.'")';
			

			mysql_query($sql) or die ('Erreur SQL!'.$sql.'<br />'.mysql_error());
			

			$test = mysql_insert_id();

			echo 'La variable test est: ' , $test, '   ' ;

			
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
					$desired_dir="produits/".$test;
					if(empty($errors)==true){
							if(is_dir($desired_dir)==false){
								mkdir("$desired_dir", 0700);		// Create directory if it does not exist
							}
							if(is_dir("$desired_dir/".$file_name)==false){
								move_uploaded_file($file_tmp,"produits/".$test."/".$file_name);
							}
							else{									// rename the file if another one exist
								$new_dir="produits/".$test."/".$file_name.time();
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
						
			//ferme connexion à la base
			mysql_close();
			
			//header('Location: liste.php'); 
			
		}
			
		else {

			echo 'Les variables ne sont pas déclarées';		
		
			}
		//AFFICHE LA LISTE DE TOUS LES PRODUITS
		include 'liste.php'; 
			
		
		?>
		

		