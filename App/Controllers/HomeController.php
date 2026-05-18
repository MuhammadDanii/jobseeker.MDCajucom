<?php

namespace App\Controllers;

use Framework\Database;

class HomeController
{
    protected $db;

    public function __construct()
    {
        $config = require basePath('config/db.php');
        $this->db = new Database($config);
    }
    
    public function index()
    {
        $listings = [];

        try {

            $listings = $this->db->query('SELECT * FROM listings LIMIT 6')->fetchAll();
        } catch (\Exception $e) {

        }

        if (empty($listings)) {
            $sampleListing = new \stdClass();
            $sampleListing->id = 1;
            $sampleListing->title = 'Junior PHP Developer';
            $sampleListing->description = 'We are seeking a driven Junior PHP Developer to assist in building and scaling modern web applications. In this role, you will collaborate on object-oriented system architectures, design normalized relational databases, and write secure backend scripts.';
            $sampleListing->salary = '65000';
            $sampleListing->tags = 'php, backend, sql, xampp, framework';
            $sampleListing->city = 'Manila';
            $sampleListing->state = 'NCR';
            

            $listings = [$sampleListing]; 
        }


        loadView('Home', ['listings' => $listings]);
    }
}