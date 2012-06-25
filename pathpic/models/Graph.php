<?php

include 'Vertex.php';
include 'StackX.php';

class Application_Model_Graph {
    const MAX_VERTS=100; //define("CONSTANT_NAME", value [, case_sensitivity])

    private $vertexList = array();
    private $adjMat = array();
    private $nVerts;
    private $theStack;
    private $nroLineas;
    private $distancias = array();
    private $distanciasXP = array();
    private $distanciasW7 = array();
    private $distanciasN = array();
    private $distanciasNBJ = array();
    private $distanciasNBP = array();
    private $distanciasEcJ = array();
    private $distanciasEcP = array();
    private $distanciasMac = array();
    
    
    private $params = array();
    private $files = array();
    private $filesIdTree = array();
    private $highlight = array();
    private $arrayDirs = array();
    private $tamLetra = 9;
    private $rutaArchFont = "C:\Windows\Fonts\segoeui.ttf";
    private $rutaArchSalida = "";
    private $nombreArchSalida = "prueba02";
    private $extensionArchSalida = "png";
    private $php_os;
    private $pathformat;

    function __construct() {

        $this->php_os = PHP_OS;
        for ($j = 0; $j < self::MAX_VERTS; $j++) // set adjacency
        //   $this->vertexList[] = new Application_Model_Vertex('');
        //adjMat = new int[MAX_VERTS][MAX_VERTS];
            $this->nVerts = 0;
        for ($j = 0; $j < self::MAX_VERTS; $j++) // set adjacency
            for ($k = 0; $k < self::MAX_VERTS; $k++) // matrix to 0
                $this->adjMat[$j][$k] = 0;

        $this->theStack = new Application_Model_StackX();

        //Inicializando params
        for ($j = 0; $j < 4; $j++) // set adjacency
            $this->params[] = 0;


        //CONFIGURACION PARA W7
        $this->distanciasW7 = array();
        //distancias horizontales o en X
        //distancia del cuadro envolvente al margen izquierdo
        $this->distanciasW7[0][0] = 31;
        //distancia del icono expandido a la columna
        $this->distanciasW7[0][1] = 0; //17
        //distancia del icono contraido a la columna
        $this->distanciasW7[0][2] = 2; //19
        //distancia del icono directorio a la columna
        $this->distanciasW7[0][3] = 0;
        //distancia entre nombre del directorio/archivo y columna
        $this->distanciasW7[0][4] = 1;
        //ancho de columna
        $this->distanciasW7[0][5] = 10; //10
        //distancias verticales o en Y
        //distancia del cuadro envolvente al margen superior
        $this->distanciasW7[1][0] = 31;
        //distancia del icono expandido a la fila (desde la base del cuadro envolvente) 
        $this->distanciasW7[1][1] = 5; //17
        //distancia del icono contraido a la fila (desde la base del cuadro envolvente) 
        $this->distanciasW7[1][2] = 7; //19
        //distancia del icono directorio a la fila (desde la base del cuadro envolvente) 
        $this->distanciasW7[1][3] = 2;
        //distancia entre nombre del directorio/archivo y fila
        $this->distanciasW7[1][4] = 15;
        //altura de fila
        $this->distanciasW7[1][5] = 20; //20
        //CONFIGURACION PARA XP
        $this->distanciasXP = array();
        //distancias horizontales o en X
        //distancia del cuadro envolvente al margen izquierdo
        $this->distanciasXP[0][0] = 31; //8
        //distancia del icono expandido a la columna
        $this->distanciasXP[0][1] = 0; //17
        //distancia del icono contraido a la columna
        $this->distanciasXP[0][2] = 2; //19
        //distancia del icono directorio a la columna
        $this->distanciasXP[0][3] = -4;
        //distancia entre nombre del directorio/archivo y columna
        $this->distanciasXP[0][4] = -21;
        //ancho de columna
        $this->distanciasXP[0][5] = 19; //10
        //distancias verticales o en Y
        //distancia del cuadro envolvente al margen superior
        $this->distanciasXP[1][0] = 31;
        //distancia del icono expandido a la fila (desde la base del cuadro envolvente) 
        $this->distanciasXP[1][1] = 3;
        //distancia del icono contraido a la fila (desde la base del cuadro envolvente) 
        $this->distanciasXP[1][2] = 1; //19
        //distancia del icono directorio a la fila (desde la base del cuadro envolvente) 
        $this->distanciasXP[1][3] = 2;
        //distancia entre nombre del directorio/archivo y fila
        $this->distanciasXP[1][4] = 14;
        //altura de fila
        $this->distanciasXP[1][5] = 19; //20
        //CONFIGURACION PARA Nautilus
        $this->distanciasN = array();
        //distancias horizontales o en X
        //distancia del cuadro envolvente al margen izquierdo
        $this->distanciasN[0][0] = 31; //8
        //distancia del icono eNandido a la columna
        $this->distanciasN[0][1] = 0; //17
        //distancia del icono contraido a la columna
        $this->distanciasN[0][2] = 2; //19
        //distancia del icono directorio a la columna
        $this->distanciasN[0][3] = -4;
        //distancia entre nombre del directorio/archivo y columna
        $this->distanciasN[0][4] = -21;
        //ancho de columna
        $this->distanciasN[0][5] = 19; //10
        //distancias verticales o en Y
        //distancia del cuadro envolvente al margen superior
        $this->distanciasN[1][0] = 31;
        //distancia del icono eNandido a la fila (desde la base del cuadro envolvente) 
        $this->distanciasN[1][1] = 3;
        //distancia del icono contraido a la fila (desde la base del cuadro envolvente) 
        $this->distanciasN[1][2] = 1; //19
        //distancia del icono directorio a la fila (desde la base del cuadro envolvente) 
        $this->distanciasN[1][3] = 2;
        //distancia entre nombre del directorio/archivo y fila
        $this->distanciasN[1][4] = 14;
        //altura de fila
        $this->distanciasN[1][5] = 20; //20
        //CONFIGURACION PARA Netbeans
        $this->distanciasNBJ = array();
        //distancias horizontales o en X
        //distancia del cuadro envolvente al margen izquierdo
        $this->distanciasNBJ[0][0] = 31; //8
        //distancia del icono expandido a la columna
        $this->distanciasNBJ[0][1] = 0; //17
        //distancia del icono contraido a la columna
        $this->distanciasNBJ[0][2] = 2; //19
        //distancia del icono directorio a la columna
        $this->distanciasNBJ[0][3] = 0;
        //distancia entre nombre del directorio/archivo y columna
        $this->distanciasNBJ[0][4] = -8;
        //ancho de columna
        $this->distanciasNBJ[0][5] = 15; //10
        //distancias verticales o en Y
        //distancia del cuadro envolvente al margen superior
        $this->distanciasNBJ[1][0] = 31;
        //distancia del icono expandido a la fila (desde la base del cuadro envolvente) 
        $this->distanciasNBJ[1][1] = 3;
        //distancia del icono contraido a la fila (desde la base del cuadro envolvente) 
        $this->distanciasNBJ[1][2] = 1; //19
        //distancia del icono directorio a la fila (desde la base del cuadro envolvente) 
        $this->distanciasNBJ[1][3] = 2;
        //distancia entre nombre del directorio/archivo y fila
        $this->distanciasNBJ[1][4] = 15;
        //altura de fila
        $this->distanciasNBJ[1][5] = 20; //20
        //CONFIGURACION PARA Eclipse Java
        $this->distanciasEcJ = array();
        //distancias horizontales o en X
        //distancia del cuadro envolvente al margen izquierdo
        $this->distanciasEcJ[0][0] = 31; //8
        //distancia del icono expandido a la columna
        $this->distanciasEcJ[0][1] = 0; //17
        //distancia del icono contraido a la columna
        $this->distanciasEcJ[0][2] = 2; //19
        //distancia del icono directorio a la columna
        $this->distanciasEcJ[0][3] = -4;
        //distancia entre nombre del directorio/archivo y columna
        $this->distanciasEcJ[0][4] = -21;
        //ancho de columna
        $this->distanciasEcJ[0][5] = 19; //10
        //distancias verticales o en Y
        //distancia del cuadro envolvente al margen superior
        $this->distanciasEcJ[1][0] = 31;
        //distancia del icono expandido a la fila (desde la base del cuadro envolvente) 
        $this->distanciasEcJ[1][1] = 3;
        //distancia del icono contraido a la fila (desde la base del cuadro envolvente) 
        $this->distanciasEcJ[1][2] = 1; //19
        //distancia del icono directorio a la fila (desde la base del cuadro envolvente) 
        $this->distanciasEcJ[1][3] = 2;
        //distancia entre nombre del directorio/archivo y fila
        $this->distanciasEcJ[1][4] = 14;
        //altura de fila
        $this->distanciasEcJ[1][5] = 19; //20
        //CONFIGURACION PARA Eclipse PHP
        $this->distanciasEcP = array();
        //distancias horizontales o en X
        //distancia del cuadro envolvente al margen izquierdo
        $this->distanciasEcP[0][0] = 31; //8
        //distancia del icono expandido a la columna
        $this->distanciasEcP[0][1] = 0; //17
        //distancia del icono contraido a la columna
        $this->distanciasEcP[0][2] = 2; //19
        //distancia del icono directorio a la columna
        $this->distanciasEcP[0][3] = -4;
        //distancia entre nombre del directorio/archivo y columna
        $this->distanciasEcP[0][4] = -21;
        //ancho de columna
        $this->distanciasEcP[0][5] = 19; //10
        //distancias verticales o en Y
        //distancia del cuadro envolvente al margen superior
        $this->distanciasEcP[1][0] = 31;
        //distancia del icono expandido a la fila (desde la base del cuadro envolvente) 
        $this->distanciasEcP[1][1] = 3;
        //distancia del icono contraido a la fila (desde la base del cuadro envolvente) 
        $this->distanciasEcP[1][2] = 1; //19
        //distancia del icono directorio a la fila (desde la base del cuadro envolvente) 
        $this->distanciasEcP[1][3] = 2;
        //distancia entre nombre del directorio/archivo y fila
        $this->distanciasEcP[1][4] = 14;
        //altura de fila
        $this->distanciasEcP[1][5] = 19; //20
        //CONFIGURACION PARA Eclipse PHP
        $this->distanciasMac = array();
        //distancias horizontales o en X
        //distancia del cuadro envolvente al margen izquierdo
        $this->distanciasMac[0][0] = 31; //8
        //distancia del icono expandido a la columna
        $this->distanciasMac[0][1] = 0; //17
        //distancia del icono contraido a la columna
        $this->distanciasMac[0][2] = 2; //19
        //distancia del icono directorio a la columna
        $this->distanciasMac[0][3] = -4;
        //distancia entre nombre del directorio/archivo y columna
        $this->distanciasMac[0][4] = -21;
        //ancho de columna
        $this->distanciasMac[0][5] = 19; //10
        //distancias verticales o en Y
        //distancia del cuadro envolvente al margen superior
        $this->distanciasMac[1][0] = 31;
        //distancia del icono expandido a la fila (desde la base del cuadro envolvente) 
        $this->distanciasMac[1][1] = 3;
        //distancia del icono contraido a la fila (desde la base del cuadro envolvente) 
        $this->distanciasMac[1][2] = 1; //19
        //distancia del icono directorio a la fila (desde la base del cuadro envolvente) 
        $this->distanciasMac[1][3] = 2;
        //distancia entre nombre del directorio/archivo y fila
        $this->distanciasMac[1][4] = 14;
        //altura de fila
        $this->distanciasMac[1][5] = 19; //20
    }

