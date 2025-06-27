<?php
		session_start();

		$validacio=$_GET['validacio'];

if ($validacio!=session_id()){
		session_destroy();
		header("Location: http://192.169.10.52/Error.php?error=1"); /* Redirect browser */
		exit;
		} 

else{


		//Aquest es la capcalera dels fitxers en HTML
		include("capcalera2.txt");
?>		
	<P>Aquesta ês la pàgina on podeu registrar a la base de dades noves procedéncies del material:
	
	<FORM action="entrar_procedencia2.php" method=POST id=form1 name=form1>		<P>Procedéncia:		<BR><TEXTAREA rows=5 cols=50 id=textarea1 name="procedencia_descripcio"></TEXTAREA>
		
		<INPUT type="hidden" name="validacio" value="<?php echo $validacio?>" >

		<P>
		<INPUT type="submit" value="Entrar" id=submit1 name=submit1>
	</FORM>	
	
	



<?php

include("peu2.txt");

} //close the else

?>