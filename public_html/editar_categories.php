<?php
	session_start();

	$validacio=$_GET['validacio'];

	if ($validacio!=session_id()){
			session_destroy();
			header("Location: ./Error.php?error=1"); /* Redirect browser */
			exit;
		} 

	//Aquest es la capcalera dels fitxers en HTML
	include("capcalera2.txt");
		
	include("common_variables.php");	

	$query_string="SELECT * from categories WHERE categoria_ID=".$_GET['categoria_ID'];			
	$resultats=mysqli_query($link_ID,$query_string, 1);

		
	while ($els_resultats=mysqli_fetch_row($resultats)){
			$categoria_nom=$els_resultats[1];
			$categoria_descripcio=$els_resultats[2];
			$categoria_medi_ID=$els_resultats[3];
		}	
		

	$mysqli_error=mysqli_error($link_ID);
				
	if (!empty($mysqli_error)){
			echo "===> $mysqli_error<BR>";
		}		
?>		


	<p>En aquesta pàgina podeu editar o esborrar aquesta categoria
	
	
	<P>Per editar el contingut, modifiqueu les entrades, i després premeu <I>Entrar</I>	
			<FORM action="editar_categories2.php" method=POST id=form1 name=form1>
	<table bgcolor="ffffaa" class="normal" width="80%">
		<TR>
			<TD>Nom de l'categoria <font size=-2>(requerit)</font>:
				<BR><INPUT type="text" id=text1 name="categoria_nom" size=30 value="<?php echo $categoria_nom ?>">			</TD>
	
			<TD>Medi:
				<?php		
					$resultats=mysqli_query($link_ID,"SELECT * from medis ORDER BY medi_nom", 1);
			
					echo "<SELECT id=select1 name=categoria_medi_ID>";					
					while ($els_resultats=mysqli_fetch_row($resultats)){
						if ($els_resultats[0]==$categoria_medi_ID){
							echo "<OPTION value=" . $els_resultats[0]." selected>" . $els_resultats[1] . "</OPTION>";
							}
						else{	
							echo "<OPTION value=" . $els_resultats[0].">" . $els_resultats[1] . "</OPTION>";
							}
						}//end while	
					echo "</SELECT>";
				
					$mysqli_error=mysqli_error($link_ID);		
					if (!empty($mysqli_error)){
						echo "===> $mysqli_error<BR>";
						}						
				?>				
			</TD>
		</TR>
		<TR>
			<TD colspan=2>Descripció:	
				<BR><TEXTAREA rows=5 cols=60 id=textarea1 name="categoria_descripcio" ><?php echo $categoria_descripcio ?></TEXTAREA>
	
				<INPUT type="hidden" name="validacio" value="<?php echo $validacio?>" >
				<INPUT type="hidden" name="categoria_ID" value="<?php echo $_GET['categoria_ID']?>" >
			</TD>
		</TR>
		<TR>
			<TD colspan=2>
				<INPUT type="submit" value="Entrar" id=submit1 name=submit1>
			</TD>
		</TR>
	</table>
	
</FORM>	



	<P>Per <B>esborrar</B> aquest categorias de la base de dades premeu el botó <i>Esborrar</I>
	<FORM action="esborrar_categories.php" method=POST id=form1 name=form1>

		<INPUT type="hidden" name="categoria_nom" value="<?php echo  $categoria_nom?>" >
		<INPUT type="hidden" name="validacio" value="<?php echo $validacio?>" >
		<INPUT type="hidden" name="categoria_ID" value="<?php echo $_GET['categoria_ID']?>" >

		<P>
		<INPUT type="submit" value="Esborrar" id=submit1 name=submit1>
	</FORM>	


<?php
	include("peu2.txt");
?>