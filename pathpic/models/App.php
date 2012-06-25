<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
include 'Graph.php';

class Application_Model_App {

    private $graph;
    private $listaRutas;
    private $params;
    private $pathformat;
    private $files;
    private $highlights;
    private $arrayDirs;
    private $nameOutFile;

    function __construct($_listaRutas, $params, $_files, $_highlights, $nameOutFile) {
        $this->graph = new Application_Model_Graph();   
        $this->graph->setParams($params);
        $this->graph->setPathformat($params[3]);
        $this->procesar($_listaRutas, $params[3], $_files, $_highlights);       
        //$this->graph->setNroLineas();
        $this->mostrar($nameOutFile);
    }

    function procesar($listaRutas, $pathFormat, $listaFiles0, $listaHighLights0) {
        $arrayDirs0 = array();
        $arrayDirs = array();
        $archivos = array();
        $resaltado = array();
        $idNodo = 0;
        $nroLineas = 0;        
        
        if ((PHP_OS == "WIN32" ) | (PHP_OS == "WINNT" )) {
            //Separador de directorios
            $sepDirs = "\x5C";
            $eol = "\x0A\x0D";
        } else {
            $sepDirs = "\x2F";
            $eol = "\r\n";
        }
        

        if (strcmp($pathFormat, "Windows") == 0) {
            $separador = "\x5C\x5C";
        } else {
            $separador = "\x2F";
        }

        //echo "OS : ".PHP_OS."<br>";
        //echo "separador : ".$separador."<br>";
        //echo "sepDirs(SO) : ".$sepDirs."<br>";
        //$separador = "\x2F\x2F";
        /* $listaRutas2 = $listaRutas;    
          echo $listaRutas[0];
          if (strcmp($listaRutas[0], "\x2F")==0)
          //if (strpos($listaRutas, '\/')==0)
          $listaRutas2 = substr ($listaRutas, 1);
          echo "KO : -".$listaRutas2; */
        $token = strtok($listaRutas, $eol);
        //echo "token0 : ".$token."<br>";
        $nuevoToken0 = str_ireplace($separador, $sepDirs, $token);
        $nuevoToken = str_ireplace("\n", $sepDirs, $nuevoToken0);
        if ($token !== false) {
            //echo $nuevoToken."<br>";
            $arrayDirs0[] = $nuevoToken;
            $nroLineas++;
            $this->graph->addVertex("A" . $idNodo); // 0 (start for dfs)                    
            $idNodo++;
        }
        while ($token !== false) {
            //echo("$token<br>");
            //$token = strtok("\x5C\x5C");
            //$token = strtok("\x0A\x0D");
            $token = strtok($eol);

            //Reemplazar los "\\" por "\"
            $nuevoToken0 = str_ireplace($separador, $sepDirs, $token);
            $nuevoToken = str_ireplace("\n", $sepDirs, $nuevoToken0);
            //Se tiene que validar la longitud, porque al final
            //de toda la lista devuelve una cadena ""
            if (strlen($nuevoToken) > 0) {
                //echo $nuevoToken."<br>";
                $arrayDirs0[] = $nuevoToken;
                $nroLineas++;
                $this->graph->addVertex("A" . $idNodo); // 0 (start for dfs)
                $idNodo++;
            }
        }
        /* echo "Array 0 : <br>";
          foreach ($arrayDirs0 as $key => $value) {
          echo "key : ".$key." valor : ".$value."<br>";
          } */
        //////Procesar Lineas Windows /////////////////////
        //FALSE &&
        //De forma dinamica se van agregando
        //- array de paths : con setArrayDirs(arreglo)
        //- vertices del grafo : con addVertex(label,# nodo)
        
        if (strcmp($this->graph->getPhp_os(), "WIN32") == 0 | strcmp($this->graph->getPhp_os(), "WINNT") == 0) {
            $idNodo = 0;
            foreach ($arrayDirs0 as $key => $value) {
                //echo "key : ".$key."<br>";
                $posicInicio = 0;
                $nuevaRuta = "";

                //Si los 1ros caracteres son (separadorOS)(letra) ó (separadorOS)(punto)
                if (strlen($value) >= 2 && (strcmp($value[0], $sepDirs) == 0 & ( $this->graph->esLetra($value[1]) == 1 | strcmp($value[1], ".") == 0) )) {
                    $nuevaRuta = substr($value, 0, 1);
                    if ($this->graph->findLista($nuevaRuta) == -1) {
                        $arrayDirs[] = $nuevaRuta;
                        //Se actualiza el array de path para que la funcion AddVertes trabaje  con el
                        $this->graph->setArrayDirs($arrayDirs);                        
                        $this->graph->addVertex("A" . $idNodo); // 0 (start for dfs)                    
                        $idNodo++;
                    }
                    $posicInicio = 1;
                }

                //Si los 1ros caracteres son (punto)(letra) 
                if (strlen($value) >= 2 && (strcmp($value[0], ".") == 0 & $this->graph->esLetra($value[1]) == 1)) {
                    $posicInicio = 0;
                }

                //Si los 1ros caracteres son (letra)(letra) 
                if (strlen($value) >= 2 && ($this->graph->esLetra($value[0]) == 1 & $this->graph->esLetra($value[1]) == 1)) {
                    $posicInicio = 0;
                }


                //Si los 1ros caracteres son (letra)(:)
                if (strlen($value) >= 2 && ($this->graph->esLetra($value[0]) == 1 & strcmp($value[1], ":") == 0)) {
                    $nuevaRuta = substr($value, 0, 2);
                    if ($this->graph->findLista($nuevaRuta) == -1) {
                        $arrayDirs[] = $nuevaRuta;
                        $this->graph->setArrayDirs($arrayDirs);                        
                        $this->graph->addVertex("A" . $idNodo); // 0 (start for dfs)                    
                        $idNodo++;
                    }
                    $posicInicio = 2;
                }

                //Si los 1ros caracteres son (letra)(:)(separadorOS)
                if (strlen($value) >= 3 && ($this->graph->esLetra($value[0]) == 1 & strcmp($value[1], ":") == 0 & strcmp($value[2], $sepDirs) == 0)) {
                    $nuevaRuta = substr($value, 0, 2);
                    if ($this->graph->findLista($nuevaRuta) == -1) {
                        $arrayDirs[] = $nuevaRuta;
                        $this->graph->setArrayDirs($arrayDirs);                        
                        $this->graph->addVertex("A" . $idNodo); // 0 (start for dfs)                    
                        $idNodo++;
                    }
                    $posicInicio = 3;
                }
                do {

                    if (strlen($value) == $posicInicio)
                        break;
                    $elem = $this->graph->nombreElemento($posicInicio, $value, $sepDirs);
                    $nombreElem = $elem[0];
                    $posicInicio = $elem[1] + 1;
                    $nuevaRuta = substr($value, 0, $posicInicio - 1);
                    //echo "Elem : ".$nombreElem."<br>";
                    if ($this->graph->findLista($nuevaRuta) == -1) {
                        //echo "Nuevo : ".$nuevaRuta."<br>";
                        $arrayDirs[] = $nuevaRuta;
                        $this->graph->setArrayDirs($arrayDirs);                        
                        $this->graph->addVertex("A" . $idNodo); // 0 (start for dfs)                    
                        $idNodo++;
                        if (strlen($listaFiles0) > 1) {                            
                            if (array_search($key, explode(',', $listaFiles0)) !== false && $posicInicio >= strlen($value))                                                                    
                                $archivos[] = count(arrayDirs) - 1;
                            //$this->graph->getArrayDirs()
                        }
                        else {
                            //Con isset se sabe si listafiles tiene al menos un valor 
                            if (isset($listaFiles0[0]) && $key === (int) $listaFiles0 && $posicInicio >= strlen($value))
                                $archivos[] = count($arrayDirs) - 1;
                        }

                        if (strlen($listaHighLights0) > 1) {
                            if (array_search($key, explode(',', $listaHighLights0)) !== false && $posicInicio >= strlen($value))
                                $resaltado[] = count($arrayDirs) - 1;
                        }
                        else {
                            if (isset($listaHighLights0[0]) && $key === (int) $listaHighLights0 && $posicInicio >= strlen($value))
                                $resaltado[] = count($arrayDirs) - 1;
                        }
                    }
                }while ($posicInicio < strlen($value));
            }
        }
        //El sO es Linux u otro     
        if (strcmp($this->graph->getPhp_os(), "Linux") == 0) {

            $idNodo = 0;
            foreach ($arrayDirs0 as $key => $value) {
                //echo "key : ".$key."<br>";
                $posicInicio = 0;
                $nuevaRuta = "";

                //Si los 1ros caracteres son (separadorOS)(letra) ó (separadorOS)(punto)
                if (strlen($value) >= 2 && (strcmp($value[0], $sepDirs) == 0 & ( $this->graph->esLetra($value[1]) == 1 | strcmp($value[1], ".") == 0) )) {
                    $nuevaRuta = substr($value, 0, 1);
                    if ($this->graph->findLista($nuevaRuta) == -1) {
                        $arrayDirs[] = $nuevaRuta;
                        $this->graph->setArrayDirs($arrayDirs);                        
                        $this->graph->addVertex("A" . $idNodo); // 0 (start for dfs)                    
                        $idNodo++;
                    }
                    $posicInicio = 1;
                }

                //Si los 1ros caracteres son (punto)(letra) 
                if (strlen($value) >= 2 && (strcmp($value[0], ".") == 0 & $this->graph->esLetra($value[1]) == 1)) {
                    
                    $posicInicio = 0;
                }

                //Si los 1ros caracteres son (letra)(letra) 
                if (strlen($value) >= 2 && ($this->graph->esLetra($value[0]) == 1 & $this->graph->esLetra($value[1]) == 1)) {
                    
                    $posicInicio = 0;
                }


                //Si los 1ros caracteres son (letra)(:)
                if (strlen($value) >= 2 && ($this->graph->esLetra($value[0]) == 1 & strcmp($value[1], ":") == 0)) {
                    $nuevaRuta = substr($value, 0, 2);
                    if ($this->graph->findLista($nuevaRuta) == -1) {
                        $arrayDirs[] = $nuevaRuta;
                        $this->graph->setArrayDirs($arrayDirs);                        
                        $this->graph->addVertex("A" . $idNodo); // 0 (start for dfs)                    
                        $idNodo++;
                    }
                    $posicInicio = 2;
                }

                //Si los 1ros caracteres son (letra)(:)(separadorOS)
                if (strlen($value) >= 3 && ($this->graph->esLetra($value[0]) == 1 & strcmp($value[1], ":") == 0 & strcmp($value[2], $sepDirs) == 0)) {
                    $nuevaRuta = substr($value, 0, 2);
                    if ($this->graph->findLista($nuevaRuta) == -1) {
                        $arrayDirs[] = $nuevaRuta;
                        $this->graph->setArrayDirs($arrayDirs);                        
                        $this->graph->addVertex("A" . $idNodo); // 0 (start for dfs)                    
                        $idNodo++;
                    }
                    $posicInicio = 3;
                }
                do {
                    /* echo "Value : ".$value."<br>";
                      echo "Len(Value) : ".strlen($value)."<br>";
                      echo "$posicInicio : ".$posicInicio."<br>"; */
                    if (strlen($value) == $posicInicio)
                        break;
                    $elem = $this->graph->nombreElemento($posicInicio, $value, $sepDirs);
                    $nombreElem = $elem[0];
                    $posicInicio = $elem[1] + 1;
                    $nuevaRuta = substr($value, 0, $posicInicio - 1);
                    //echo "Elem : ".$nombreElem."<br>";
                    if ($this->graph->findLista($nuevaRuta) == -1) {
                        //echo "Nuevo : ".$nuevaRuta."<br>";
                        $arrayDirs[] = $nuevaRuta;
                        $this->graph->setArrayDirs($arrayDirs);                        
                        $this->graph->addVertex("A" . $idNodo); // 0 (start for dfs)                    
                        $idNodo++;
                        if (strlen($listaFiles0) > 1) {
                            if (array_search($key, explode(',', $listaFiles0)) !== false && $posicInicio >= strlen($value))
                                $archivos[] = count(arrayDirs) - 1;
                            //$this->graph->getArrayDirs()
                        }
                        else {
                            //Con isset se sabe si listafiles tiene al menos un valor
                            if (isset($listaFiles0[0]) && $key === (int) $listaFiles0 && $posicInicio >= strlen($value))
                                $archivos[] = count(arrayDirs) - 1;
                        }

                        if (strlen($listaHighLights0) > 1) {
                            if (array_search($key, explode(',', $listaHighLights0)) !== false && $posicInicio >= strlen($value))
                                $resaltado[] = count(arrayDirs) - 1;
                        }
                        else {
                            if (isset($listaHighLights0[0]) && $key === (int) $listaHighLights0 && $posicInicio >= strlen($value))
                                $resaltado[] = count(arrayDirs) - 1;
                        }
                    }
                }while ($posicInicio < strlen($value));
            }
        }
        $this->graph->setArrayDirs($arrayDirs);        
        $this->graph->setFiles($archivos);
        $this->graph->setHighLight($resaltado);        
        $this->graph->setNroLineas(count($arrayDirs));
        
        
    }

    function mostrar($archOut) {
        //Se crea la estructura del grafo        

        if ((PHP_OS == "WIN32" ) | (PHP_OS == "WINNT" )) {
            $this->graph->procesarRutasV2();
            $rutaFont = "fonts/segoeui.ttf";
            $this->graph->setRutaArchFont($rutaFont);
        } else {
            $this->graph->procesarRutasV3();
            $rutaFont = "fonts/segoeui.ttf";
            //$rutaFont = "/usr/share/fonts/truetype/ttf-dejavu/DejaVuSansMono-Bold.ttf";//OK
            //$rutaFont = "/usr/lib/X11/fonts/segoeui.ttf";//OK
            //$rutaFont = "/var/data/public/pathsnapshot/segoeui.ttf";//OK
            $this->graph->setRutaArchFont($rutaFont);
        }


        //$this->action('generar-imagenes-arbol', 'index');
        //Buscar si ya existe un archivo con el nombre que se va a dar al archivo
        //$myGraph->setRutaArchSalida("");
        $this->graph->setNombreArchSalida($archOut);

        $this->graph->mostrarArbol();
    }

}

?>
