<?xml version="1.0"?>
<xsl:stylesheet version="1.0" 
xmlns:xsl="http://www.w3.org/1999/XSL/Transform">
<xsl:template match="/Threads">

  <html>
  <head>
      <link rel="stylesheet" href="test2.css" />
  </head>
  <body>
     <h2>MeQ Threads</h2>
      <h3>Login to post</h3>
    <a href="../home.php"><h3>Home</h3></a>

    <xsl:for-each select="Thread">
        <?php
                $ID=<xsl:value-of select="Content"/>
                echo "$ID";
                ?>
        <div class="blended_grid">
            <div class="Left">
                <img><xsl:attribute name="src">images/<xsl:value-of select='Image' /></xsl:attribute></img>
            </div>
            <div class="Top1">
                <h3>By:<xsl:value-of select="User"/></h3>
                <h3>In:<xsl:value-of select="Category"/></h3>
                <h3><xsl:value-of select="Date"/></h3>
                <h3><a style="color:black;"><xsl:attribute name="href">images/<xsl:value-of select="Image"/></xsl:attribute>Image</a></h3>
            </div>
            <div class="Top2">
                <h2><xsl:value-of select="Title"/></h2>
            </div>
            <div class="Mid">
                <h3><p><xsl:value-of select="Content"/></p></h3>

            </div>
            <xsl:for-each select="Reply">
            <div class="blended_grid2">
                <div class="ReplyTop">
                    <h3><xsl:value-of select="ReplyContent"/></h3>
                </div>
                <div class="ReplyRight1">
                    <h3>By:<xsl:value-of select="ReplyUsername"/></h3>
                    <h3><xsl:value-of select="ReplyDate"/></h3>
                    <h3><a style="color:black;"><xsl:attribute name="href">images/<xsl:value-of select="ReplyImage"/></xsl:attribute>Image</a></h3>
                </div>
                <div class="ReplyRight2">
                    <img style="max-width: 125px;
	                 height: 125px;"><xsl:attribute name="src" >images/<xsl:value-of select='ReplyImage' /></xsl:attribute></img>
                </div>
            </div>
            </xsl:for-each>


            <div class="Reply">
                <form method="POST" enctype="multipart/form-data" action="../controller/reply_controller.php"  >
                    <textarea name="CreateReplyRequestText" rows="5" maxlength="2000" cols="50" clas="ReplyForm" style="border:solid 1px black;"></textarea>
                    <input type="file" accept="image/*" name="CreateReplyRequestFile"  class="right adjustText"/>
                    <button type ="submit" name="CreateReplySubmit" class="RegularButton"><xsl:attribute name="value"><xsl:value-of select='Id' /></xsl:attribute><center>Reply </center></button>

                </form>
            </div>
        </div>

    </xsl:for-each>
  </body>
  </html>
</xsl:template>

</xsl:stylesheet>