    public function getVertexList() {
        return $this->vertexList;
    }

    public function getTheStack() {
        return $this->theStack;
    }

    public function getNVerts() {
        return $this->nVerts;
    }

    public function getPhp_os() {
        return $this->php_os;
    }

    public function addVertex($lab) {
        $this->vertexList[$this->nVerts++] = new Application_Model_Vertex($lab);
    }

    public function addEdge($start, $end) {
        //Si ya existe la ruta dirname\\basename
        //entonces no se inserta
        $this->adjMat[$start][$end] = 1; // Es un grafo dirigido para crear directorios
        //$this->adjMat[$end][$start] = 1;
    }

    public function setNroLineas($nl) {
        $this->nroLineas = $nl;
    }

    public function procesarRutas() {
        $myphpinfoi = pathinfo($this->arrayDirs[0]);
        $myphpinfoj = array();
        $tieneSubDir = -1;
        $nrob = 0;

        $this->vertexList[0]->nroFila = 0;
        $this->vertexList[0]->dirname = $myphpinfoi["dirname"];
        $this->vertexList[0]->basename = $myphpinfoi["basename"];
        $this->vertexList[0]->filename = $myphpinfoi["filename"];
        $this->vertexList[0]->esDirectorio = 1;
        $this->vertexList[0]->nivel = 0;

        //echo "OS : ".$this->php_os;
        if (strcmp($this->php_os, "WIN32") == 0 | strcmp($this->php_os, "WINNT") == 0)
            $sepDir = "\x5C";
        else
            $sepDir="\x2F";

        for ($i = 0; $i < $this->nroLineas; $i++) {
            for ($j = 0; $j < $this->nroLineas; $j++) {
                $tieneSubDir = -1;
                //Recorrer cada entrada del arreglo                
                if ($i < $j) {
                    $myphpinfoi = pathinfo($this->arrayDirs[$i]);
                    $myphpinfoj = pathinfo($this->arrayDirs[$j]);
                    //echo "ruta [$i] desde array : ".$this->arrayDirs[$i]."<br>";
                    //echo "ruta [$j] desde array : ".$this->arrayDirs[$j]."<br>";
                    /*
                      echo "dirname [$i] desde array2 : ".$myphpinfoi["dirname"]."<br>";
                      echo "basename [$i] desde array2 : ".$myphpinfoi["basename"]."<br>";
                      echo "filename [$i] desde array2 : ".$myphpinfoi["filename"]."<br>";
                      echo "extension [$i] desde array2 : ".$myphpinfoi["extension"]."<br>";
                      echo "dirname [$j] desde array2 : ".$myphpinfoj["dirname"]."<br>";
                      echo "basename [$j] desde array2 : ".$myphpinfoj["basename"]."<br>";
                      echo "filename [$j] desde array2 : ".$myphpinfoj["filename"]."<br>";
                      echo "extension [$j] desde array2 : ".$myphpinfoj["extension"]."<br>";
                     */
                    //Probar si una direccion esta incluida en otra
                    //strpos retorna la posicion y si no encuentra coincidencia devuelve false
                    //Se pone == 0 porque se busca un subdirectorio
                    $nrob++;
                    if ($i == 0)
                    //Se obtiene dirname = punto "." cuando la raiz
                    //no es del tipo c:\
                        if (strcmp($myphpinfoi["dirname"], ".") == 0)
                            $rutai = $myphpinfoi["basename"];
                        else
                            $rutai=$myphpinfoi["dirname"];
                    else {
                        //if (empty($myphpinfoi["extension"])|$this->findFiles($i)==-1){
                        if ($this->findFiles($i) == -1) {
                            //Si dirname contiene un \ al final 
                            if (strpos($myphpinfoi["dirname"], "$sepDir") === strlen($myphpinfoi["dirname"]) - 1)
                            //Solo se concatena con su basename
                                $rutai = $myphpinfoi["dirname"] . $myphpinfoi["basename"];
                            else
                            //se pone un \ en la union
                                $rutai=$myphpinfoi["dirname"] . "$sepDir" . $myphpinfoi["basename"];
                        }
                        else {
                            $rutai = $myphpinfoi["dirname"] . "$sepDir" . $myphpinfoi["basename"]; //."$sepDir".$myphpinfoj["extension"];                               
                        }
                    }

                    //if (empty($myphpinfoj["extension"])|$this->findFiles($j)==-1){
                    if ($this->findFiles($j) == -1) {
                        //En el primer nivel dirname contiene un \ final
                        if (strpos($myphpinfoj["dirname"], "$sepDir") == strlen($myphpinfoj["dirname"]) - 1)
                        //Solo se concatena con su basename
                            $rutaj = $myphpinfoj["dirname"] . $myphpinfoj["basename"];
                        else
                        //se pone un \ en la union
                            $rutaj=$myphpinfoj["dirname"] . "$sepDir" . $myphpinfoj["basename"];
                    }
                    else {
                        $rutaj = $myphpinfoj["dirname"] . "$sepDir" . $myphpinfoj["basename"]; //."$sepDir".$myphpinfoj["extension"];                               
                    }
                    //echo "[$i] PRUEBA".$rutai.", ".$rutaj. " strrpos = ".strpos($rutaj, $rutai); 
                    //echo "<br>";

                    $niveli = 0;
                    $nivelj = 0;
                    //Contar cuantos niveles tiene una ruta
                    //echo "Probando path $i : $rutai <br>";
                    $token = strtok($rutai, "$sepDir");
                    while ($token !== false) {
                        //echo("$token<br>");
                        $token = strtok("$sepDir");
                        $niveli++;
                    }
                    // echo "=============================";
                    //echo "Probando path $j : $rutaj <br>";
                    $token = strtok($rutaj, "$sepDir");
                    while ($token !== false) {
                        //echo("HUM : $token<br>");
                        $token = strtok("$sepDir");
                        $nivelj++;
                    }
                    //echo "=============================";
                    //Examinar si tiene subdirectorio o archivos
                    if ((strpos($rutaj, $rutai) >= 0) & (strpos($rutaj, $rutai) <= 2)) {
                        if (strpos($rutaj, $rutai) === false) {
                            $tieneSubDir = -1;
//                                echo "* NO ENLACE ".$rutai." => ".$rutaj; 
//                                echo "<br>";
                        } else {
                            //Se busca si ya exsite el directorio
                            if (($this->dfs($myphpinfoj["dirname"], $myphpinfoj["basename"]) == -1) & ($nivelj == $niveli + 1)) {
                                //Ahora se añade el enlace entre directorio y archivo o directorio
                                $tieneSubDir = 1;
//                                    echo "ENLACE ".$rutai." => ".$rutaj; 
//                                    echo "<br>";
                                $this->addEdge($i, $j);
                                $this->vertexList[$j]->nroFila = $j;
                                $this->vertexList[$j]->dirname = $myphpinfoj["dirname"];
                                $this->vertexList[$j]->basename = $myphpinfoj["basename"];
                                $this->vertexList[$j]->filename = $myphpinfoj["filename"];
                                $this->vertexList[$j]->nivel = $nivelj - 1;

                                //Expandir directorio i
                                $this->vertexList[$i]->esExpandido = 1;
                                $this->vertexList[$i]->vacio = -1;

                                //Verificar si es archivo 
                                //if (empty($myphpinfoj["extension"])){                        
                                if ($this->findFiles($j) == -1) {
                                    $this->vertexList[$j]->esDirectorio = 1;
                                    //Si se recorrio todos los directorios y el directorio i no tiene algun subdirectorio
                                    //entonces poner Vertice->expandido como false
                                    $this->vertexList[$j]->esExpandido = -1;
                                } else {
                                    if ($this->findFiles($j) == 1) {
                                        $this->vertexList[$j]->esDirectorio = -1;
                                        if (!empty($myphpinfoj["extension"]))
                                            $this->vertexList[$j]->extension = $myphpinfoj["extension"];
                                        //Si se recorrio todos los directorios y el directorio i no tiene algun subdirectorio
                                        //entonces poner Vertice->expandido como false
                                        $this->vertexList[$j]->esExpandido = -1;
                                    }
                                    else {
                                        $this->vertexList[$j]->esDirectorio = 1;
                                        $this->vertexList[$j]->extension = $myphpinfoj["extension"];
                                        //Si se recorrio todos los directorios y el directorio i no tiene algun subdirectorio
                                        //entonces poner Vertice->expandido como false
                                        $this->vertexList[$j]->esExpandido = -1;
                                    }
                                }
                            }
                        }
                    }
                }
            }
        }//Fin de recorrido
    }

