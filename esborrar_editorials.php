<?php
		session_start();

		$validacio=$HTTP_POST_VARS['validacio'];



if ($validacio!=session_id()){
		session_destroy();
		header("Location: ./Error.php?error=1"); /* Redirect browser */

		exit;
		} 

else{

		//Aquest es la capcalera dels fitxers en HTML
		include("capcalera2.txt");
		
?>		


	<p>Esteu segur que voleu esborrar la col.lecció  <B><?php echo $HTTP_POST_VARS['editorial_colleccio']?></B> de l'editorial
	<B><?php echo $HTTP_POST_VARS['editorial_nom']?></B> de la llista d'editorials?
	
	
<FORM action="esborrar_editorials2.php" method=POST id=form1 name=form1>
	
		<INPUT type="hidden" name="editorial_nom" value="<?php echo  $HTTP_POST_VARS['editorial_nom']?>" >
		<INPUT type="hidden" name="editorial_colleccio" value="<?php echo $HTTP_POST_VARS['editorial_colleccio']?>" >	
		
		<INPUT type="hidden" name="validacio" value="<?php echo $validacio?>" >
		<INPUT type="hidden" name="editorial_ID" value="<?php echo $HTTP_POST_VARS['editorial_ID']?>" >

		<P>
		<INPUT type="submit" value="Esborrar" id=submit1 name=submit1>
	</FORM>	


<?php

include("peu2.txt");

} //close the else

?>