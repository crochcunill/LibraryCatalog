<?php
	session_start();

	$validacio=$_POST['validacio'];
	
include("common_variables.php");

	if ($validacio!=session_id()){
			session_destroy();
			header("Location: ./Error.php?error=1"); /* Redirect browser */
			exit;
			} 

	//******** FUNCIONS***********
	include("funcions_entrada.php");
	//****************************
		
	if (checklenght($_POST['categoria_nom'])=="false" || checkvalues($_POST['categoria_nom'])=="false" || checkvalues($_POST['categoria_descripcio'])=="false") {
			//Aquest es la capcalera dels fitxers en HTML
			include("capcalera2.txt");
                                                            
			echo "<P>Hi han caracters no valids en la combinacio <I>nom/descripció</I>. Intenteu de nou";		
			include("peu2.txt");					
			}	
	else{	
		//$link_ID=mysql_connect("localhost:/tmp/mysql.sock","roch","");				
		//$database_ID=mysql_select_db("Casal_Biblioteca",$link_ID);
		$query_string="INSERT INTO categories (categoria_nom,categoria_descripcio,categoria_medi_ID) VALUES ('" . $_POST['categoria_nom']. "','" . $_POST['categoria_descripcio'] ."','". $_POST['categoria_medi_ID']."')";	
		$resultats=mysqli_query($link_ID,$query_string);
				
		$mysqli_error=mysqli_error($link_ID);
						
		if (!empty($mysqli_error)){		
				echo "<BR>query string ".$query_string;	
				echo "===> $mysqli_error<BR>";
				}
		else{
				header("Location: ./totes_categories.php?validacio=".$validacio."&flag=2&categoria_nom=".$_POST['categoria_nom']. "&categoria_descripcio=" . $_POST['categoria_descripcio']); /* Redirect browser */
				exit;
				}	
			
		} //end else (checklenght($_POST['editorial....		

?>			

