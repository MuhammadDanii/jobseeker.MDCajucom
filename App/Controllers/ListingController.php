<?php

namespace App\Controllers;

use Framework\Database;
use App\Controllers\ErrorController;

class ListingController
{
    protected $db;

    public function __construct()
    {
        $config = require basePath('config/db.php');
        $this->db = new Database($config);
    }

    public function index()
    {

        $keywords = isset($_GET['keywords']) ? trim($_GET['keywords']) : '';
        $location = isset($_GET['location']) ? trim($_GET['location']) : '';

        // 2. Base SQL Query structure
        $sql = 'SELECT * FROM listings WHERE 1=1';
        $queryParams = [];

        if (!empty($keywords)) {
            $sql .= ' AND (title LIKE :keywords OR description LIKE :keywords OR tags LIKE :keywords)';
            $queryParams['keywords'] = '%' . $keywords . '%';
        }


        if (!empty($location)) {
            $sql .= ' AND (city LIKE :location OR state LIKE :location)';
            $queryParams['location'] = '%' . $location . '%';
        }

        $sql .= ' ORDER BY id DESC';

        try {
            $listings = $this->db->query($sql, $queryParams)->fetchAll();
        } catch (\Exception $e) {
            echo "Database error: " . $e->getMessage();
            return;
        }

        loadView('listings/index', [
            'listings' => $listings,
            'keywords'  => $keywords,
            'location'  => $location
        ]);
    }

    public function create()
    {
        loadView('listings/create');
    }


    public function show($params)
    {
        $id = $params['id'] ?? '';
        
        $queryParams = [
            'id' => $id
        ];
        
        try {
            $listing = $this->db->query('SELECT * FROM listings WHERE id = :id', $queryParams)->fetch();
        } catch (\Exception $e) {
            echo "Database error: " . $e->getMessage();
            return;
        }

        if (!$listing) {
            ErrorController::notFound('Listing not found');
            return;
        }
        
        loadView('listings/show', ['listing' => $listing]);
    }


    public function store()
    {
        // Block the submission if a user is not actively logged into a session
        if (!isset($_SESSION['user'])) {
            echo "You must be logged in to post a job.";
            return;
        }

        // Capture fields matching the 'name' attributes in your create view form
        $allowedFields = ['title', 'description', 'salary', 'tags', 'requirements', 'benefits', 'company', 'address', 'city', 'state', 'phone', 'email'];
        
        $newListingData = [];
        foreach ($allowedFields as $field) {
            $newListingData[$field] = $_POST[$field] ?? ''; 
        }

        // Inject the dynamic logged-in user ID from the session array
        $newListingData['user_id'] = $_SESSION['user']['id'];

        $sql = 'INSERT INTO listings (user_id, title, description, salary, tags, requirements, benefits, company, address, city, state, phone, email) 
                VALUES (:user_id, :title, :description, :salary, :tags, :requirements, :benefits, :company, :address, :city, :state, :phone, :email)';

        try {
            $this->db->query($sql, $newListingData);

            // Redirect back to home upon successful save
            header('Location: /');
            exit;
        } catch (\Exception $e) {
            echo "Failed to save record: " . $e->getMessage();
        }
    }


    public function edit($params)
    {
        $id = $params['id'] ?? '';
        
        try {
            $listing = $this->db->query('SELECT * FROM listings WHERE id = :id', ['id' => $id])->fetch();
        } catch (\Exception $e) {
            echo "Database error: " . $e->getMessage();
            return;
        }

        // Check if listing exists
        if (!$listing) {
            ErrorController::notFound('Listing not found');
            return;
        }

        // Security Check: Only the user who posted the job can edit it
        if (!isset($_SESSION['user']) || $_SESSION['user']['id'] !== $listing->user_id) {
            echo "Unauthorized access. You do not own this listing.";
            return;
        }

        loadView('listings/edit', ['listing' => $listing]);
    }


    public function update($params)
    {
        $id = $params['id'] ?? '';

        try {
            $listing = $this->db->query('SELECT * FROM listings WHERE id = :id', ['id' => $id])->fetch();
        } catch (\Exception $e) {
            echo "Database error: " . $e->getMessage();
            return;
        }

        // Check if listing exists
        if (!$listing) {
            ErrorController::notFound('Listing not found');
            return;
        }


        if (!isset($_SESSION['user']) || $_SESSION['user']['id'] !== $listing->user_id) {
            echo "Unauthorized action.";
            return;
        }


        $allowedFields = ['title', 'description', 'salary', 'tags', 'requirements', 'benefits', 'company', 'address', 'city', 'state', 'phone', 'email'];
        
        $updateValues = [];
        foreach ($allowedFields as $field) {
            $updateValues[$field] = $_POST[$field] ?? '';
        }


        $updateValues['id'] = $id;

        $sql = 'UPDATE listings 
                SET title = :title, description = :description, salary = :salary, tags = :tags, 
                    requirements = :requirements, benefits = :benefits, company = :company, 
                    address = :address, city = :city, state = :state, phone = :phone, email = :email 
                WHERE id = :id';

        try {
            $this->db->query($sql, $updateValues);
            
            // Redirect back to single job view upon success
            header("Location: /listing/{$id}");
            exit;
        } catch (\Exception $e) {
            echo "Failed to update record: " . $e->getMessage();
        }
    }
}