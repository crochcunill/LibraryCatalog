<?php
session_start();
include("common_variables.php");

function checkvalues($myvalue){
			//Amb aquesta funció controlo que ningu entri caracters extranys com ara ! $ #...
			$correct=preg_match("[^0-9A-Za-z_]", $myvalue); //es a dir, si no son lletres i/o numeros, aixo es cert
			if ($correct){return "false";}
			else {return $myvalue;}
	}
	
$validacio=$_GET['validacio'];
if ($validacio==session_id()){$PotsPassar=1;} 

$_SESSION['access_index']=1;


$nom=$_POST['nom'];
$motdepas=$_POST['motdepas'];
$motdepas2=$_POST['motdepas'];

//Aquesta es la capcalera dels fitxers en HTML
include("capcalera.txt");

if ($PotsPassar!=1){
	if (checkvalues($nom)=="false" || checkvalues($motdepas)=="false") {
		echo "<P>Hi han caràcters no valids en la combinació <I>nom/mot de pas</I>";
		$nom="";
		$motdepas="";
		$PotsPassar=0;
	}


	if (strlen($nom)>0 && strlen($motdepas)>0){
					
		//posar aqui la rutina per validar la combinacio				
		include("common_variables.php");	 
        $query_string="SELECT * from administradors where administrador_nom='" .$nom ."'";
		$resultats=mysqli_query($link_ID,$query_string, MYSQLI_STORE_RESULT);

		while ($els_resultats=mysqli_fetch_row($resultats)){
			if ($motdepas==$els_resultats[2])
                {$PotsPassar=1;
                #{echo "<P>La categoria <B>". $_GET['categoria_nom']. "</b> ha estat esborrada";}
 
                }
  
            else    
                {$PotsPassar=0;
            }
          
		}	
		
		
		#$mysqli_error=mysqli_error($link_ID);
		$MYSQL_ERROR=mysqli_error($link_ID);
				
		if (!empty($MYSQL_ERROR)){
			
            echo $MYSQL_ERROR;
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
		if ($_SESSION['access_index']==1){
            echo "<P>La combinació <I>nom/mot de pas</I> no és correcte";
        }
			
       			
	?>
							

		<P>Si us plau, entreu el vostre nom i el voste mot de pas.

			<FORM action="index.php" method=POST id=form1 name=form1>
                <P>Nom: <INPUT type="text" id=text1 name="nom">
                <P>Mot de Pas: <INPUT type="password" name="motdepas">				
                <P><INPUT type="submit" value="Entrar" id=submit1 name=submit1>
			</FORM>				
		

	<?php
}//aixo es pel else
			
if ($_SESSION['access_index']==0){$_SESSION['access_index']=1;} 			
		
include("peu.txt");
?>
