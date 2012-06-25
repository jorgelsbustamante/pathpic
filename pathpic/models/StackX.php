<?php

class Application_Model_StackX
{
    const SIZE =100;
    public $st = array();
    public $top=-1;
    
    function __construct() {  
        for ($i=0;$i<self::SIZE;$i++)
            $this->st[] =0;
        $this->top=-1;        
    }
    
    public function push($j){
        $ni = $this->top+1;
        $this->top = $ni;        
        $this->st[$ni]=$j;
        //$this->st[$this->top];        
    }
    
    public function pop(){
        return $this->st[$this->top--];        
    }
        
    public function peek(){        
        return $this->st[$this->top];
    }
    
    public function isEmpty(){        
        return ($this->top==-1);        
    }



}

