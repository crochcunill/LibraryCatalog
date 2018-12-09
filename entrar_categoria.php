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
	include("common_variables.php");
?>		
	<P>Aquesta es la pàgina on podeu registrar a la base de dades noves categories:
	
	<FORM action="entrar_categoria2.php" method=POST id=form1 name=form1>		<table bgcolor="ffffaa" class="normal" width="80%">
		<TR>
			<TD>				Nom de la categoria <font size=-2>(requerit)</font>:
				<INPUT type="text" id=text1 name="categoria_nom" size=30>			</TD>			<TD>Medi:
				<?php		
					$resultats=mysql_query("SELECT * from medis ORDER BY medi_nom", $link_ID);
			
					echo "<SELECT id=select1 name=categoria_medi_ID>";						
					while ($els_resultats=mysql_fetch_row($resultats)){
							if ($els_resultats[1]=="Llibre"){//escollim Llibre per defecte en aquesta opció			
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
		<TR>			<TD colspan=2>
				Descripció:				<BR><TEXTAREA rows=5 cols=60 id=textarea1 name="categoria_descripcio"></TEXTAREA>
		
				<INPUT type="hidden" name="validacio" value="<?php echo $validacio?>" >

			</TD>
		</TR>
		<TR>	
			<TD colspan=2>

				<INPUT type="submit" value="Entrar" id=submit1 name=submit1>
			</TD>
		</TR>	
	</table>	
</FORM>	
	

<?php
	include("peu2.txt");
?>