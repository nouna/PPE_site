
<?php

//connexion BDD //
	$base = mysql_connect('localhost', 'root', '');
	mysql_select_db('webstore', $base);

				
				$sql2 = "SELECT * FROM produits ";
		
				$requete2 = mysql_query($sql2, $base) or die ('Erreur SQL!<br />'.mysql_error());
							
				
				while ($result2 = mysql_fetch_object($requete2) ) 
				{ 

				echo "ID produit:".$result2->id . "<br>" ;
				echo "Nom produit:".$result2->nomproduit  ;
				echo"<br> CATEGORIES POUR CE PRODUIT <br>";
				
							//////REQUETE SQL IMBRIQUEE POUR TROUVER LES CATEGORIES
							
							$sql3 = "SELECT * FROM produits, produits_vers_cat, categories WHERE  produits_vers_cat.Produits_id=produits.id AND produits_vers_cat.categories_id=categories.id AND Produits.id = $result2->id ";
					
							$requete3 = mysql_query($sql3, $base) or die ('Erreur SQL!<br />'.mysql_error());
										
							
							while ($result3 = mysql_fetch_object($requete3) ) 
							{ 

							echo "Nom cat:".$result3->nomcat. "<br> <br>" ;

									
				}
									
				}
	mysql_close();
						
						?>