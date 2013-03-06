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
 
 //répétion de tous les categories ?fficher

		$sql = "SELECT * FROM categories ORDER BY id ";
		
		$requete = mysql_query($sql, $base) or die ( "ERREUR SQL" .mysql_errno()."<br> type erreur:".mysql.error()."<br>\n");
		
		
		// DEBUT du FORMULAIRE
		echo '<form method="POST" >';
	
	//1ères colonnes de titres
		echo( "<table border=\"1\" cellpadding=\"1\" align=\"center\">\n");
		echo( "<tr>
		<td><div align=\"center\">ID</div></td>
		<td><div align=\"center\">Nom</div></td>
		<td><div align=\"center\">Description</div></td>
		
		<td><div align=\"center\">Images</div></td>
		<td width='40'><div align=\"center\"><input type='checkbox' onclick='cocherTout(this.checked);' /> </div></td>
		</tr>");
		
	//colonnes suivantes: boucle de répétion affichant chaque article ?a suite dans le tableau
		while ($result = mysql_fetch_object($requete) )
		{
		echo ("<tr>\n");
		echo ( "<td><div align=\"center\">".$result->id."</div></td>\n" );
		echo ( "<td><div align=\"center\">".$result->nomcat."</div></td>\n" );
		echo ( "<td><div align=\"center\">".$result->desccat."</div></td>\n" );
		echo ( "<td>");
				// url du fichier qui contient les images  
				$urlphoto = "categories/". $result->nomcat . "/";  

				// nom du répertoire qui contient les images  
				$nomRepertoire = "categories/". $result->nomcat . "/";  
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
		echo"<td><input type='checkbox' name='supp[]' value='".$result->id."'></td></tr>";
		}
		
						
		echo("<tr><td colspan='100%'><input type='submit' value='Supprimer'></td></tr></table>\n");
		
		echo '</form>';
		// FIN du FORMULAIRE

	
	
/* ------------------DECLENCHEUR CASE A COCHER ------------------ */

 
if (isset($_POST['supp'])) 

	{
		echo '<div align="center"><font face="arial" size="4" color="red">Vous avez supprimé </font></div> ';
	 
			for ($i=0;$i<sizeof($_POST['supp']);$i++) {
		 
				$numero_produit = $_POST['supp'][$i];	
				
				$query = "DELETE FROM categories WHERE categories.id='".$numero_produit."'";
				$result = mysql_query($query, $base)  or die('Erreur SQL ! '.$query.'<br/>'.mysql_error());
			 
				echo 'categories/'.$numero_produit ;
				
				//suppression des photos dans le dossier:
				deltree('categories/'.$numero_produit) ;
				//suppression du dossier
				rmdir('categories/'.$numero_produit) ; 
			 
				}
		//rafraichissement de la page une fois la suppression termin?
		header('Location: ajout_categories.php'); 

	}


	?>
	
