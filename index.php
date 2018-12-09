<?php

function checkvalues($myvalue){
			//Amb aquesta funció controlo que ningu entri caracters extranys com ara ! $ #...
			$correct=ereg("[^0-9A-Za-z_]", $myvalue); //es a dir, si no son lletres i/o numeros, aixo es cert
			if ($correct){return "false";}
			else {return $myvalue;}
	}
	
session_start();
	
$validacio=$HTTP_GET_VARS['validacio'];
if ($validacio==session_id()){$PotsPassar=1;} 

	
session_register("access_index");

$nom=$HTTP_POST_VARS['nom'];
$motdepas=$HTTP_POST_VARS['motdepas'];

//Aquest es la capcalera dels fitxers en HTML
include("capcalera.txt");

if ($PotsPassar!=1){
	if (checkvalues($nom)=="false" || checkvalues($motdepas)=="false") {
		echo "<P>Hi han caracters no valids en la combinació <I>nom/mot de pas</I>";
		$nom="";
		$motdepas="";
		$PotsPassar=0;
	}


	if (strlen($nom)>0 && strlen($motdepas)>0){
					
		//posar aqui la rutina per validar la combinacio				
		include("common_variables.php");						$query_string="SELECT * from administradors where administrador_nom='" .$nom ."'";
		$resultats=mysql_query($query_string, $link_ID);
		
		while ($els_resultats=mysql_fetch_row($resultats)){
			if ($motdepas==$els_resultats[2]){$PotsPassar=1;} else {$PotsPassar=0;}
		}	
		
		
		$MYSQL_ERRNO=mysql_errno($link_ID);
		$MYSQL_ERROR=mysql_error($link_ID);
				
		if (!empty($MYSQL_ERROR)){
			echo "2===> $MYSQL_ERRNO:    $MYSQL_ERROR  <BR>";
		}
				
				
	}//if (strlen($nom)>0 && strlen($motdepas)>0

	else {
		$PotsPassar=0;
	}
}//if ($PotsPassar!=1)			

//Si tot es correcte mostrem les opcions que oferim.			
			
if ($PotsPassar==1) {
					
		
?>
 				
	<P>Benvingut/da a gestor de la Biblioteca del Casal.
	<P>Utiitzant les eines del dessota podeu gestionar el contingut
	de la base de dades.
					
		<UL>
			<LI><A href="gestor_autors.php?validacio=<?php echo session_id() ?>">Gestionar els autors</a>
			<LI><A href="gestor_titols.php?validacio=<?php echo session_id() ?>">Gestionar els titols</a>
			<LI><A href="gestor_editorials.php?validacio=<?php echo session_id() ?>">Gestionar les editorials</a>
			<LI><A href="gestor_detalls.php?validacio=<?php echo session_id() ?>">Gestionar Detalls (Categories, procedències, medis i idiomes)</a>
		</UL>
		

			
		<?php
			
		}//aixo es pel if ($PotsPassar==1)
			
else {
		if ($_SESSION['access_index']==1){echo "<P>La combinació <I>nom/mot de pas</I> no és correcte";}
			
				
	?>
							

		<P>Si us plau, entreu el vostre nom i el voste mot de pas.

			<FORM action="index.php" method=POST id=form1 name=form1>				<P>Nom:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <INPUT type="text" id=text1 name="nom">				<P>Mot de Pas: <INPUT type="password" name="motdepas">				<P><INPUT type="submit" value="Entrar" id=submit1 name=submit1>
			</FORM>				
		

	<?php
}//aixo es pel else
			
if ($_SESSION['access_index']==0){$_SESSION['access_index']=1;} 			
		
include("peu.txt");
?>
