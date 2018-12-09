<?php
	session_start();
	$validacio=$HTTP_POST_VARS['validacio'];


	if ($validacio!=session_id()){
		
		//echo "<P>validacio ".$validacio;
		//echo "<P>HTTP_POST_VARS['validacio'] ".$HTTP_POST_VARS['validacio'];
		
		//echo "<P>session_id ".session_id();
		
		session_destroy();
		header("Location: ./Error.php?error=1"); /* Redirect browser */
		exit;
		} 

else{

		//Aquest es la capcalera dels fitxers en HTML
		include("capcalera2.txt");
?>		


	<p>Esteu segur que voleu esborrar la procedència 
	<B><?php echo $HTTP_POST_VARS['procedencia_descripcio']?></B> 
	de la llista de procedències?
	
	
<FORM action="esborrar_procedencia2.php" method=POST id=form1 name=form1>
	
		<INPUT type="hidden" name="procedencia_descripcio" value="<?php echo  $HTTP_POST_VARS['procedencia_descripcio']?>" >
		
		<INPUT type="hidden" name="validacio" value="<?php echo $validacio?>" >
		<INPUT type="hidden" name="procedencia_ID" value="<?php echo $HTTP_POST_VARS['procedencia_ID']?>" >

		<P>
		<INPUT type="submit" value="Esborrar" id=submit1 name=submit1>
	</FORM>	


<?php

include("peu2.txt");

} //close the else

?>