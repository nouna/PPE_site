<!DOCTYPE html>
<html>
	<head>
		<meta charset="iso8859-1"/>
	<script> function cocherTout(etat)
{
  var cases = document.getElementsByTagName('input');   // on recupere tous les INPUT
   for(var i=1; i<cases.length; i++)     // on les parcourt
     if(cases[i].type == 'checkbox')     // si on a une checkbox...
         {cases[i].checked = etat;}
             // ... on la coche ou non
 
 
}
</script>
</head>
<?php

//FONCTIONS UTILISEES SUR LA PAGE//
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
 
 //récupération de tous les produits à afficher

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
		<td><div align=\"center\">Quantité</div></td>
		<td><div align=\"center\">Poids</div></td>
		<td><div align=\"center\">Images</div></td>
		<td><div align=\"center\"><input type='checkbox' onclick='cocherTout(this.checked);' /> </div></td>
		</tr>");
		
	//colonnes suivantes: boucle de récupération affichant chaque article à la suite dans le tableau
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
		echo ( "<td>");
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
		echo"<td><input type='checkbox' name='champ[]' value='".$result->id."'></td>";
		}
						
		echo("</table>\n");
		
		echo '
				 <input type="submit" value="test">
				</form>';
		// FIN du FORMULAIRE

	
	
/* ------------------DECLENCHEUR CASE A COCHER ------------------ */

 
if (isset($_POST['champ'])) 

	{
		echo '<div align="center"><font face="arial" size="4" color="red">Vous avez supprimé : </font></div> ';
	 
			for ($i=0;$i<sizeof($_POST['champ']);$i++) {
		 
				$numero_produit = $_POST['champ'][$i];	
				
				$query = "DELETE FROM produits WHERE produits.id='".$numero_produit."'";
				$result = mysql_query($query, $base)  or die('Erreur SQL ! '.$query.'<br/>'.mysql_error());
			 
				echo '../produits/'.$numero_produit ;
				
				//suppression des photos dans le dossier:
				deltree('../produits/'.$numero_produit) ;
				//suppression du dossier
				rmdir('../produits/'.$numero_produit) ; 
			 
				}
		//rafraichissement de la page une fois la suppression terminée
		header('Location: liste.php'); 

	}


	?>
	
	</html>
