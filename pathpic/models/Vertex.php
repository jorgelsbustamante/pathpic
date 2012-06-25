<?php

class Application_Model_Vertex
{
    public $label;    
    public $esDirectorio=-1;
    public $nivel=0;
    public $nroFila=0;
    public $esExpandido=-1;
    public $vacio=1;
    public $wasVisited=-1;
    public $dirname; 
    public $basename;
    public $extension;
    public $filename;
    
    
    function __construct($p_label) {
        $this->label = $p_label;        
        $this->wasVisited=-1;
        
    }
    
    public function setWasVisited($p_wasVisited){
        $this->wasVisited=$p_wasVisited;
    }
    
    public function setLabel($p_label){
        $this->label=$p_label;
    }
    
    public function getWasVisited(){
        return $this->wasVisited;
    }
    
    public function getLabel(){
        return $this->label;
    }

}

