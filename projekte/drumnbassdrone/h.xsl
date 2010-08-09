<?xml version="1.0" encoding="ISO-8859-1"?>
<xsl:stylesheet version="1.1" xmlns:xsl="http://www.w3.org/1999/XSL/Transform" xmlns:fo="http://www.w3.org/1999/XSL/Format">

<xsl:template match="/">
	<html>
	<body>
		<xsl:apply-templates></xsl:apply-templates>
	</body>
	</html>
</xsl:template>

<xsl:template match="chapter">
	<xsl:text>Testdatei für Kapitelnummerierung</xsl:text>
	<br></br>
	<xsl:apply-templates></xsl:apply-templates>
</xsl:template>

<xsl:template match="h1">
	<p>
	<xsl:variable name="h1" select="count(preceding-sibling::h1)+1"></xsl:variable> 	 
	<xsl:value-of select="$h1"></xsl:value-of>
	<xsl:text>. </xsl:text>
	<xsl:apply-templates></xsl:apply-templates>
	</p>
</xsl:template>

<xsl:template match="h2">
	<p>
	
	<xsl:variable name="preh1"  select="preceding-sibling::h1[1]"></xsl:variable>
	<xsl:variable name="h1" 
	select="count(preceding-sibling::h1)"></xsl:variable> 
	<xsl:variable name="h2" 
	select="count(preceding-sibling::h2[preceding-sibling::h1=$preh1])+1">
	</xsl:variable>
	<xsl:value-of select="$h1"></xsl:value-of>
	<xsl:text>. </xsl:text>
	<xsl:value-of select="$h2"></xsl:value-of>
		<xsl:text>. </xsl:text> 
	<xsl:apply-templates></xsl:apply-templates>
	</p>
</xsl:template>

<xsl:template match="h3">
	<p>
		
		<xsl:variable name="h1" 
		select="count(preceding-sibling::h1)"></xsl:variable> 
	
	<xsl:variable name="preh1"  
		select="preceding-sibling::h1[1]"></xsl:variable>
	<xsl:variable name="h2" 
		select="count(preceding-sibling::h2[preceding-sibling::h1=$preh1])+1">
	</xsl:variable>

	<xsl:variable name="preh2" 
		select="preceding-sibling::h2[1]"></xsl:variable>	
	<xsl:variable name="h3" 
		select="count(preceding-sibling::h3[preceding-sibling::h2=$preh2])+1">
	</xsl:variable>
		
	<xsl:value-of select="$h1"></xsl:value-of>
	<xsl:text>. </xsl:text>
	<xsl:value-of select="$h2"></xsl:value-of>
	<xsl:text>. </xsl:text> 
	<xsl:value-of select="$h3"></xsl:value-of>
	<xsl:text>. </xsl:text> 

	<xsl:apply-templates></xsl:apply-templates>
	</p>
</xsl:template>


</xsl:stylesheet>
