<?php

/**********
 * App Core Class
 * Creates URL & Loads Core Controler
 * URL: /controller/method/params
 *********/

class Core {
    protected $currentController = "Pages";
    protected $currentMethod = "index";
    protected $params = [];
    
    public function __construct()
    {
        $this->getURL();
    }
    public function getURL()
    {
        if()
    }
}