﻿<!-- FONCTION POUR COCHER TOUTES LES CASES-->
<script> function cocherTout(etat)
{
  var cases = document.getElementsByTagName('input');   // on recupere tous les INPUT
   for(var i=1; i<cases.length; i++)     // on les parcourt
     if(cases[i].type == 'checkbox')     // si on a une checkbox...
         {cases[i].checked = etat;}
             // ... on la coche ou non
 
 
}
</script>

<?php

//FONCTIONS UTILISEES SUR LA PAGE//
//fonction pour vider un dossier
function deltree($dossier){
        if(($dir=opendir($dossier))===false)
            return;
 
        while($name=readdir($dir)){
            if($name==='.' or $name==='..')
                continue;
            $full_name=$dossier.'/'.$name;
 
            if(is_dir($full_name))
                deltree($full_name);
            else unlink($full_name);
            }
 
        closedir($dir);
		}


				
// connexion BDD //
	$base = mysql_connect('localhost', 'root', '');
	mysql_select_db('webstore', $base);

//////////////////////

  ////////////////////////
// AFFICHAGE DU TABLEAU //
 ///////////////////////
 
 //répétion de tous les produits ࠡfficher

		$sql = "SELECT * FROM produits ORDER BY id ";
		
		$requete = mysql_query($sql, $base) or die ( "ERREUR SQL" .mysql_errno()."<br> type erreur:".mysql.error()."<br>\n");
		
		
		// DEBUT du FORMULAIRE
		echo '<form method="POST" >';
	
	//1ères colonnes de titres
		echo( "<table border=\"1\" cellpadding=\"1\" align=\"center\">\n");
		echo( "<tr>
		<td><div align=\"center\">ID</div></td>
		<td><div align=\"center\">Nom</div></td>
		<td><div align=\"center\">Titre</div></td>
		<td><div align=\"center\">Description</div></td>
		<td><div align=\"center\">Petite Description</div></td>
		<td><div align=\"center\">Prix</div></td>
		<td><div align=\"center\">Quantité<div></td>
		<td><div align=\"center\">Poids</div></td>
		<td><div align=\"center\">Catégories</div></td>

		<td><div align=\"center\">Images</div></td>
		<td width='40'><div align=\"center\"><input type='checkbox' onclick='cocherTout(this.checked);' /> </div></td>
		</tr>");
		
	//colonnes suivantes: boucle de répétion affichant chaque article a la suite dans le tableau
		while ($result = mysql_fetch_object($requete) )
		{
		echo ("<tr>\n");
		echo ( "<td><div align=\"center\">".$result->id."</div></td>\n" );
		echo ( "<td><div align=\"center\">".$result->nomproduit."</div></td>\n" );
		echo ( "<td><div align=\"center\">".$result->titreproduit."</div></td>\n" );
		echo ( "<td><div align=\"center\">".$result->description_produit."</div></td>\n" );
		echo ( "<td><div align=\"center\">".$result->petite_description."</div></td>\n" );
		echo ( "<td><div align=\"center\">".$result->prixproduit."</div></td>\n" );
		echo ( "<td><div align=\"center\">".$result->quantite."</div></td>\n" );
		echo ( "<td><div align=\"center\">".$result->poids_produit."</div></td>\n" );
		
				echo ( "<td><div align=\"center\">"); 
				
				$sql3 = "SELECT * FROM produits, produits_vers_cat, categories WHERE  produits_vers_cat.Produits_id=produits.id AND produits_vers_cat.categories_id=categories.id AND Produits.id = $result->id ";
					
							$requete3 = mysql_query($sql3, $base) or die ('Erreur SQL!<br />'.mysql_error());
										
							
							while ($result3 = mysql_fetch_object($requete3) ) 
							{ 

							echo $result3->nomcat. "<br> <br>" ;
							}

		
		echo ( "<td>");
		
		////////AFFICHAGE DES IMAGES dans la colonne corespondant à l'article
				// url du fichier qui contient les images  
				$urlphoto = "../produits/". $result->id . "/";  

				// nom du répertoire qui contient les images  
				$nomRepertoire = "../produits/". $result->id . "/";  
				if (is_dir($nomRepertoire)) 
				   { 
				   $dossier = opendir($nomRepertoire); 
				   while ($Fichier = readdir($dossier))  
					   {  
					  if ($Fichier != "." AND $Fichier != ".." AND (stristr($Fichier,'.gif') OR stristr($Fichier,'.jpg') OR stristr($Fichier,'.png') OR stristr($Fichier,'.bmp'))) 
						{  
						// Hauteur de toutes les images  
						$h_vign = "50";  
						$taille = getimagesize($nomRepertoire."/".$Fichier);  
						$reduc  = floor(($h_vign*100)/($taille[1]));  
						$l_vign = floor(($taille[0]*$reduc)/100);  
					   
						  echo '<a target="_blank" href="', $urlphoto, '/',$Fichier, '">'; 
						  echo '<img src="', $urlphoto, '/',$Fichier, '" ';  
						  echo "width='$l_vign' height='$h_vign'>";  
						  echo "</a>&nbsp;";  
						  } 
						}     
				   closedir($dossier);  
				   }else{ 
				   echo' Le répertoire spécifié n\'existe pas'; 
				   } 
		echo ( "</td>\n" );
		// checkbox pour supprimer/modifier l'article
		echo"<td><input type='checkbox' name='champ[]' value='".$result->id."'></td></tr>";
		}
		
						
		echo("<tr><td colspan='100%'><input type='submit' value='Supprimer'></td></tr></table>\n");
		
		echo '</form>';
		// FIN du FORMULAIRE

	
	
/* ------------------DECLENCHEUR CASE A COCHER ------------------ */

 
if (isset($_POST['champ'])) 

	{
		echo '<div align="center"><font face="arial" size="4" color="red">Vous avez supprimé </font></div> ';
	 
			for ($i=0;$i<sizeof($_POST['champ']);$i++) {
		 
				$numero_produit = $_POST['champ'][$i];	
				
				$query = "DELETE FROM produits WHERE produits.id='".$numero_produit."'";
				$result = mysql_query($query, $base)  or die('Erreur SQL ! '.$query.'<br/>'.mysql_error());
			 
				echo 'produits/'.$numero_produit ;
				
				//suppression des photos dans le dossier:
				deltree('produits/'.$numero_produit) ;
				//suppression du dossier
				rmdir('produits/'.$numero_produit) ; 
			 
				}
		//rafraichissement de la page une fois la suppression termin饍
		header('Location: ajout_articles.php'); 

	}


	?>
	