    public function dfs($dirname, $basename) { // depth-first search                 // begin at vertex 0
        $enc = -1;
        /* echo "Dir name : ".$dirname."<br>";
          echo "Vertex   : ".$this->vertexList[0]->dirname."<br>";
          echo "basename : ".$basename."<br>";
          echo "Vertex Bn: ".$this->vertexList[0]->basename."<br>";
         */
        /*    if ( (strpos($dirname,$this->vertexList[0]->dirname)!==false)& (strpos($basename,$this->vertexList[0]->basename)!==false))
          //return 1;
          $enc=1;
         */

        if (!empty($this->vertexList[0]->basename)) {
            if ((strpos($dirname, $this->vertexList[0]->dirname) !== false) & (strpos($basename, $this->vertexList[0]->basename) !== false))
            //return 1;
                $enc = 1;
        }
        else {
            if ((strpos($dirname, $this->vertexList[0]->dirname) !== false) & (strcmp($basename, "") == 0))
            //return 1;
                $enc = 1;
        }
        $this->vertexList[0]->wasVisited = 1; // mark it
        //displayVertex(0); // display it
        $this->theStack->push(0); // push it
        while (!$this->theStack->isEmpty()) { // until stack empty,
            // get an unvisited vertex adjacent to stack top
            //$v = $this->getAdjUnvisitedVertex($this->theStack->peek() );

            $t = $this->theStack->peek();
            if (empty($t))
                $t = 0;
            $v = $this->getAdjUnvisitedVertex($t);
            if (empty($v))
                $v = 0;

            if ($v == -1) // if no such vertex,
                $this->theStack->pop();
            else { // if it exists,
                $this->vertexList[$v]->wasVisited = 1; // mark it
                //displayVertex(v); // display it
                //Si se encuentra una vertice con un dirname y base name                     
                if ((strcmp($dirname, $this->vertexList[$v]->dirname) === 0) & (strcmp($basename, $this->vertexList[$v]->basename) === 0))
                    $enc = 1;
                $this->theStack->push($v); // push it
            }
        } // end while
        // stack is empty, so we're done
        $this->theStack = new Application_Model_StackX();
        for ($j = 0; $j < $this->nVerts; $j++) // reset flags
            $this->vertexList[$j]->wasVisited = -1;
        return $enc;
    }

// end dfs
    // ------------------
    // returns an unvisited vertex adj to v

    public function getAdjUnvisitedVertex($v) {
        for ($j = 0; $j < $this->nVerts; $j++)
            if (($this->adjMat[$v][$j] == 1) && ($this->vertexList[$j]->wasVisited == -1))
                return $j;
        return -1;
    }

// end getAdjUnvisitedVert()
    // ------------------      

    public function setParams($p_params) {
        $this->params = &$p_params;
    }

    public function setArrayDirs($p_arrayDirs) {
        $this->arrayDirs = &$p_arrayDirs;
        /* for ($i=0;$i<count($p_arrayDirs);$i++)
          $this->arrayDirs[]= $p_arrayDirs[$i]; */
    }

    public function getArrayDirs() {
        return $this->arrayDirs;
    }

    public function setFilesIdTree($p_filesIdTree) {
        $this->filesIdTree = &$p_filesIdTree;
    }

    public function setFiles($p_files) {
        $this->files = &$p_files;
    }

    public function setHighLight($p_highLight) {
        $this->highlight = &$p_highLight;
    }

    public function findHighLight($val) {
        $enc = -1;
        foreach ($this->highlight as $key => $value) {
            if ($value == $val)
                $enc = 1;
        }
        return $enc;
    }

    public function findFiles($val) {
        $enc = -1;
        foreach ($this->files as $key => $value) {
            //echo "fles k->".$key." - v->".$value."<br>";
            if ($value == $val) {

                $enc = 1;
            }
        }
        return $enc;
    }

    public function findLista($nuevaRuta) {
        $enc = -1;
        foreach ($this->arrayDirs as $key => $value) {
            if (strcmp($value, $nuevaRuta) == 0)
                $enc = 1;
        }
        return $enc;
    }

    public function nombreElemento($posicInicio, $cadena, $sepSO) {
        $nombre = "";
        $fin = false;
        $pos = $posicInicio;
        $resp = array();
        //echo "Sep : ".$sep."<br>";
        //Si NO es el primer caracter de la cadena y NO es el separador de SO : \ ó /
        //if ($pos>=0 & strcmp($cadena[$pos],$sepSO)!=0 ){
        do {
            //echo "Cadena : ".$cadena[$pos]."<br>";                
            //echo "Comp : ".strcmp($cadena[$pos],$sepSO)."<br>";

            $nombre.=$cadena[$pos];
            $pos++;
            //echo "Pos : ".$pos."<br>";
        } while (($pos < strlen($cadena) && strcmp($cadena[$pos], $sepSO) !== 0));

        $resp[0] = $nombre;
        if ($pos == strlen($cadena))
            $resp[1] = $pos; // ? Otra interrogante
        else
            $resp[1] = $pos;
        //}
        //Si es el primer caracter de la cadena y es el separador de SO : \ ó /
        /* else{
          $resp[0]=$sepSO;
          $resp[1]=1;
          } */

        return $resp;
    }

    public function esLetra($car) {
        //ASCII imprimibles 32 ->126
        if ((ord($car) >= 65 & ord($car) <= 90) | (ord($car) >= 97 & ord($car) <= 122))
            return 1;
        else
            return -1;
    }

    public function getAnchoImagen() {
        $longMax = 0;
        /* for ($i=0;$i<count($this->arrayDirs);$i++)
          if (strlen($this->arrayDirs[$i])>$longMax)
          $longMax = strlen($this->arrayDirs[$i]);
         */
        for ($i = 0; $i < count($this->vertexList); $i++)
            if (!empty($this->vertexList[$i]->basename))
                if (strlen($this->vertexList[$i]->basename) > $longMax) {
                    $maxTextLong = $this->vertexList[$i]->basename;
                    $longMax = strlen($maxTextLong);
                }

        return $this->tamLetra * ($longMax + 2);
        // Calcular el ancho
        /* $box=imagettfbbox ($ldef['size'], 0, $ldef['font'], $texto);
          $width = abs(abs($box[2]) - abs($box[0])); */
        /* $box=imagettfbbox ($this->tamLetra, 0, $this->rutaArchFont, $maxTextLong);
          $width = abs(abs($box[2]) - abs($box[0]));
          return $width+20; */
    }

