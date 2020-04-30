<?xml version="1.0"?>
<xsl:stylesheet version="1.0" 
xmlns:xsl="http://www.w3.org/1999/XSL/Transform">
<xsl:template match="/Threads">
  <html>
  <head>
      <link rel="stylesheet" href="test.css" />
  </head>
  <body>

    <h2>MeQ Threads</h2>
    <a href="../home.php"><h3>Home</h3></a>
    <xsl:for-each select="Thread">
       <div class="blended_grid">
        <div class="middleBanner">
        <h2>Title:<xsl:value-of select="Title"/></h2>
        <h3>Username:<xsl:value-of select="User"/></h3>
        <p><xsl:value-of select="Content"/></p>
        </div>
        <div class="rightBanner">
       <img><xsl:attribute name="src">images/<xsl:value-of select='Image' /></xsl:attribute></img>
        </div>
        <div class="topBanner">
        <h2>Category:<xsl:value-of select="Category"/></h2>
        </div>
        </div>
    </xsl:for-each>
  </body>
  </html>
</xsl:template>

</xsl:stylesheet>