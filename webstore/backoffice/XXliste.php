<!DOCTYPE html>
<html>
	<head>
		<meta charset="iso8859-1"/>
	</head>

<?php
	//connexion base
	$base = mysql_connect('localhost', 'root', '');
	mysql_select_db('webstore', $base);

		$sql = "SELECT * FROM produits ORDER BY id ";
		
		$requete = mysql_query($sql, $base) or die ( "ERREUR SQL" .mysql_errno()."<br> type erreur:".mysql.error()."<br>\n");
		
		//récup avec mysql fetch object et affichage:
		
		//formulaire DEBUT
		echo '<form method="POST" action="checkbox.php">';

		
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
		<td><div align=\"center\">Supression</div></td>


		</tr>");
		
		
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
				$urlphoto = "produits/". $result->id . "/";  

				// nom du répertoire qui contient les images  
				$nomRepertoire = "produits/". $result->id . "/";  
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
		
		echo"<td><input type='checkbox' name='champ[]' value='".$result->id."'></td>";
		

		

		}
						
		echo("</table>\n");
		
		//formulaire FIN
		echo '
				 <input type="submit" value="test">
				</form>';
	?>
	
	</html>
