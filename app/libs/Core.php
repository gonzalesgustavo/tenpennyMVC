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
        //print_r($this->getURL());
        //--> assign the url
        $url = $this->getURL();
        $this->checkController($url);
        try
        {
          $path = '../app/controllers/' . $this->currentController . '.controller.php';

          if(file_exists($path))
          {
            require_once($path);
            //--> init controller
            $this->currentController = new $this->currentController;
          }
          else{
            throw new Exception('controller does not exist');
          }
        }
        catch (Exception $req_ex)
        {
          echo $req_ex->getMessage();
        } 

    }

    //--> get url if it is set 
    public function getURL()
    {
      if(isset($_GET['url']))
      {
        $url = $_GET['url'];
        $urlTrimmed = rtrim($url, '/');
        $urlTrimmed = filter_var($urlTrimmed, FILTER_SANITIZE_URL);
        $urlTrimmed = explode('/', $urlTrimmed);
        return $urlTrimmed;
      }
    }

    //--> check for controller based on query
    private function checkController($url)
    {

      try{
         $path = '../app/controllers/' . ucwords($url[0]) . '.controller.php';
         if(file_exists($path))
        {
          //--> if exits set as current controller
          $this->currentController = ucwords($url[0]);
          //--> Unset 0 index
          unset($url[0]); 
        }
        else{
          throw new Exception('File Stream Error. No controller found for query: ' . $url[0]);
        }
      }
      catch(Exception $e)
      {
        echo $e->getMessage();
      }
    } 
}