<?php
defined('BASEPATH') or exit('No direct script access allowed');

require __DIR__ . '/../../vendor/autoload.php';

use Kreait\Firebase\Factory;

class Firebase
{

    protected $config = array();
    public $factory;

    public function __construct()
    {
        // Assign the CodeIgniter super-object
        //parent::_construct();
        $this->CI = &get_instance();

        //      $this->serviceAccount = ServiceAccount::fromJsonFile();
        $this->factory = (new Factory)->withServiceAccount($this->CI->config->item('firebase_app_key'))
            ->withDatabaseUri('https://alibi-d5dc7-default-rtdb.firebaseio.com/');
    }

    public function init()
    {
        // $factory = (new Factory)->withServiceAccount($this->CI->config->item('firebase_app_key'))
        //     ->withDatabaseUri('https://gamebike-5b2dc-default-rtdb.firebaseio.com/');

        return $this->factory;
    }

    public function getdatase()
    {
        //$database = $factory->createDatabase();

    }
}
