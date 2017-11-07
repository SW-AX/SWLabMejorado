<?xml version="1.0" ?>
<xsl:stylesheet version="1.0"
xmlns:xsl="http://www.w3.org/1999/XSL/Transform">
<xsl:template match="/">
<HTML> <BODY> <P>TRANSFORMACION XSL DE preguntas.xml</P>
<TABLE border="1">
	<THEAD>
		<TR> <TH>Email </TH> <TH>Enunciado</TH> <TH>Respuesta Correcta</TH> <TH>Respuestas Incorrectas</TH> <TH>Complejidad</TH> <TH>Tema</TH></TR>
	</THEAD>
	<xsl:for-each select="/assessmentItems/assessmentItem" >
	<TR>
		<TD>
			<xsl:value-of select="@author"/> <BR/>
		</TD>
		<TD>
			<xsl:value-of select="itemBody/p"/> <BR/>
		</TD>
		<TD>
			<xsl:value-of select="correctResponse/value"/> <BR/>
		</TD>
		<TD>
			<xsl:for-each select="incorrectResponses/value" >
			<xsl:value-of select="current()"/>
			<BR></BR>
			</xsl:for-each>
		</TD>
		<TD>
			<xsl:value-of select="@complexity"/> <BR/>
		</TD>
		<TD>
			<xsl:value-of select="@subject"/> <BR/>
		</TD>
	</TR>
	</xsl:for-each>
</TABLE>
</BODY>
</HTML>
</xsl:template>
</xsl:stylesheet>