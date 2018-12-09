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


	<p>En aquesta pàgina podeu gestionar les diferents categories, procedències i medis que utilitzem per
	classificar el material (llibres, revistes...) que	que tenim a la Biblioteca.
			
	<UL>
		<LI>Veure la llista de les <A href="totes_categories.php?validacio=<?php echo $validacio ?>"> categories </A>existents.
		<LI><A href="entrar_categoria.php?validacio=<?php echo $validacio ?>">Entrar una nova categoria</a>

	</UL>
			
	<UL>
		<LI>Veure la llista de les <A href="totes_procedencies.php?validacio=<?php echo $validacio ?>"> procedències </A>existents.
		<LI><A href="entrar_procedencia.php?validacio=<?php echo $validacio ?>">Entrar una nova procedències</a>

	</UL>
	
	<UL>
		<LI>Veure la llista dels diferents les <A href="tots_medis.php?validacio=<?php echo $validacio ?>"> medis </A>existents.
		<LI><A href="entrar_procedencia.php?validacio=<?php echo $validacio ?>">Entrar una nou medi</a>

	</UL>	


<?php

include("peu2.txt");

} //close the else

?>