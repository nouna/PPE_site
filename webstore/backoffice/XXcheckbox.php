<?php
//connexion base
	$base = mysql_connect('localhost', 'root', '');
	mysql_select_db('webstore', $base);
	
/* ------------------ CASE A COCHER ------------------ */


 
if (isset($_POST['champ'])) 

{
    echo '<div align="center"><font face="arial" size="4" color="red">Vous avez supprimé : </font></div> ';
 
	for ($i=0;$i<sizeof($_POST['champ']);$i++) {
 
	$numero_produit = $_POST['champ'][$i];
	 
	
 /*------------------------------------------------------*/
	echo "<br/><b><div align='center'><font face='arial' size='4' color='red'>Le produit de la ligne  " . $numero_produit .  "   ! </font></b> </b></div>";
 
	$query = "DELETE FROM produits WHERE produits.id='".$numero_produit."'";
	$result = mysql_query($query, $base)  or die('Erreur SQL ! '.$query.'<br/>'.mysql_error());
 
    }
}

 
 
?>