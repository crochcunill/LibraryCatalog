<?php
		session_start();

		$validacio=$HTTP_POST_VARS['validacio'];
		$editorial_nom=$HTTP_POST_VARS['editorial_nom'];
		$editorial_colleccio=$HTTP_POST_VARS['editorial_colleccio'];

function checkvalues($myvalue){
			//Amb aquesta funció controlo que ningu entri caracters extranys com ara ! $ #...
			$correct=ereg("[^0-9A-Za-z_]", $myvalue); //es a dir, si no son lletres i/o numeros, aixo es cert

			if ($correct)
				{return "false";}
			else
				{return $myvalue;}
	} //end function checkvalues



if ($validacio!=session_id()){
		session_destroy();
//		header("Location: http://192.169.10.51/Error.php?error=1"); /* Redirect browser */
		header("Location: ./Error.php?error=1"); /* Redirect browser */

		exit;
		} //end if ($validacio!=session_id

// Si no anem a la pagina d'error apareixera el que segueix:


		//Aquest es la capcalera dels fitxers en HTML
		include("capcalera2.txt");


if (checkvalues($editorial_nom)=="false" || checkvalues($editorial_colleccio)=="false") {
		echo "<P>Hi han caracters no valids en la combinacio <I>Nom de l'editorial/Col.lecció</I>. Intenteu de nou";				$PerformQuery=0;						}					
else{				if ($editorial_nom==""){
			if ($editorial_colleccio==""){
				echo "<P>Heu d'entrar alguna cosa";
				$PerformQuery=0;
				}
			else{				$mevaquery="Select * from editorials where editorial_colleccio like '%".$editorial_colleccio."%'";	
				$PerformQuery=1;
				}		}	else{
			if ($editorial_colleccio==""){
				$mevaquery="Select * from editorials where editorial_nom like '%".$editorial_nom."%'";				$PerformQuery=1;
				}										else{				$mevaquery="Select * from editorials where editorial_nom like '%".$editorial_nom."%' or editorial_colleccio like '%".$editorial_colleccio."%'";				$PerformQuery=1;				}			
		}			
}//end of else: if (checkvalues($editorial_nom)
						
						
if ($PerformQuery!=0){				
?>		
		<p>La llista d'editorials conformem al que heu entrat és la següent:
	
		<table width="100%" border="1"> 
		<TR>
			<TD width=15%><B>Nom Editorial</B></td>
			<TD width=15%><B>Col.lecció</B></td>
			<TD width=15%><B>Adreça</B></td>
			<TD><B>Altre informació</B></td>
		</TR>
		
<?php
				
						$link_ID=mysql_connect("localhost:/tmp/mysql.sock","roch","");				
		$database_ID=mysql_select_db("Casal_Biblioteca",$link_ID);							
		$resultats=mysql_query($mevaquery, $link_ID);
		
		while ($els_resultats=mysql_fetch_row($resultats)){								
				echo "<TR>";
				echo "<TD width=15%><A href=\"editar_editorials.php?validacio=$validacio&editorial_ID=$els_resultats[0]\">$els_resultats[1]</a></td>";
				echo "<TD width=15%>$els_resultats[2]</td>";
				echo "<TD width=15%>$els_resultats[3]</td>";
				echo "<TD>$els_resultats[4]</td>";
				echo "</TR>";
		} //end while	
		
		
		$MYSQL_ERRNO=mysql_errno($link_ID);
		$MYSQL_ERROR=mysql_error($link_ID);
				
		if (!empty($MYSQL_ERROR)){
				echo "2===> $MYSQL_ERRNO:    $MYSQL_ERROR  <BR>";
		}
	
		echo "</TABLE>";
		//echo "<P>$mevaquery";					
	} //end if ($PerformQuery!=0)	

			
include("peu2.txt");

?>