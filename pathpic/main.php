<?php
$scriptsCabecera = "<head>
        <meta http-equiv=\"Content-Type\" content=\"text/html; charset=UTF-8\"></head>  
       <body>
                   <style type=\"text/css\">
       #codeTextarea{
          width:500px;
          height:510px;
       }
       .textAreaWithLines{
          font-family:courier;      
          border:1px solid #F00;
          
       }
       .textAreaWithLines textarea,.textAreaWithLines div{
          border:0px;
          line-height:120%;
          font-size:12px;
       }
       .lineObj{
          color:red;
       }
       </style>
       
       <script type=\"text/javascript\">
       
       var lineObjOffsetTop = 2;
       
       function createTextAreaWithLines(id)
       {
          var el = document.createElement(\'DIV\');
          var ta = document.getElementById(id);
          ta.parentNode.insertBefore(el,ta);
          el.appendChild(ta);
          
          el.className=\'textAreaWithLines\';
          el.style.width = (ta.offsetWidth + 30) + \'px\';
          ta.style.position = \'absolute\';
          ta.style.left = \'30px\';
          el.style.height = (ta.offsetHeight + 2) + \'px\';
          el.style.overflow=\'hidden\';
          el.style.position = \'relative\';
          el.style.width = (ta.offsetWidth + 30) + \'px\';
          var lineObj = document.createElement(\'DIV\');
          lineObj.style.position = \'absolute\';
          lineObj.style.top = lineObjOffsetTop + \'px\';
          lineObj.style.left = \'0px\';
          lineObj.style.width = \'27px\';
          el.insertBefore(lineObj,ta);
          lineObj.style.textAlign = \'right\';
          lineObj.className=\'lineObj\';
          var string = \'\';
          for(var no=1;no<200;no++){
             if(string.length>0)string = string + \'<br>\';
             string = string + no;
          }
          
          ta.onkeydown = function() { positionLineObj(lineObj,ta); };
          ta.onmousedown = function() { positionLineObj(lineObj,ta); };
          ta.onscroll = function() { positionLineObj(lineObj,ta); };
          ta.onblur = function() { positionLineObj(lineObj,ta); };
          ta.onfocus = function() { positionLineObj(lineObj,ta); };
          ta.onmouseover = function() { positionLineObj(lineObj,ta); };
          lineObj.innerHTML = string;
          
       }
       
       function positionLineObj(obj,ta)
       {
          obj.style.top = (ta.scrollTop * -1 + lineObjOffsetTop) + \'px\';   
       
          
       }
       
       </script>
        <title>Estamos muy contentos mañana </title>
    </head>
    <body>";
$scriptsCabecera2 = "<style type=\"text/css\">
       #codeTextarea{
          width:500px;
          height:510px;
       }
       .textAreaWithLines{
          font-family:courier;      
          border:1px solid #F00;
          
       }
       .textAreaWithLines textarea,.textAreaWithLines div{
          border:0px;
          line-height:120%;
          font-size:12px;
       }
       .lineObj{
          color:red;
       }
       </style>
       
       <script type=\"text/javascript\">
       
       var lineObjOffsetTop = 2;
       
       function createTextAreaWithLines(id)
       {
          var el = document.createElement(\'DIV\');
          var ta = document.getElementById(id);
          ta.parentNode.insertBefore(el,ta);
          el.appendChild(ta);
          
          el.className=\'textAreaWithLines\';
          el.style.width = (ta.offsetWidth + 30) + \'px\';
          ta.style.position = \'absolute\';
          ta.style.left = \'30px\';
          el.style.height = (ta.offsetHeight + 2) + \'px\';
          el.style.overflow=\'hidden\';
          el.style.position = \'relative\';
          el.style.width = (ta.offsetWidth + 30) + \'px\';
          var lineObj = document.createElement(\'DIV\');
          lineObj.style.position = \'absolute\';
          lineObj.style.top = lineObjOffsetTop + \'px\';
          lineObj.style.left = \'0px\';
          lineObj.style.width = \'27px\';
          el.insertBefore(lineObj,ta);
          lineObj.style.textAlign = \'right\';
          lineObj.className=\'lineObj\';
          var string = \'\';
          for(var no=1;no<200;no++){
             if(string.length>0)string = string + \'<br>\';
             string = string + no;
          }
          
          ta.onkeydown = function() { positionLineObj(lineObj,ta); };
          ta.onmousedown = function() { positionLineObj(lineObj,ta); };
          ta.onscroll = function() { positionLineObj(lineObj,ta); };
          ta.onblur = function() { positionLineObj(lineObj,ta); };
          ta.onfocus = function() { positionLineObj(lineObj,ta); };
          ta.onmouseover = function() { positionLineObj(lineObj,ta); };
          lineObj.innerHTML = string;
          
       }
       
       function positionLineObj(obj,ta)
       {
          obj.style.top = (ta.scrollTop * -1 + lineObjOffsetTop) + \'px\';   
       }       
       </script>";
?>
<html>    
    <head>
        <style type="text/css">
            div.capital {background: #D9E9FE ;font-size : 60px; color: #E7E7E7; font-family: times;}
            div.logo {background: #FFFFFF ;font-size : 60px; color: #DdDdFF; font-family: times;}
            div.infologo {background: #FFFFFF ;font-size : 14px; color: #665E66; font-family: times;}
            div.buttonSample {background: #67abb8 ;font-size : 35px; color: #000001; font-family: courier;}
            h4, b {color: #CAFE00; font-family: arial; }
            td {font-size: 12px; color: #0009EF; font-family: arial;}
            input,select,option {font-size: 12px; color: #EF0009; font-family: arial; }
            p { text-indent: 2cm; background: yellow; font-family: courier;}
            textarea {background: #F4F4F4 ; font-size: 11px; color: #AdAdCF; font-family: courier; border: 1px dashed rgb(204,204,204);}            
            div.beta {background: #FFFFFF ;font-size : 10px; color: #DdDdFF; font-family: times; }
            div.salida { border: 0px;}
        </style>        
    </head>    
    <body>          
        <table align="center">            
            <tr><td>
                    <div class="logo">Path</div>             
                    <div class="logo"><img src="images/expandidoBig.jpg" widht="59" height="59" />Pic</div>
                </td>
                <td>
                    <div class="beta">.BETA</div> 
                </td>    
            </tr>            
        </table>
        <table align="center">
            <tr><td align="center"><div class="infologo">Ingresa tus rutas y haz Clic en "Generar Snapshot". <a href="samples.php" target="_blank">Ejemplos</a></div></td></tr>
        </table>  
        <?php
//echo $scriptsCabecera;
        ?>    
        <!--<head>
            <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <style type="text/css">
           #codeTextarea{
              width:500px;
              height:510px;
           }
           .textAreaWithLines{
              font-family:courier;      
              border:1px solid #F00;
              
           }
           .textAreaWithLines textarea,.textAreaWithLines div{
              border:0px;
              line-height:120%;
              font-size:12px;
           }
           .lineObj{
              color:red;
           }
           </style>
           
           <script type="text/javascript">
           
           var lineObjOffsetTop = 2;
           
           function createTextAreaWithLines(id)
           {
              var el = document.createElement('DIV');
              var ta = document.getElementById(id);
              ta.parentNode.insertBefore(el,ta);
              el.appendChild(ta);
              
              el.className='textAreaWithLines';
              el.style.width = (ta.offsetWidth + 30) + 'px';
              ta.style.position = 'absolute';
              ta.style.left = '30px';
              el.style.height = (ta.offsetHeight + 2) + 'px';
              el.style.overflow='hidden';
              el.style.position = 'relative';
              el.style.width = (ta.offsetWidth + 30) + 'px';
              var lineObj = document.createElement('DIV');
              lineObj.style.position = 'absolute';
              lineObj.style.top = lineObjOffsetTop + 'px';
              lineObj.style.left = '0px';
              lineObj.style.width = '27px';
              el.insertBefore(lineObj,ta);
              lineObj.style.textAlign = 'right';
              lineObj.className='lineObj';
              var string = '';
              for(var no=0;no<200;no++){
                 if(string.length>0)string = string + '<br>';
                 string = string + no;
              }
              
              ta.onkeydown = function() { positionLineObj(lineObj,ta); };
              ta.onmousedown = function() { positionLineObj(lineObj,ta); };
              ta.onscroll = function() { positionLineObj(lineObj,ta); };
              ta.onblur = function() { positionLineObj(lineObj,ta); };
              ta.onfocus = function() { positionLineObj(lineObj,ta); };
              ta.onmouseover = function() { positionLineObj(lineObj,ta); };
              lineObj.innerHTML = string;
              
           }
           
           function positionLineObj(obj,ta)
           {
              obj.style.top = (ta.scrollTop * -1 + lineObjOffsetTop) + 'px';   
           
              
           }
           
           </script>
           
           </head>  
           <body>-->
        <?php
        $version = "0.5.5";
        /* echo "base FILE :".dirname(__FILE__);
          echo "base FILE :".realpath(__FILE__);
          echo "DOC ROOT :".$_SERVER['DOCUMENT_ROOT']; */
        if ((PHP_OS == "WIN32" ) | (PHP_OS == "WINNT" )) {
            //Separador de directorios
            $sepDirs = "\x5C";
            $eol = "\x0A\x0D";
        } else {
            $sepDirs = "\x2F";
            $eol = "\r\n";
        }
        /* $image = imagecreatetruecolor(300,300);
          //imageantialias($image, TRUE);
          //imagealphablending($image,TRUE);
          //asignar colores a la imagen

          $colorGrid = imagecolorallocate($image,0x00,0x00,0x00);
          $colorHighLight = imagecolorallocate($image,0xD9,0xE9,0xFE);
          $colorText = imagecolorallocate($image,0x00,0x00,0x01);

          //Pintar el fondo
          $colorFondo = imagecolorallocate($image,0xD9,0xE9,0xFE);
          imagefill($image,0,0, $colorFondo);

          imagepng($image, "ImagenLinux.png");
         */
        //include 'models/Graph.php';
        //include 'models/StackX.php';
        include 'models/App.php';
        
        $cont = 0;
        /* $formLista = new Application_Form_ListaRutas();
          $formLista->submit->setLabel("Generar Snapshot");
          $this->view->formLista = $formLista;
          $formData = $this->getRequest()->getPost();

          $this->view->lst = $formLista->getValue('estilo'); */

        //echo get_magic_quotes_gpc();
        $ejemploLinux = "Ejemplo Linux :" . "<br>" .
                "Notar que no va el / al inicio" . "<br>" .
                "home/" . "<br>" .
                "home/usr/" . "<br>" .
                "home/usr/bin" . "<br>" .
                "home/usr/bin/zf" . "<br>";

        $ejemploProyecto = "Ejemplo Proyecto :" . "<br>" .
                "Notar que no va el \ al inicio" . "<br>" .
                "proyectoX\application" . "<br>" .
                "proyectoX\application\config" . "<br>" .
                "proyectoX\application\config\aplication.ini" . "<br>" .
                "proyectoX\library" . "<br>" .
                "proyectoX\tests" . "<br>" .
                "proyectoX\public\.zfproject.xml" . "<br>";

        $arrayDirs0 = array();
        $arrayDirs = array();
        $archivos = array();
        $resaltado = array();
        $idNodo = 0;
        if ((PHP_OS == "WIN32" ) | (PHP_OS == "WINNT" )) {
            $archOut = "pathpics/pathpic" . rand(0, 100);
            try {
                if (file_exists($archOut . ".png")) {
                    $r1 = exec("del /Q pathpics\pathpic*.png");
                    $r2 = exec("del /Q pathpics\pathpic*.jpg");
                    $r3 = exec("del /Q pathpics\pathpic*.gif");
                }
            } catch (Exception $e) {
                
            }
        } else {
            $archOut = "pathpics/pathpic" . rand(0, 100);
            try {
                if (file_exists($archOut . ".png")) {
                    $r1 = exec("rm pathpics/pathpic*.png");
                    $r2 = exec("rm pathpics/pathpic*.jpg");
                    $r3 = exec("rm pathpics/pathpic*.gif");
                }
            } catch (Exception $e) {
                
            }
        }
        if ($_POST) {

            if (true) {
                $listaRutas = $_POST['lista']; //$formLista->getValue('lista');
                $listaFiles0 = $_POST['files']; //$formLista->getValue('files');
                $listaHighLights0 = $_POST['highlights']; //$formLista->getValue('highlights');
                //$this->view->saludo ="Hola George";
                $estilo = $_POST['estilo']; //$formLista->getValue('estilo');                
                $nroLineas = 0;
                $nroLineas2 = 0;
                //echo stripslashes($listaRutas);
                //echo $listaRutas;
                echo "<br>";
                //////////////////////////////////////////////
                echo "<center><table><tr>";
                echo "<form id=\"listaRutas\" enctype=\"application/x-www-form-urlencoded\" action=\"\" method=\"post\"><dl class=\"zend_form\">";
                //echo "<dt id=\"lista-label\"><label for=\"lista\" class=\"optional\">Escriba las rutas de directorios/archivos</label></dt>";
                echo "<td>";
                echo "<dd id=\"lista-element\">";
                echo "<textarea name=\"lista\" id=\"lista\" rows=\"25\" cols=\"80\">";
                echo stripslashes($listaRutas) . "</textarea></dd>";
                echo "</td>";
                echo "<td>";
                echo "Formato de Paths" . "<br>";
                if (strcmp($_POST['pathformat'], "Windows") == 0) {
                    echo "<input type=\"radio\" name=\"pathformat\" value=\"Windows\" checked =\"checked\" /> Windows ( backslash = \\)" . "<br>";
                    echo "<input type=\"radio\" name=\"pathformat\" value=\"Linux\"/> Linux ( forwardslash = /)";
                } else {
                    echo "<input type=\"radio\" name=\"pathformat\" value=\"Windows\" /> Windows ( backslash = \\)" . "<br>";
                    echo "<input type=\"radio\" name=\"pathformat\" value=\"Linux\" checked =\"checked\"/> Linux  forwardslash = /)";
                }

                echo "<dt id=\"estilo-label\"><label for=\"estilo\" class=\"required\">Estilo de arbol</label></dt>";
                echo "<dd id=\"estilo-element\">";
                echo "<select name=\"estilo\" id=\"estilo\">";
                if (strcmp($_POST['estilo'], "0") == 0)
                    echo "<option value=\"0\" label=\"Windows XP\" selected=\"selected\">Windows XP</option>";
                else
                    echo "<option value=\"0\" label=\"Windows XP\">Windows XP</option>";

                if (strcmp($_POST['estilo'], "1") == 0)
                    echo "<option value=\"1\" label=\"Windows 7\" selected=\"selected\">Windows 7</option>";
                else
                    echo "<option value=\"1\" label=\"Windows 7\">Windows 7</option>";

                if (strcmp($_POST['estilo'], "2") == 0)
                    echo "<option value=\"2\" label=\"Ubuntu\" selected=\"selected\">Ubuntu</option>";
                else
                    echo "<option value=\"2\" label=\"Ubuntu\">Ubuntu</option>";

                if (strcmp($_POST['estilo'], "3") == 0)
                    echo "<option value=\"3\" label=\"Netbeans\" selected=\"selected\">Netbeans</option>";
                else
                    echo "<option value=\"3\" label=\"Netbeans\" >Netbeans</option>";

                if (strcmp($_POST['estilo'], "4") == 0)
                    echo "<option value=\"4\" label=\"Eclipse\" selected=\"selected\">Eclipse</option>";
                else
                    echo "<option value=\"4\" label=\"Eclipse\" >Eclipse</option>";

                if (strcmp($_POST['estilo'], "5") == 0)
                    echo "<option value=\"5\" label=\"Mac\" selected=\"selected\">Mac</option>";
                else
                    echo "<option value=\"5\" label=\"Mac\" >Mac</option>";
                echo "</select></dd>";
                echo "<dt id=\"files-label\"><label for=\"files\" class=\"optional\">Archivos (#linea)</label></dt>";
                echo "<dd id=\"files-element\">";
                echo "<input type=\"text\" name=\"files\" id=\"files\" value=\"$listaFiles0\"></dd>";
                echo "<dt id=\"highlights-label\"><label for=\"highlights\" class=\"optional\">HighLights (#linea)</label></dt>";
                echo "<dd id=\"highlights-element\">";
                echo "<input type=\"text\" name=\"highlights\" id=\"highlights\" value=\"$listaHighLights0\"></dd>";
                echo "<dt id=\"submit-label\">&#160;</dt><dd id=\"submit-element\">";
                echo "<input type=\"submit\" name=\"submit\" id=\"submitbutton\" value=\"Generar Snapshot\"></dd></dl></form>";
                /* echo "<script type=\"text/javascript\">";
                  echo "createTextAreaWithLines(\'lista\')";
                  echo "</script>"; */
                echo "</td>";
                echo "<center>";
                echo "<div class=\"salida\">";
                echo "<table >";
                echo "<tr>";
                echo "<td><center> <font color =\"#0000FF\" ><a href=\"download.php?id=" . $archOut . ".png\"><img src=\"images/btnPNG.png\" width=\"25%\" height=\"25%\"></img></a></center></td>";
                echo "<td><center> <font color =\"#0000FF\" ><a href=\"download.php?id=" . $archOut . ".jpg\"><img src=\"images/btnJPG.png\" width=\"25%\" height=\"25%\"></img></a></center></td>";
                echo "<td><center> <font color =\"#0000FF\" ><a href=\"download.php?id=" . $archOut . ".gif\"><img src=\"images/btnGIF.png\" width=\"25%\" height=\"25%\"></img></a></center></td>";
                /* echo "<td><center> <font color =\"#0000FF\" ><a href=\"pathpic.png\"><img src=\"images/btnPNG.png\" width=\"25%\" height=\"25%\"></img></a></center></td>";                
                  echo "<td><center> <font color =\"#0000FF\" ><a href=\"pathpic.jpg\"><img src=\"images/btnJPG.png\" width=\"25%\" height=\"25%\"></img></a></center></td>";
                  echo "<td><center> <font color =\"#0000FF\" ><a href=\"pathpic.gif\"><img src=\"images/btnGIF.png\" width=\"25%\" height=\"25%\"></img></a></center></td>"; */
                echo "</tr>";
                echo "<tr><td><img src=\"" . $archOut . ".png\" ></img></td>";
                echo "<td><img src=\"" . $archOut . ".jpg\" ></img></td>";
                echo "<td><img src=\"" . $archOut . ".gif\" ></img></td>";
                echo "</tr><tr><td colspan=\"3\"><center>PathPic v " . $version . " Developed by : <a href=\"http://www.blogtucompu.wordpress.com\" target=\"_blank\">George</a></center></td></tr></table></div></center>";

                $params = array();
                //Estilo de explorador  0 = XP, 1 = W7,2=Nautilus (Ubuntu), 3 = Netbeans 4 = Mac
                $params[0] = $estilo;
                //topleveldir
                $params[1] = "C:";
                //contorno , 1 = con contorno
                $params[2] = 0;
                //path format
                $params[3] = $_POST['pathformat'];
                
                $myApp = new Application_Model_App($listaRutas, $params, $listaFiles0, $listaHighLights0, $archOut);
                
            }
        } else {



            $listaIni = "C:\\" . "\n" .
                    "C:\\apache" . "\n" .
                    "C:\\apache\\conf\\" . "\n" .
                    "C:\\apache\\conf\httpd.conf" . "\n" .
                    "C:\\apache\\htdocs\\" . "\n" .
                    "C:\\apache\\htdocs\\TreeSnapshot" . "\n" .
                    "C:\\apache\\htdocs\\TreeSnapshot\\.zfproject.xml" . "\n" .
                    "C:\\apache\\logs" . "\n" .
                    "C:\\ZendFramework\\" . "\n" .
                    "C:\\ZendFramework\\bin" . "\n" .
                    "C:\\ZendFramework\\bin\\zf.bat" . "\n" .
                    "C:\\Windows" . "\n" .
                    "C:\\Windows\\System32" . "\n" .
                    "C:\\Windows\\System32\\hh.dll" . "\n" .
                    "C:\\.metadata" . "\n" .
                    "C:\\.metadata\\.plugins\\" . "\n" .
                    "C:\\.metadata\\.plugins\\org.eclipse.rse.core" . "\n" .
                    "C:\\.metadata\\.plugins\\org.eclipse.rse.core\\.log";
            echo "<center><table><tr>";
            echo "<form id=\"listaRutas\" enctype=\"application/x-www-form-urlencoded\" action=\"\" method=\"post\"><dl class=\"zend_form\">";
            //echo "<dt id=\"lista-label\"><label for=\"lista\" class=\"optional\">Escriba las rutas de directorios/archivos</label></dt>";
            echo "<td>";
            echo "<dd id=\"lista-element\">";
            echo "<textarea name=\"lista\" id=\"lista\" rows=\"25\" cols=\"80\">";
            echo $listaIni;
            //echo $listaIni;
            echo "</textarea></dd>";
            echo "</td>";
            echo "<td>";
            echo "Formato de Paths" . "<br>";
            echo "<input type=\"radio\" name=\"pathformat\" value=\"Windows\" checked =\"checked\" /> Windows ( backslash = \\)" . "<br>";
            echo "<input type=\"radio\" name=\"pathformat\" value=\"Linux\" /> Linux ( forwardslash = /)";
            echo "<dt id=\"estilo-label\"><label for=\"estilo\" class=\"required\">Estilo de arbol</label></dt>";
            echo "<dd id=\"estilo-element\">";
            echo "<select name=\"estilo\" id=\"estilo\">";
            echo "<option value=\"0\" label=\"Windows XP\">Windows XP</option>";
            echo "<option value=\"1\" label=\"Windows 7\">Windows 7</option>";
            echo "<option value=\"2\" label=\"Ubuntu\">Ubuntu</option>";
            echo "<option value=\"3\" label=\"Netbeans\" selected=\"selected\">Netbeans</option>";
            echo "<option value=\"4\" label=\"Eclipse\" >Eclipse</option>";
            echo "<option value=\"5\" label=\"Mac\" >Mac</option>";
            echo "</select></dd>";
            echo "<dt id=\"files-label\"><label for=\"files\" class=\"optional\">Archivos (#linea)</label></dt>";
            echo "<dd id=\"files-element\">";
            echo "<input type=\"text\" name=\"files\" id=\"files\" value=\"3,6,10,13,17\"></dd>";
            echo "<dt id=\"highlights-label\"><label for=\"highlights\" class=\"optional\">HighLights (#linea)</label></dt>";
            echo "<dd id=\"highlights-element\">";
            echo "<input type=\"text\" name=\"highlights\" id=\"highlights\" value=\"3,10,17\"></dd>";
            echo "<dt id=\"submit-label\">&#160;</dt><dd id=\"submit-element\">";
            echo "<input type=\"submit\" name=\"submit\" id=\"submitbutton\" value=\"Generar Snapshot\"></dd></dl></form>";
            ?>

    <!--<script type="text/javascript">
    createTextAreaWithLines('lista')
    </script> -->            
            <?php
            /* echo "<script type=\"text/javascript\">";
              echo "createTextAreaWithLines(\'lista\')";
              echo "</script>"; */
            echo "</td>";
            echo "<center>";
            echo "<div class=\"salida\">";
            echo "<table>";
            echo "<tr>";
            echo "<td><center> <font color =\"#0000FF\" ><a href=\"download.php?id=pathpic.png\"><img src=\"images/btnPNG.png\" width=\"25%\" height=\"25%\"></img></a></center></td>";
            echo "<td><center> <font color =\"#0000FF\" ><a href=\"download.php?id=pathpic.jpg\"><img src=\"images/btnJPG.png\" width=\"25%\" height=\"25%\"></img></a></center></td>";
            echo "<td><center> <font color =\"#0000FF\" ><a href=\"download.php?id=pathpic.gif\"><img src=\"images/btnGIF.png\" width=\"25%\" height=\"25%\"></img></a></center></td>";
            /* echo "<td><center> <font color =\"#0000FF\" ><a href=\"pathpic.png\"><img src=\"images/btnPNG.png\" width=\"25%\" height=\"25%\"></img></a></center></td>";                
              echo "<td><center> <font color =\"#0000FF\" ><a href=\"pathpic.jpg\"><img src=\"images/btnJPG.png\" width=\"25%\" height=\"25%\"></img></a></center></td>";
              echo "<td><center> <font color =\"#0000FF\" ><a href=\"pathpic.gif\"><img src=\"images/btnGIF.png\" width=\"25%\" height=\"25%\"></img></a></center></td>"; */
            echo "</tr>";
            echo "<tr><td><img src=\"pathpic.png\" ></img></td>";
            echo "<td><img src=\"pathpic.jpg\" ></img></td>";
            echo "<td><img src=\"pathpic.gif\" ></img></td>";
            echo "</tr><tr><td colspan=\"3\"><center>PathPic v " . $version . " Developed by : <a href=\"http://www.blogtucompu.wordpress.com\" target=\"_blank\">George</a></center></td></tr></table></div></center>";
        }
        ?>
    </body>
</html>       