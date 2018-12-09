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


	<p>Esteu segur que voleu esborrar el medi
	<B><?php echo $HTTP_POST_VARS['medi_nom']?></B> 
	de la llista de medis?
	
	
<FORM action="esborrar_medi2.php" method=POST id=form1 name=form1>
	
		<INPUT type="hidden" name="medi_nom" value="<?php echo  $HTTP_POST_VARS['medi_nom']?>" >
		
		<INPUT type="hidden" name="validacio" value="<?php echo $validacio?>" >
		<INPUT type="hidden" name="medi_ID" value="<?php echo $HTTP_POST_VARS['medi_ID']?>" >

		<P>
		<INPUT type="submit" value="Esborrar" id=submit1 name=submit1>
	</FORM>	


<?php

include("peu2.txt");

} //close the else

?>