    public function getNivelMax() {
        $nivelMax = 0;
        for ($i = 0; $i < count($this->vertexList); $i++)
            if (($this->vertexList[$i]->nivel) > $nivelMax)
                $nivelMax = $this->vertexList[$i]->nivel;

        return $nivelMax;
    }

    public function setRutaArchSalida($p_rutaArchSalida) {
        $this->rutaArchSalida = $p_rutaArchSalida;
    }

    public function setExtensionArchSalida($p_extensionArchSalida) {
        $this->extensionArchSalida = $p_extensionArchSalida;
    }

    public function setNombreArchSalida($p_nombreArchSalida) {
        $this->nombreArchSalida = $p_nombreArchSalida;
    }

    public function setRutaArchFont($p_rutaArchFont) {
        $this->rutaArchFont = $p_rutaArchFont;
    }

    //$pathformat
    public function setPathformat($p_pathformat) {
        $this->pathformat = $p_pathformat;
    }

    public function mostrarArbol() {
        //Comenzar a Graficar
        //fill in graph parameters
        $GraphFont = 5;
        $margenX = 10;
        $margenY = 30;
        $fileDibujado = FALSE; //Indicador que ya se encontro un tipo de archivo y ya se dibujo su icono respectivo
        $arrColorHighLight = array();
        //Arreglo de directorios contraidos
        //arreglo de nodos archivo
        //params[0] : estilo
        switch ($this->params[0]) {
            case 0:
                $estiloIcono = "XP";
                $colorFondoArr = array(0xFF, 0xFF, 0xFF);
                $mostrarLineas = -1;
                $arrColorHighLight = array(0x31, 0x6A, 0xC5);
                $arrColorTextoHighLight = array(0xFF, 0xFF, 0xFF);
                $this->distancias = &$this->distanciasXP;
                /* for ($i=0;$i<count($this->distanciasXP);$i++){
                  for ($j=0;$j<count($this->distanciasXP[$i]);$j++){
                  $this->distancias[$i][$j]= $this->distanciasXP[$i][$j];
                  }
                  } */

                break;

            case 1:
                $estiloIcono = "W7";
                $colorFondoArr = array(0xFF, 0xFF, 0xFF);
                $mostrarLineas = -1;
                $arrColorHighLight = array(0xD9, 0xE9, 0xFE);
                $arrColorTextoHighLight = array(0x00, 0x00, 0x00);
                $this->distancias = &$this->distanciasW7;

                break;

            case 2:
                $estiloIcono = "Nautilus";
                $colorFondoArr = array(0xF2, 0xF1, 0xF0);
                $mostrarLineas = -1;
                $arrColorHighLight = array(0xED, 0x74, 0x42);
                $arrColorTextoHighLight = array(0xFF, 0xFF, 0xFF);
                $this->distancias = &$this->distanciasN;

                break;

            case 3:
                $estiloIcono = "NBJ";
                $colorFondoArr = array(0xFF, 0xFF, 0xFF);
                $mostrarLineas = 1;
                $arrColorHighLight = array(0xD9, 0xE9, 0xFE);
                $arrColorTextoHighLight = array(0x00, 0x00, 0x00);
                $this->distancias = &$this->distanciasNBJ;

                break;

            case 4:
                $estiloIcono = "EcJ";
                $colorFondoArr = array(0xFF, 0xFF, 0xFF);
                $mostrarLineas = -1;
                $arrColorHighLight = array(0xD9, 0xE9, 0xFE);
                $arrColorTextoHighLight = array(0x00, 0x00, 0x00);
                $this->distancias = &$this->distanciasEcJ;

                break;

            case 5:
                $estiloIcono = "Mac";
                $colorFondoArr = array(0xFF, 0xFF, 0xFF);
                $mostrarLineas = -1;
                $arrColorHighLight = array(0xD9, 0xE9, 0xFE);
                $arrColorTextoHighLight = array(0x00, 0x00, 0x00);
                $this->distancias = &$this->distanciasMac;

                break;

            default:
                $estiloIcono = "W7";
                $colorFondoArr = array(0xFF, 0xFF, 0xFF);
                $mostrarLineas = -1;
                $arrColorHighLight = array(0xD9, 0xE9, 0xFE);
                $arrColorTextoHighLight = array(0x00, 0x00, 0x00);
                $this->distancias = &$this->distanciasW7;

                break;
        }
        //Bordes + un ponderado de la cadena mas larga + nro cols*nro niveles
        $GraphWidth = (2 * $margenX) + $this->getAnchoImagen() + (($this->getNivelMax() + 2) * $this->distancias[0][5]);
        //altura = nro filas * altura de fila
        $GraphHeight = 2 * $margenY + ($this->nroLineas * $this->distancias[1][5]);
        $GraphScale = 2;

        $image = imagecreatetruecolor($GraphWidth, $GraphHeight);
        //imageantialias($image, TRUE);
        //imagealphablending($image,TRUE);
        //asignar colores a la imagen

        $colorGrid = imagecolorallocate($image, 0x00, 0x00, 0x00);
        $colorHighLight = imagecolorallocate($image, $arrColorHighLight[0], $arrColorHighLight[1], $arrColorHighLight[2]);
        $colorTextoHighLight = imagecolorallocate($image, $arrColorTextoHighLight[0], $arrColorTextoHighLight[1], $arrColorTextoHighLight[2]);
        $colorText = imagecolorallocate($image, 0x00, 0x00, 0x01);

        //Pintar el fondo
        $colorFondo = imagecolorallocate($image, $colorFondoArr[0], $colorFondoArr[1], $colorFondoArr[2]);
        imagefill($image, 0, 0, $colorFondo);
        //imagettftext($image,9,0,1,10,$colorText,$this->rutaArchFont,"distilled by : openfire");
        //Pintado de lineas punteadas del arbol////////////////////////////////////////////////////////////////////
        if ($mostrarLineas == 1) {
            $styleDashed = array_merge(array_fill(0, 1, $colorGrid), array_fill(0, 1, IMG_COLOR_TRANSPARENT));
            imagesetstyle($image, $styleDashed);
            $iconoexp = imagecreatefrompng("images/expandidoNBJ.png");

            //Para el caso de Netbeans se dibujan lineas

            $anchoExp = imagesx($iconoexp);
            $altoExp = imagesy($iconoexp);

            $linXIni = $this->distancias[0][0];
            $linYIni = $this->distancias[1][0];
            $linXFin = $this->distancias[0][0];
            $linYFin = $this->distancias[1][0];
            for ($i = 0; $i < $this->nroLineas; $i++) {
                $linXIni = $this->distancias[0][0] + (($this->vertexList[$i]->nivel) * $this->distancias[0][5]) + $anchoExp / 2;
                $linYIni = $this->distancias[1][0] + (($this->vertexList[$i]->nroFila) * $this->distancias[1][5]) + $altoExp;

                $ultVert = 0;

                for ($j = 0; $j < $this->nroLineas; $j++) {
                    if ($this->adjMat[$i][$j] == 1) {
                        $ultVert = $j;
                        //Linea del Nodo expandido a si mismo 
                        //imageline($image, $linXIni,$linYIni,$linXIni+10,$linYIni, IMG_COLOR_STYLED);

                        $linXFin = $this->distancias[0][0] + (($this->vertexList[$j]->nivel) * $this->distancias[0][5]) + $anchoExp / 2;
                        $linYFin = $this->distancias[1][0] + (($this->vertexList[$j]->nroFila) * $this->distancias[1][5]) + $altoExp;

                        //Resaltar la linea actual
                        if ($this->findHighLight($j) == 1)
                            imagefilledrectangle($image, $linXFin, $linYFin - 9, $GraphWidth - 10, $linYFin + 9, $colorHighLight);
                    }

                    //Linea de la rama del Nodo expandido a la hoja
                    //8 (u otro nro par) porque se superpone a la linea de 10 puntos de 
                    //Linea del Nodo expandido a si mismo 
                    //y asi se oculta una superposicion existente
                    //imageline($image, $linXFin,$linYFin,$linXFin+6,$linYFin, IMG_COLOR_STYLED);
                }

                if (($ultVert > 0)) {
                    //imageline($image,$linXIni,$linYIni,$linXIni,$linYFin, IMG_COLOR_STYLED);
                    imageline($image, $linXFin, $linYIni, $linXFin, $linYFin, IMG_COLOR_STYLED);
                }
                //echo "<br>";
            }
        } else {
            $styleDashed = array_merge(array_fill(0, 1, $colorGrid), array_fill(0, 1, IMG_COLOR_TRANSPARENT));
            imagesetstyle($image, $styleDashed);
            $iconoexp = imagecreatefrompng("images/expandidoNBJ.png");

            //Para el caso de Netbeans se dibujan lineas

            $anchoExp = imagesx($iconoexp);
            $altoExp = imagesy($iconoexp);

            $linXIni = $this->distancias[0][0];
            $linYIni = $this->distancias[1][0];
            $linXFin = $this->distancias[0][0];
            $linYFin = $this->distancias[1][0];
            for ($i = 0; $i < $this->nroLineas; $i++) {
                $linXIni = $this->distancias[0][0] + (($this->vertexList[$i]->nivel) * $this->distancias[0][5]) + $anchoExp / 2;
                $linYIni = $this->distancias[1][0] + (($this->vertexList[$i]->nroFila) * $this->distancias[1][5]) + $altoExp;

                $ultVert = 0;

                for ($j = 0; $j < $this->nroLineas; $j++) {
                    if ($this->adjMat[$i][$j] == 1) {
                        $ultVert = $j;
                        //Linea del Nodo expandido a si mismo 
                        //imageline($image, $linXIni,$linYIni,$linXIni+10,$linYIni, IMG_COLOR_STYLED);

                        $linXFin = $this->distancias[0][0] + (($this->vertexList[$j]->nivel) * ($this->distancias[0][5])); //+$anchoExp/2;
                        $linYFin = $this->distancias[1][0] + (($this->vertexList[$j]->nroFila) * $this->distancias[1][5]) + $altoExp;

                        //Resaltar la linea actual
                        if ($this->findHighLight($j) == 1)
                        //imagefilledrectangle ($image, $linXFin, $linYFin-7, $GraphWidth-10, $linYFin+7, $colorHighLight);
                        //(3*$this->distancias[0][5])+$this->distancias[0][4]
                            imagefilledrectangle($image, $linXFin + (3 * $this->distancias[0][5]) + $this->distancias[0][4], $linYFin - 7, $GraphWidth - 10, $linYFin + 7, $colorHighLight);
                    }
                }
            }
        }


        ///////////////////////////////////////////////////////////////////////
        // begin at vertex 0
        $this->vertexList[0]->wasVisited = 1;

        $posicX = $this->distancias[0][0];
        $posicY = $this->distancias[1][0];

        //Icono expandido

        $iconoexp = imagecreatefrompng("images/expandido" . $estiloIcono . ".png");
        imagecopy($image, $iconoexp, $posicX + $this->distancias[0][1], $posicY + $this->distancias[1][1], 0, 0, imagesx($iconoexp), imagesy($iconoexp));
        //Primera linea horizontal hacia el dir inicial
        if ($mostrarLineas == 1)
            imageline($image, $posicX + imagesx($iconoexp), $posicY + imagesy($iconoexp), $posicX + 2 * imagesy($iconoexp), $posicY + imagesy($iconoexp), IMG_COLOR_STYLED);
        //Se guardan las coordenadas del punto de inicio de la linea vertical
        $lineaVertX = $posicX;
        $lineaVertY = $posicY;
        //Mostrar en el browser una imagen de acuerdo con el tamaño
        //de la estructura del arbol
        //Aunque se puede preestablecer un tamaño promedio
        //imagecopyresampled($dst_image, $src_image, $dst_x, $dst_y, $src_x, $src_y, $dst_w, $dst_h, $src_w, $src_h)
        //Icon directorio
        if (strcmp($estiloIcono, "EcJ") == 0) { //| strcmp($estiloIcono,"NBJ")==0 Por el momento
            $iconodir = imagecreatefrompng("images/dirRoot" . $estiloIcono . ".png");
            imagecopy($image, $iconodir, $posicX + $this->distancias[0][5] + $this->distancias[0][3], $posicY + $this->distancias[1][3], 0, 0, imagesx($iconodir), imagesy($iconodir));
        } else {
            $iconodir = imagecreatefrompng("images/dirOpen" . $estiloIcono . ".png");
            imagecopy($image, $iconodir, $posicX + $this->distancias[0][5] + $this->distancias[0][3], $posicY + $this->distancias[1][3], 0, 0, imagesx($iconodir), imagesy($iconodir));
        }
        //Se muestra el primer nodo
        //TextoPrimer nodo
        $nodoCeroText = "";
        if (strcmp($this->pathformat, "Windows") == 0) {
            if (!empty($this->vertexList[0]->basename))
                $nodoCeroText = $this->vertexList[0]->basename;
            else
                $nodoCeroText="\x5C";
        }
        else {
            if (!empty($this->vertexList[0]->basename))
                $nodoCeroText = $this->vertexList[0]->basename;
            else
                $nodoCeroText="\x2F";
        }
        if ($this->findHighLight(0) == 1)
            imagettftext($image, $this->tamLetra, 0, $posicX + (3 * $this->distancias[0][5]) + $this->distancias[0][4], $posicY + $this->distancias[1][4], $colorTextoHighLight, $this->rutaArchFont, $nodoCeroText);
        else
            imagettftext($image, $this->tamLetra, 0, $posicX + (3 * $this->distancias[0][5]) + $this->distancias[0][4], $posicY + $this->distancias[1][4], $colorText, $this->rutaArchFont, $nodoCeroText);
        //imagettftext($image,$this->tamLetra,0,$posicX + (3*$this->distancias[0][5]) + $this->distancias[0][4],$posicY + $this->distancias[1][4],$colorText,$this->rutaArchFont,"KPS");
        //$this->theStack();
        $this->theStack->push(0); // push it
        //$nivelSubDir++;s
        while (!$this->theStack->isEmpty()) { // until stack empty,
            // get an unvisited vertex adjacent to stack top
            //    foreach ($this->theStack->st as $key => $value) {
            //        echo "key :".$key." * "." value ".$value."<br>";
            //    }
            $fileDibujado = FALSE;
            $t = $this->theStack->peek();
            //echo "T : ".$t."<br>";
            if (empty($t))
                $t = 0;
            $v = $this->getAdjUnvisitedVertex($t);
            //echo "V : ".$v."<br>";
            if (empty($v))
                $v = 0;
            //$this->view->peek = $this->theStack->peek();
            //INSERTAR CODIGO PARA NRO FILA ++
            //MARCAR COMO DIRECTORIO
            if ($v == -1) {// if no such vertex,        
                $this->theStack->pop();
                //Disminuir el nivel del subdirectorios        
                //INSERTAR CODIGO PARA NO EXPANDIDO
                //SI TIENE EXTENSION MARCAR COMO ARCHIVO
            } else { // if it exists,
                //INSERTAR CODIGO PARA NO EXPANDIDO
                //INSERTAR CODIGO PARA NIVEL++
                //Si este archivo         
                //Marcar como visitado
                $this->vertexList[$v]->wasVisited = 1; // mark it

                $posicX = $this->distancias[0][0] + ($this->distancias[0][5] * $this->vertexList[$v]->nivel);
                $posicY = $this->distancias[1][0] + ($this->distancias[1][5] * $this->vertexList[$v]->nroFila);
                //Si el estilo es NetBeans
                if ($mostrarLineas == 1)
                    imageline($image, $posicX + (imagesx($iconoexp) / 2), $posicY + imagesy($iconoexp), $posicX + 1.5 * imagesx($iconoexp), $posicY + imagesy($iconoexp), IMG_COLOR_STYLED);
                //Colocar un icono segun sea archivo o directorio
                //Para cada fila hay 3 columnas , 0 = icono exp/contr
                //1 = icono directorio, 2 vacio y 3 = nombre directorio
                $anchoExp = 0;
                if ($this->vertexList[$v]->esDirectorio == 1) {
                    if ($this->vertexList[$v]->vacio == -1) {
                        $iconoexp = imagecreatefrompng("images/expandido" . $estiloIcono . ".png");
                        imagecopy($image, $iconoexp, $posicX, $posicY + $this->distancias[1][1], 0, 0, imagesx($iconoexp), imagesy($iconoexp));
                        $anchoExp = imagesx($iconoexp);
                        if ($estiloIcono == "Nautilus")
                            $iconodir = imagecreatefrompng("images/dirOpen" . $estiloIcono . ".png");
                        else
                            $iconodir = imagecreatefrompng("images/dir" . $estiloIcono . ".png");
                        //
                        imagecopy($image, $iconodir, $posicX + $this->distancias[0][5] + $this->distancias[0][3], $posicY + $this->distancias[1][3], 0, 0, imagesx($iconodir), imagesy($iconodir));
                    }else {
                        if ($estiloIcono == "Nautilus" | $estiloIcono == "W7") {
                            $iconoexp = imagecreatefrompng("images/contraido" . $estiloIcono . ".png");
                            imagecopy($image, $iconoexp, $posicX, $posicY + $this->distancias[1][1], 0, 0, imagesx($iconoexp), imagesy($iconoexp));
                            $anchoExp = imagesx($iconoexp);
                            $iconodir = imagecreatefrompng("images/dir" . $estiloIcono . ".png");
                            //
                            imagecopy($image, $iconodir, $posicX + $this->distancias[0][5] + $this->distancias[0][3], $posicY + $this->distancias[1][3], 0, 0, imagesx($iconodir), imagesy($iconodir));
                        } else {
                            $iconodir = imagecreatefrompng("images/dir" . $estiloIcono . ".png");
                            //
                            imagecopy($image, $iconodir, $posicX + $this->distancias[0][5] + $this->distancias[0][3], $posicY + $this->distancias[1][3], 0, 0, imagesx($iconodir), imagesy($iconodir));
                            //imageline($image, $lineaVertX, $lineaVertY, $lineaVertX-10, $lineaVertY, $colorText);         
                        }
                    }
                } else {

                    if ($estiloIcono == "EcJ") {
                        if (strcmp(strtoupper($this->vertexList[$v]->extension), "JAVA") == 0) {
                            $iconoarch = imagecreatefrompng("images/fileJ" . $estiloIcono . ".png");
                            imagecopy($image, $iconoarch, $posicX + $this->distancias[0][5] + $this->distancias[0][3], $posicY + $this->distancias[1][3], 0, 0, imagesx($iconoarch), imagesy($iconoarch));
                            $fileDibujado = TRUE; //Indicador que ya se encontro un tipo de archivo y ya se dibujo su icono respectivo
                        }
                        if (strcmp(strtoupper($this->vertexList[$v]->extension), "PHP") == 0) {
                            //$iconoarch = imagecreatefrompng("images/fileP".$estiloIcono.".png");	
                            //archTxtNB
                            $iconoarch = imagecreatefrompng("images/archTxtNB.png");
                            imagecopy($image, $iconoarch, $posicX + $this->distancias[0][5] + $this->distancias[0][3], $posicY + $this->distancias[1][3], 0, 0, imagesx($iconoarch), imagesy($iconoarch));
                            $fileDibujado = TRUE; //Indicador que ya se encontro un tipo de archivo y ya se dibujo su icono respectivo
                        }
                    }

                    if ($estiloIcono == "NBJ") {
                        if (strcmp(strtoupper($this->vertexList[$v]->extension), "JAVA") == 0) {
                            $iconoarch = imagecreatefromjpeg("images/fileJ" . $estiloIcono . ".jpg");
                            imagecopy($image, $iconoarch, $posicX + $this->distancias[0][5] + $this->distancias[0][3], $posicY + $this->distancias[1][3], 0, 0, imagesx($iconoarch), imagesy($iconoarch));
                            $fileDibujado = TRUE; //Indicador que ya se encontro un tipo de archivo y ya se dibujo su icono respectivo
                        }
                        if (strcmp(strtoupper($this->vertexList[$v]->extension), "PHP") == 0) {
                            //$iconoarch = imagecreatefrompng("fileP".$estiloIcono.".png");	
                            //archTxtNB
                            $iconoarch = imagecreatefrompng("images/archTxtNB.png");
                            imagecopy($image, $iconoarch, $posicX + $this->distancias[0][5] + $this->distancias[0][3], $posicY + $this->distancias[1][3], 0, 0, imagesx($iconoarch), imagesy($iconoarch));
                            $fileDibujado = TRUE; //Indicador que ya se encontro un tipo de archivo y ya se dibujo su icono respectivo
                        }
                    }

                    if ($estiloIcono == "Mac") {
                        $iconoarch = imagecreatefrompng("images/file" . $estiloIcono . ".png");
                        imagecopy($image, $iconoarch, $posicX + $this->distancias[0][5] + $this->distancias[0][3], $posicY + $this->distancias[1][3], 0, 0, imagesx($iconoarch), imagesy($iconoarch));
                        $fileDibujado = TRUE; //Indicador que ya se encontro un tipo de archivo y ya se dibujo su icono respectivo
                    }

                    if (($estiloIcono == "XP" | $estiloIcono == "W7" | $estiloIcono == "Nautilus" | $estiloIcono == "NBJ" | $estiloIcono == "EcJ") & $fileDibujado === FALSE) {
                        $iconoarch = imagecreatefrompng("images/archTxtNB.png");
                        imagecopy($image, $iconoarch, $posicX + $this->distancias[0][5] + $this->distancias[0][3], $posicY + $this->distancias[1][3], 0, 0, imagesx($iconoarch), imagesy($iconoarch));
                    }
                }
                if ($this->findHighLight($v) == 1)
                    imagettftext($image, $this->tamLetra, 0, $posicX + (3 * $this->distancias[0][5]) + $this->distancias[0][4], $posicY + $this->distancias[1][4], $colorTextoHighLight, $this->rutaArchFont, $this->vertexList[$v]->basename);
                else
                //imagettftext($image,$this->tamLetra,0,$posicX + (3*$this->distancias[0][5]) + $this->distancias[0][4],$posicY + $this->distancias[1][4],$colorText,$this->rutaArchFont,$nodoCeroText);
                    imagettftext($image, $this->tamLetra, 0, $posicX + (3 * $this->distancias[0][5]) + $this->distancias[0][4], $posicY + $this->distancias[1][4], $colorText, $this->rutaArchFont, $this->vertexList[$v]->basename);
                $this->theStack->push($v); // push it
            }
        } // end while

        $dxArchSalida = pathinfo($this->rutaArchSalida);
        // if ($dxArchSalida['extension']=="png")
        //Se crea el grafico
        imagepng($image, $this->nombreArchSalida . ".png");

        //if ($dxArchSalida['extension']=="jpeg" | $dxArchSalida['extension']=="jpg")
        //Se crea el grafico
        imagejpeg($image, $this->nombreArchSalida . ".jpg");

        //if ($dxArchSalida['extension']=="gif" )
        //Se crea el grafico
        imagegif($image, $this->nombreArchSalida . ".gif");

        imagedestroy($image);
    }

