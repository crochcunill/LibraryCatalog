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
?>		

<P>Aquesta es la pàgina on podeu registrar a la base de dades noves editorials:
				
<FORM action="entrar_editorial2.php" method=POST id=form1 name=form1>	
	<table bgcolor="ffffaa" class="normal">
		<TR>			<TD>
				<B>Nom de l'editorial  </B> <font size=-2>(requerit)</font>: 				<BR><INPUT type="text" id=text1 name="editorial_nom" size=30>			</TD>
			<TD>				<B>Col.lecció:</B>&nbsp;&nbsp; &nbsp;&nbsp;				<BR><INPUT type="text" name="editorial_colleccio" size=30>			</TD>
		</TR>		<TR>
			<TD>					<B>Adreça:</B>				<BR>
				<TEXTAREA rows=5 cols=30 id=textarea1 name="editorial_adreca"></TEXTAREA>			</TD>

			<TD>					<B>Altre Informació:</B>				<BR>
				<TEXTAREA rows=5 cols=30 id=textarea1 name="editorial_extra"></TEXTAREA>			</TD>
		</TR>
		<TR>
			<TD colspan=2 align=left>					<INPUT type="hidden" name="validacio" value="<?php echo $validacio?>" >
				<INPUT type="submit" value="Entrar" id=submit1 name=submit1>		
			</TD>
		</tr>		</table>
</FORM>	

<?php
	include("peu2.txt");
?>