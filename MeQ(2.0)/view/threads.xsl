<?xml version="1.0"?>
<xsl:stylesheet version="1.0"
xmlns:xsl="http://www.w3.org/1999/XSL/Transform">

<xsl:template match="/Threads">

  <html>

  <head>
      <link rel="stylesheet" href="test2.css" />
  </head>
  <body>
      <UL>
          <li><h2>MeQ Threads</h2></li>
          <li ID="Home"><a href="../home.php" >Home</a></li>
          <li><a href="../home.php?PressMe=" >See all threads</a></li>
          <li>
              Sort by:
          </li>
          <li><a href="../home.php?PressMe=Newest" >Newest</a></li>
          <li><a href="../home.php?PressMe=Oldest" >Oldest</a></li>
          <li><a href="../home.php?PressMe=Replies" >Most replies</a></li>

      </UL>
      <script>
          function iniFrame() {
          if(window.self !== window.top) {

          document.getElementById('Home').style.display="none";
          }

          }
          iniFrame();
      </script>



    <xsl:for-each select="Thread">
        <?php
                $ID=<xsl:value-of select="Content"/>
                echo "$ID";
                ?>

        <div class="blended_grid">
            <script>document.getElementById('PostContent').setAttribute("readonly", "readonly"); </script>
            <div class="Left">
                <xsl:if test = "Image !=''">
                <img style="float:right; border:1px solid black;"><xsl:attribute name="src">images/<xsl:value-of select='Image' /></xsl:attribute></img>
                </xsl:if>
            </div>
            <div class="Top1">
                <h3>By:<xsl:value-of select="User"/></h3>
                <h3>In:<xsl:value-of select="Category"/></h3>
                <h3><xsl:value-of select="Date"/></h3>
                <xsl:if test = "Image !=''">
                <h3><a style="color:black;"><xsl:attribute name="href">images/<xsl:value-of select="Image"/></xsl:attribute>Image</a></h3>
                </xsl:if>
            </div>

            <div class="Top2">
               <a style="color:black;"><xsl:attribute name="href">/~mihai.maxim/home.php?PressMe=<xsl:value-of select="Title"/></xsl:attribute>
                    <h2><xsl:value-of select="Title"/>  <xsl:if test = "ThreadAdmin > 0"><form action="../controller/delete_thread_controller.php"> <button style ="border:1px black solid;color: black;" type ="submit"  name="DeleteThread" class="Button"><xsl:attribute name="value"><xsl:value-of select="Id" /></xsl:attribute><center>Delete</center></button> </form></xsl:if> </h2>
                </a>
            </div>
            <div class="Mid">
                <xsl:choose>
                    <xsl:when test="ThreadAdmin > 0">

                        <form action="../controller/update_thread_controller.php">
                        <textarea id="PostContent" name="PostText" maxlength="5000" class="ReplyForm" style="margin: 0px; width: 600px; height: 200px;resize: none; border:1px solid black;	background-color: #f5f5f5; " >  <xsl:value-of select="Content"/></textarea>
                            <button style ="border:1px black solid;color: black;" type ="submit" name="UpdateThread"  class="Button"><xsl:attribute name="value"><xsl:value-of select='Id' /></xsl:attribute><center>Update </center></button>
                         </form>
                    </xsl:when>
                    <xsl:when test="ThreadAdmin  =-1 ">
                        <textarea readonly="readonly" id="PostContent" name="PostText" maxlength="2000" class="ReplyForm" style="margin: 0px; width: 600px; height: 200px;resize: none; border:2px solid black;background-color: #f5f5f5;" >  <xsl:value-of select="Content"/></textarea>
                    </xsl:when>
                </xsl:choose>

            </div>
            <xsl:if test = "ThreadAdmin > 0">

            </xsl:if>

            <xsl:for-each select="Reply">

            <div class="blended_grid2">
                <div class="ReplyTop">

                    <form action="../controller/manage_reply_controller.php" method="POST">
                        <xsl:choose>
                        <xsl:when test="ReplyAdmin > 0">
                    <textarea name="ReplyRequestText" maxlength="2000" ID="ReplyForm" style="margin: 0px; width: 400px; height: 200px;resize: none;border:2px solid black; 	background-color: #f5f5f5;" ><xsl:value-of select="ReplyContent"/></textarea>
                        </xsl:when>
                        <xsl:when test="ReplyAdmin = -1">
                            <textarea readonly="readonly" name="ReplyRequestText" maxlength="2000" ID="ReplyForm" style="margin: 0px; width: 400px; height: 200px;resize: none;border:2px solid black;	background-color: #f5f5f5; " ><xsl:value-of select="ReplyContent"/></textarea>
                        </xsl:when>
                        </xsl:choose>
                        <xsl:if test = "ReplyAdmin > 0">
                            <button style ="border:1px black solid;color: black;" type ="submit" name="UpdateReply"  class="Button"><xsl:attribute name="value"><xsl:value-of select='ReplyAdmin' /></xsl:attribute>Update
                                <button style ="border:1px black solid;color: black;" type ="submit" name="DeleteReply"  class="Button"><xsl:attribute name="value"><xsl:value-of select='ReplyAdmin' /></xsl:attribute>Delete</button></button>

                        </xsl:if>

                    </form>
                </div>
                <div class="ReplyRight1">
                    <h3>By:<xsl:value-of select="ReplyUsername"/></h3>
                    <h3><xsl:value-of select="ReplyDate"/></h3>
                    <xsl:if test = "ReplyImage !=''">
                    <h3><a style="color:black;"><xsl:attribute name="href">images/<xsl:value-of select="ReplyImage"/></xsl:attribute>Image</a></h3>
                    </xsl:if>
                    
                </div>
                <div class="ReplyRight2">
                    <xsl:if test = "ReplyImage !=''">
                    <img style="max-width: 125px;
	                 height: 125px; border:1px solid black;"><xsl:attribute name="src" >images/<xsl:value-of select='ReplyImage' /></xsl:attribute></img>
                    </xsl:if>
                </div>
            </div>


            </xsl:for-each>


            <div class="Reply">
                <form method="POST" enctype="multipart/form-data" action="../controller/reply_controller.php"  >
                    <textarea ID="ReplyForm" name="CreateReplyRequestText" rows="5" maxlength="5000" cols="50" clas="ReplyForm" style="border:solid 1px black;" ></textarea>
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