    //Procesar rutas en Windows
    public function procesarRutasV2() {
        $myphpinfoi = pathinfo($this->arrayDirs[0]);
        $myphpinfoj = array();
        $tieneSubDir = -1;
        $nrob = 0;
        //////////////
        $niveli = 0;
        $nivelj = 0;
        if (strcmp($this->php_os, "WIN32") == 0 | strcmp($this->php_os, "WINNT") == 0)
            $sepDir = "\x5C";
        else
            $sepDir="\x2F";

        //Contar cuantos niveles tiene una ruta
        //echo "Probando path $i : $rutai <br>";
        /* $token = strtok($rutai,$sepDir);
          while ($token !== false) {
          //echo("$token<br>");
          $token = strtok($sepDir);
          $niveli++;
          } */

        $this->vertexList[0]->nroFila = 0;
        $this->vertexList[0]->dirname = $myphpinfoi["dirname"];
        $this->vertexList[0]->basename = $myphpinfoi["basename"];
        $this->vertexList[0]->filename = $myphpinfoi["filename"];
        if (!empty($myphpinfoi["extension"]))
            $this->vertexList[0]->extension = $myphpinfoi["extension"];

        if ($this->findFiles(0) == 1)//si es archivo
            $this->vertexList[0]->esDirectorio = -1;
        else
            $this->vertexList[0]->esDirectorio = 1;
        $this->vertexList[0]->nivel = 0;



        for ($i = 0; $i < $this->nroLineas; $i++) {
            for ($j = 1; $j < $this->nroLineas; $j++) {
                $tieneSubDir = -1;
                //Recorrer cada entrada del arreglo                
                if ($i != $j) {
                    $myphpinfoi = pathinfo($this->arrayDirs[$i]);
                    $myphpinfoj = pathinfo($this->arrayDirs[$j]);

                    //Probar si una direccion esta incluida en otra
                    //strpos retorna la posicion y si no encuentra coincidencia devuelve false
                    //Se pone == 0 porque se busca un subdirectorio
                    $nrob++;
                    if ($i == 0)
                    //Se obtiene dirname = punto "." cuando la raiz
                    //no es del tipo c:\
                        if (strcmp($myphpinfoi["dirname"], ".") == 0)
                            $rutai = $myphpinfoi["basename"];
                        else
                            $rutai=$myphpinfoi["dirname"];
                    else {
                        //if (empty($myphpinfoi["extension"])|$this->findFiles($i)==-1){
                        if ($this->findFiles($i) == -1) {
                            //Si dirname contiene un \ al final 
                            if (strpos($myphpinfoi["dirname"], "$sepDir") === strlen($myphpinfoi["dirname"]) - 1)
                            //Solo se concatena con su basename
                                $rutai = $myphpinfoi["dirname"] . $myphpinfoi["basename"];
                            else
                            //se pone un \ en la union
                                $rutai=$myphpinfoi["dirname"] . $sepDir . $myphpinfoi["basename"];
                        }
                        else {
                            if (strcmp($myphpinfoi["dirname"], $sepDir) == 0)
                                $rutai = $myphpinfoi["dirname"] . $myphpinfoi["basename"]; //."$sepDir".$myphpinfoj["extension"];                               
                            else
                                $rutai=$myphpinfoi["dirname"] . $sepDir . $myphpinfoi["basename"]; //."$sepDir".$myphpinfoj["extension"];                               

                                
//  $rutai=$myphpinfoi["dirname"].$sepDir.$myphpinfoi["basename"];//."$sepDir".$myphpinfoj["extension"];                               
                        }
                    }

                    //if (empty($myphpinfoj["extension"])|$this->findFiles($j)==-1){
                    if ($this->findFiles($j) == -1) {
                        //En el primer nivel dirname contiene un \ final
                        if (strpos($myphpinfoj["dirname"], $sepDir) == strlen($myphpinfoj["dirname"]) - 1)
                        //Solo se concatena con su basename
                            $rutaj = $myphpinfoj["dirname"] . $myphpinfoj["basename"];
                        else
                        //se pone un \ en la union
                            $rutaj=$myphpinfoj["dirname"] . $sepDir . $myphpinfoj["basename"];
                    }
                    else {
                        if (strcmp($myphpinfoj["dirname"], $sepDir) == 0)
                            $rutaj = $myphpinfoj["dirname"] . $myphpinfoj["basename"]; //."$sepDir".$myphpinfoj["extension"];                               
                        else
                            $rutaj=$myphpinfoj["dirname"] . $sepDir . $myphpinfoj["basename"]; //."$sepDir".$myphpinfoj["extension"];                               
                            
//echo "CERO";
                    }
                    /* echo "[$i] PRUEBA ".$rutai.", ".$rutaj. " strrpos = ".strpos($rutaj, $rutai); 
                      echo "<br>";
                      echo "dirname [$i] desde array2 : ".$myphpinfoi["dirname"]."<br>";
                      echo "basename [$i] desde array2 : ".$myphpinfoi["basename"]."<br>";
                      echo "filename [$i] desde array2 : ".$myphpinfoi["filename"]."<br>";
                      echo "extension [$i] desde array2 : ".$myphpinfoi["extension"]."<br>";
                      echo "dirname [$j] desde array2 : ".$myphpinfoj["dirname"]."<br>";
                      echo "basename [$j] desde array2 : ".$myphpinfoj["basename"]."<br>";
                      echo "filename [$j] desde array2 : ".$myphpinfoj["filename"]."<br>";
                      echo "extension [$j] desde array2 : ".$myphpinfoj["extension"]."<br>";
                     */
                    //Si la ruta comienza con un separador de sistema
                    if (strcmp($this->vertexList[0]->dirname, $sepDir) == 0) {
                        $niveli = 1;
                        $nivelj = 1;
                    } else {
                        $niveli = 0;
                        $nivelj = 0;
                    }
                    //Contar cuantos niveles tiene una ruta
                    //echo "Probando path $i : $rutai <br>";
                    $token = strtok($rutai, $sepDir);

                    while ($token !== false) {
                        //echo "nivel : ".$token."<br>";
                        $token = strtok($sepDir);
                        $niveli++;
                    }
                    // echo "=============================";
                    //echo "Probando path $j : $rutaj <br>";
                    $token = strtok($rutaj, $sepDir);
                    while ($token !== false) {
                        //echo("HUM : $token<br>");
                        $token = strtok($sepDir);
                        $nivelj++;
                    }
                    //echo "=============================";

                    /* ===========En los sgtes IFS se validara la ruta con su correspondiente 
                     * indice que indica si es archivo=================================================== */

                    //Examinar si tiene subdirectorio o archivos
                    if ((strpos($rutaj, $rutai) == 0)) {
                        if (strpos($rutaj, $rutai) === false) {
                            $tieneSubDir = -1;
//                                echo "* NO ENLACE ".$rutai." => ".$rutaj; 
//                                echo "<br>";
                        } else {
                            //Se busca si ya existe el directorio
                            //Si el basename no esta vacio (para el caso de \ ó /)
                            if ((!empty($myphpinfoj["basename"])) & ($this->dfs($myphpinfoj["dirname"], $myphpinfoj["basename"]) == -1) & ($nivelj == $niveli + 1)) {
                                //Ahora se añade el enlace entre directorio y archivo o directorio
                                $tieneSubDir = 1;
//                                    echo "ENLACE ".$rutai." => ".$rutaj; 
//                                    echo "<br>";
                                $this->addEdge($i, $j);
                                $this->vertexList[$j]->nroFila = $j;
                                $this->vertexList[$j]->dirname = $myphpinfoj["dirname"];
                                $this->vertexList[$j]->basename = $myphpinfoj["basename"];
                                $this->vertexList[$j]->filename = $myphpinfoj["filename"];
                                $this->vertexList[$j]->nivel = $nivelj - 1;

                                //Expandir directorio i
                                $this->vertexList[$i]->esExpandido = 1;
                                $this->vertexList[$i]->vacio = -1;

                                //Verificar si es archivo 
                                //if (empty($myphpinfoj["extension"])){                        
                                if ($this->findFiles($j) == -1) {
                                    $this->vertexList[$j]->esDirectorio = 1;
                                    //Si se recorrio todos los directorios y el directorio i no tiene algun subdirectorio
                                    //entonces poner Vertice->expandido como false
                                    $this->vertexList[$j]->esExpandido = -1;
                                } else {
                                    if ($this->findFiles($j) == 1) {
                                        $this->vertexList[$j]->esDirectorio = -1;
                                        if (!empty($myphpinfoj["extension"]))
                                            $this->vertexList[$j]->extension = $myphpinfoj["extension"];
                                        //Si se recorrio todos los directorios y el directorio i no tiene algun subdirectorio
                                        //entonces poner Vertice->expandido como false
                                        $this->vertexList[$j]->esExpandido = -1;
                                    }
                                    else {
                                        $this->vertexList[$j]->esDirectorio = 1;
                                        if (!empty($myphpinfoj["extension"]))
                                            $this->vertexList[$j]->extension = $myphpinfoj["extension"];
                                        //Si se recorrio todos los directorios y el directorio i no tiene algun subdirectorio
                                        //entonces poner Vertice->expandido como false
                                        $this->vertexList[$j]->esExpandido = -1;
                                    }
                                }
                            }
                        }
                    }
                }
            }
        }//Fin de recorrido
    }

