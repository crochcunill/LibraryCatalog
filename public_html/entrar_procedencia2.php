<?php
		session_start();

		$validacio=$_POST['validacio'];
                                         include("common_variables.php");

	//******** FUNCIONS***********
	include("funcions_entrada.php");
	//****************************


if ($validacio!=session_id()){
		session_destroy();
		header("Location: ./Error.php?error=1"); // Redirect browser 
		exit;
		} 
		
if (checklenght($_POST['procedencia_descripcio'])=="false" || checkvalues($_POST['procedencia_descripcio'])=="false") {
		//Aquesta és la capçalera dels fitxers en HTML
		include("capcalera2.txt");
		echo "<P>Hi han caracters no valids a la <I>descripció</I>. Intenteu de nou";		
		include("peu2.txt");					
		}	
else{	

		$query_string="INSERT INTO procedencies (procedencia_descripcio) VALUES ('" . $_POST['procedencia_descripcio'] . "')";	
		$resultats=mysqli_query($link_ID,$query_string);
				
		$mysqli_error=mysqli_error($link_ID);
						
		if (!empty($mysqli_error)){		
				echo "<BR>query string ".$query_string;	
				echo "===> $mysqli_error<BR>";
				}
		else{
				header("Location: ./totes_procedencies.php?validacio=".$validacio."&flag=2&procedencia_descripcio=".$_POST['procedencia_descripcio']); // Redirect browser 
				exit;
				}	
			
	} //end else (checklenght($_POST['editorial....		

?>			
