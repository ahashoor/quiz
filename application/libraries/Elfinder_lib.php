<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

include_once dirname(__FILE__).DIRECTORY_SEPARATOR.'elfinder/elFinder.class.php';

class Elfinder_lib 
{
  public function __construct($opts) 
  {
    $connector = new elFinder($opts);
    $connector->run();
  
  }
}