    //Procesar Rutas en Linux
    public function procesarRutasV3() {
        $myphpinfoi = pathinfo($this->arrayDirs[0]);
        $myphpinfoj = array();
        $tieneSubDir = -1;
        $nrob = 0;
        //////////////
        $niveli = 0;
        $nivelj = 0;
        if (strcmp($this->php_os, "WIN32") == 0 | strcmp($this->php_os, "WINNT") == 0)
            $sepDir = "\x5C";
        else
            $sepDir="\x2F";

        //Contar cuantos niveles tiene una ruta
        //echo "Probando path $i : $rutai <br>";
        /* $token = strtok($rutai,$sepDir);
          while ($token !== false) {
          //echo("$token<br>");
          $token = strtok($sepDir);
          $niveli++;
          } */

        $this->vertexList[0]->nroFila = 0;
        $this->vertexList[0]->dirname = $myphpinfoi["dirname"];
        $this->vertexList[0]->basename = $myphpinfoi["basename"];
        $this->vertexList[0]->filename = $myphpinfoi["filename"];
        if (!empty($myphpinfoi["extension"]))
            $this->vertexList[0]->extension = $myphpinfoi["extension"];

        if ($this->findFiles(0) == 1)//si es archivo
            $this->vertexList[0]->esDirectorio = -1;
        else
            $this->vertexList[0]->esDirectorio = 1;
        $this->vertexList[0]->nivel = 0;



        for ($i = 0; $i < $this->nroLineas; $i++) {
            for ($j = 1; $j < $this->nroLineas; $j++) {
                $tieneSubDir = -1;
                //Recorrer cada entrada del arreglo                
                if ($i != $j) {
                    $myphpinfoi = pathinfo($this->arrayDirs[$i]);
                    $myphpinfoj = pathinfo($this->arrayDirs[$j]);

                    //Probar si una direccion esta incluida en otra
                    //strpos retorna la posicion y si no encuentra coincidencia devuelve false
                    //Se pone == 0 porque se busca un subdirectorio
                    $nrob++;
                    if ($i == 0)
                    //En Linux se obtiene dirname = punto "." cuando la raiz
                    //no es del tipo /
                        if (strcmp($myphpinfoi["dirname"], ".") == 0)
                            $rutai = $myphpinfoi["basename"];
                        else
                            $rutai=$myphpinfoi["dirname"];
                    else {
                        //if (empty($myphpinfoi["extension"])|$this->findFiles($i)==-1){
                        if ($this->findFiles($i) == -1) {
                            //Si dirname contiene un \ al final 
                            if (strpos($myphpinfoi["dirname"], "$sepDir") === strlen($myphpinfoi["dirname"]) - 1)
                            //Solo se concatena con su basename
                                $rutai = $myphpinfoi["dirname"] . $myphpinfoi["basename"];
                            else
                            //se pone un \ en la union
                                $rutai=$myphpinfoi["dirname"] . $sepDir . $myphpinfoi["basename"];
                        }
                        else {
                            if (strcmp($myphpinfoi["dirname"], $sepDir) == 0)
                                $rutai = $myphpinfoi["dirname"] . $myphpinfoi["basename"]; //."$sepDir".$myphpinfoj["extension"];                               
                            else
                                $rutai=$myphpinfoi["dirname"] . $sepDir . $myphpinfoi["basename"]; //."$sepDir".$myphpinfoj["extension"];                               

                                
//  $rutai=$myphpinfoi["dirname"].$sepDir.$myphpinfoi["basename"];//."$sepDir".$myphpinfoj["extension"];                               
                        }
                    }

                    //if (empty($myphpinfoj["extension"])|$this->findFiles($j)==-1){
                    if ($this->findFiles($j) == -1) {
                        //En el primer nivel dirname contiene un \ final
                        if (strpos($myphpinfoj["dirname"], $sepDir) == strlen($myphpinfoj["dirname"]) - 1)
                        //Solo se concatena con su basename
                            $rutaj = $myphpinfoj["dirname"] . $myphpinfoj["basename"];
                        else
                        //se pone un \ en la union
                            $rutaj=$myphpinfoj["dirname"] . $sepDir . $myphpinfoj["basename"];
                    }
                    else {
                        if (strcmp($myphpinfoj["dirname"], $sepDir) == 0)
                            $rutaj = $myphpinfoj["dirname"] . $myphpinfoj["basename"]; //."$sepDir".$myphpinfoj["extension"];                               
                        else
                            $rutaj=$myphpinfoj["dirname"] . $sepDir . $myphpinfoj["basename"]; //."$sepDir".$myphpinfoj["extension"];                               
                            
//echo "CERO";
                    }
                    /* echo "[$i] PRUEBA ".$rutai.", ".$rutaj. " strrpos = ".strpos($rutaj, $rutai); 
                      echo "<br>";
                      echo "dirname [$i] desde array2 : ".$myphpinfoi["dirname"]."<br>";
                      echo "basename [$i] desde array2 : ".$myphpinfoi["basename"]."<br>";
                      echo "filename [$i] desde array2 : ".$myphpinfoi["filename"]."<br>";
                      echo "extension [$i] desde array2 : ".$myphpinfoi["extension"]."<br>";
                      echo "dirname [$j] desde array2 : ".$myphpinfoj["dirname"]."<br>";
                      echo "basename [$j] desde array2 : ".$myphpinfoj["basename"]."<br>";
                      echo "filename [$j] desde array2 : ".$myphpinfoj["filename"]."<br>";
                      echo "extension [$j] desde array2 : ".$myphpinfoj["extension"]."<br>";
                     */
                    //Si la ruta comienza con un separador de sistema
                    if (strcmp($this->vertexList[0]->dirname, $sepDir) == 0) {
                        $niveli = 1;
                        $nivelj = 1;
                    } else {
                        $niveli = 0;
                        $nivelj = 0;
                    }
                    //Contar cuantos niveles tiene una ruta
                    //echo "Probando path $i : $rutai <br>";
                    $token = strtok($rutai, $sepDir);

                    while ($token !== false) {
                        //echo "nivel : ".$token."<br>";
                        $token = strtok($sepDir);
                        $niveli++;
                    }
                    // echo "=============================";
                    //echo "Probando path $j : $rutaj <br>";
                    $token = strtok($rutaj, $sepDir);
                    while ($token !== false) {
                        //echo("HUM : $token<br>");
                        $token = strtok($sepDir);
                        $nivelj++;
                    }
                    //echo "=============================";
                    //Examinar si tiene subdirectorio o archivos
                    if ((strpos($rutaj, $rutai) == 0)) {
                        if (strpos($rutaj, $rutai) === false) {
                            $tieneSubDir = -1;
//                                echo "* NO ENLACE ".$rutai." => ".$rutaj; 
//                                echo "<br>";
                        } else {
                            //Se busca si ya existe el directorio
                            //Si el basename no esta vacio (para el caso de \ ó /)
                            if ((!empty($myphpinfoj["basename"])) & ($this->dfs($myphpinfoj["dirname"], $myphpinfoj["basename"]) == -1) & ($nivelj == $niveli + 1)) {
                                //Ahora se añade el enlace entre directorio y archivo o directorio
                                $tieneSubDir = 1;
//                                    echo "ENLACE ".$rutai." => ".$rutaj; 
//                                    echo "<br>";
                                $this->addEdge($i, $j);
                                $this->vertexList[$j]->nroFila = $j;
                                $this->vertexList[$j]->dirname = $myphpinfoj["dirname"];
                                $this->vertexList[$j]->basename = $myphpinfoj["basename"];
                                $this->vertexList[$j]->filename = $myphpinfoj["filename"];
                                $this->vertexList[$j]->nivel = $nivelj - 1;

                                //Expandir directorio i
                                $this->vertexList[$i]->esExpandido = 1;
                                $this->vertexList[$i]->vacio = -1;

                                //Verificar si es archivo 
                                //if (empty($myphpinfoj["extension"])){                        
                                if ($this->findFiles($j) == -1) {
                                    $this->vertexList[$j]->esDirectorio = 1;
                                    //Si se recorrio todos los directorios y el directorio i no tiene algun subdirectorio
                                    //entonces poner Vertice->expandido como false
                                    $this->vertexList[$j]->esExpandido = -1;
                                } else {
                                    if ($this->findFiles($j) == 1) {
                                        $this->vertexList[$j]->esDirectorio = -1;
                                        if (!empty($myphpinfoj["extension"]))
                                            $this->vertexList[$j]->extension = $myphpinfoj["extension"];
                                        //Si se recorrio todos los directorios y el directorio i no tiene algun subdirectorio
                                        //entonces poner Vertice->expandido como false
                                        $this->vertexList[$j]->esExpandido = -1;
                                    }
                                    else {
                                        $this->vertexList[$j]->esDirectorio = 1;
                                        if (!empty($myphpinfoj["extension"]))
                                            $this->vertexList[$j]->extension = $myphpinfoj["extension"];
                                        //Si se recorrio todos los directorios y el directorio i no tiene algun subdirectorio
                                        //entonces poner Vertice->expandido como false
                                        $this->vertexList[$j]->esExpandido = -1;
                                    }
                                }
                            }
                        }
                    }
                }
            }
        }//Fin de recorrido
    }

    public function crearRuta($rutaDesdeArray) {
        $myphpinfo = pathinfo($rutaDesdeArray);
        $ruta = "";
        if ($i == 0)
        //Se obtiene dirname = punto "." cuando la raiz
        //no es del tipo c:\
            if (strcmp($myphpinfo["dirname"], ".") == 0)
                $ruta = $myphpinfo["basename"];
            else
                $ruta=$myphpinfo["dirname"];
        else {
            //if (empty($myphpinfoi["extension"])|$this->findFiles($i)==-1){
            if ($this->findFiles($i) == -1) {
                //Si dirname contiene un \ al final 
                if (strpos($myphpinfo["dirname"], "\x5C") === strlen($myphpinfo["dirname"]) - 1)
                //Solo se concatena con su basename
                    $ruta = $myphpinfo["dirname"] . $myphpinfo["basename"];
                else
                //se pone un \ en la union
                    $ruta=$myphpinfo["dirname"] . "\x5C" . $myphpinfo["basename"];
            }
            else {
                $ruta = $myphpinfo["dirname"] . "\x5C" . $myphpinfo["basename"]; //."\x5C".$myphpinfoj["extension"];                               
            }
        }

        return $ruta;
    }

}

