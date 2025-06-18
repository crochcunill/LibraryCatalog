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

?>		
	<P>Aquesta es la pàgina on podeu registrar a la base de dades nous autors:
	
	<FORM action="entrar_autor2.php" method=POST id=form1 name=form1>
		<table bgcolor="ffffaa">
			<TR>
				<TD><B>Nom: </B> <font size=-2>(requerit)</font>: <INPUT type="text" id=text1 name="autor_nom" size=30></TD>
				<TD><B>Cognoms:</B>&nbsp;&nbsp; &nbsp;&nbsp;<INPUT type="text" name="autor_cognoms" size=30></TD>
			</TR>
			<TR>
				<TD colspan=2>
					<B>Biografia:</B>
					<BR><TEXTAREA rows=8 cols=80 id=textarea1 name=autor_biografia><?php echo $autor_biografia?></TEXTAREA>
				</TD>
			</TR>
			<TR>
				<INPUT type="hidden" name="validacio" value="<?php echo $validacio?>" >
				<INPUT type="hidden" name="autor_ID" value="<?php echo $_GET['autor_ID']?>" >				
				
				<TD><B>Llengua:</B>&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;						
					<SELECT id=select1 name=autor_idioma_ID>
					<?php							
						$query_string="SELECT * FROM idiomes order by idioma_nom";			
						$resultats=mysqli_query($link_ID,$query_string, 1);
					
							while ($els_resultats2=mysqli_fetch_row($resultats)){
									if ($els_resultats2[0]=='1'){//1 és Català
								        echo "<OPTION selected value=".$els_resultats2[0].">". $els_resultats2[1]. "</OPTION>";
									}	
									else{
								      echo "<OPTION value=".$els_resultats2[0].">". $els_resultats2[1]. "</OPTION>";
									}
							} //end while
							$mysqli_error=mysqli_error($link_ID);
							
							if (!empty($mysqli_error)){
										echo "===> $mysqli_error<BR>";
									}		
						?>
					</SELECT>
				</TD>
				<TD align=right>Premeu el botó per salvar el que heu entrat &nbsp;&nbsp;<INPUT type="submit" value="Salvar" id=submit1 name=submit1></TD>
			</TR>		
		</table>				
	</FORM>	


<?php
	include("peu2.txt");
?>