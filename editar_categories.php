<?php
	session_start();

	$validacio=$HTTP_GET_VARS['validacio'];



	if ($validacio!=session_id()){
			session_destroy();
			header("Location: ./Error.php?error=1"); /* Redirect browser */
			exit;
		} 

	//Aquest es la capcalera dels fitxers en HTML
	include("capcalera2.txt");
		
	include("common_variables.php");		$query_string="SELECT * from categories WHERE categoria_ID=".$categoria_ID;			
	$resultats=mysql_query($query_string, $link_ID);
		
	while ($els_resultats=mysql_fetch_row($resultats)){
			$categoria_nom=$els_resultats[1];
			$categoria_descripcio=$els_resultats[2];
			$categoria_medi_ID=$els_resultats[3];
		}	
		

	$MYSQL_ERRNO=mysql_errno($link_ID);
	$MYSQL_ERROR=mysql_error($link_ID);
				
	if (!empty($MYSQL_ERROR)){
			echo "2===> $MYSQL_ERRNO:    $MYSQL_ERROR  <BR>";
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
					$resultats=mysql_query("SELECT * from medis ORDER BY medi_nom", $link_ID);
			
					echo "<SELECT id=select1 name=categoria_medi_ID>";					
					while ($els_resultats=mysql_fetch_row($resultats)){
						if ($els_resultats[0]==$categoria_medi_ID){
							echo "<OPTION value=" . $els_resultats[0]." selected>" . $els_resultats[1] . "</OPTION>";
							}
						else{	
							echo "<OPTION value=" . $els_resultats[0].">" . $els_resultats[1] . "</OPTION>";
							}
						}//end while	
					echo "</SELECT>";
				
					$MYSQL_ERRNO=mysql_errno($link_ID);
					$MYSQL_ERROR=mysql_error($link_ID);
				
					if (!empty($MYSQL_ERROR)){
						echo "2===> $MYSQL_ERRNO:    $MYSQL_ERROR  <BR>";
						}						
				?>				</TD>
		</TR>
		<TR>
			<TD colspan=2>Descripció:	
				<BR><TEXTAREA rows=5 cols=60 id=textarea1 name="categoria_descripcio" ><?php echo $categoria_descripcio ?></TEXTAREA>
	
				<INPUT type="hidden" name="validacio" value="<?php echo $validacio?>" >
				<INPUT type="hidden" name="categoria_ID" value="<?php echo $HTTP_GET_VARS['categoria_ID']?>" >
			</TD>
		</TR>
		<TR>
			<TD colspan=2>
				<INPUT type="submit" value="Entrar" id=submit1 name=submit1>
			</TD>
		</TR>
	</table>
	
</FORM>	



	<P>Per <B>esborrar</B> aquest categorias de la base de dades premeu el boto <i>Esborrar</I>
	<FORM action="esborrar_categories.php" method=POST id=form1 name=form1>

		<INPUT type="hidden" name="categoria_nom" value="<?php echo  $categoria_nom?>" >
		<INPUT type="hidden" name="validacio" value="<?php echo $validacio?>" >
		<INPUT type="hidden" name="categoria_ID" value="<?php echo $HTTP_GET_VARS['categoria_ID']?>" >

		<P>
		<INPUT type="submit" value="Esborrar" id=submit1 name=submit1>
	</FORM>	


<?php
	include("peu2.txt");
?>