<?php
		session_start();

		$validacio=$HTTP_GET_VARS['validacio'];

//echo "la session es ". session_start();
//echo "la validacio es ". $validacio;

if ($validacio!=session_id()){
		session_destroy();
//		header("Location: http://192.169.10.51/Error.php?error=1"); /* Redirect browser */
		header("Location: ./Error.php?error=1"); /* Redirect browser */

		exit;
		} 

else{


		//Aquest es la capcalera dels fitxers en HTML
		include("capcalera2.txt");
?>		


	<p>En aquesta pàgina podeu gestionar les diferents procedències del material (llibres, revistes...) que tenim a la Biblioteca.
			
	<UL>
		<LI>Veure la llista de les <A href="totes_procedencies.php?validacio=<?php echo $validacio ?>"> procedències </A>existents.
		<LI><A href="entrar_procedencia.php?validacio=<?php echo $validacio ?>">Entrar una nova procedències</a>

	</UL>
	
	<P>Per esborrar o modificar una procedències primer n'heu de seleccionar-ne una (utilitzeu el llistat de procedències).
	

<?php

include("peu2.txt");

} //close the else

?>