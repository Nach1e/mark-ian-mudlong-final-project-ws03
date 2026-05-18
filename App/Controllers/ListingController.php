<?php
    namespace App\Controllers;
    
    use Framework\Database;
    use Framework\Validation;
    use Framework\Session;
    use Framework\Authorization;
    
    class ListingController {
        protected $db;
        
        public function __construct() {
            $config = require basePath('config/db.php');
            $this->db = new Database($config);
        }
        
        public function index($params = []) {
            $listings = $this->db->query(
                "SELECT * FROM listings ORDER BY created_at DESC"
            )->fetchAll();
            
            loadView('listings/index', ['listings' => $listings]);
        }
        
        public function create($params = []) {
            loadView('listings/create');
        }
        
        public function show($params = []) {
            $id = $params['id'] ?? null;
            
            $listing = $this->db->query(
                "SELECT * FROM listings WHERE id = :id",
                ['id' => $id]
            )->fetch();
            
            if (!$listing) {
                ErrorController::notFound('Listing not found');
                return;
            }
            
            loadView('listings/show', ['listing' => $listing]);
        }
        
        public function store($params = []) {
            $allowedFields = [
                'title', 'description', 'salary', 'tags',
                'company', 'address', 'city', 'state',
                'phone', 'email', 'requirements', 'benefits'
            ];
            
            $newListingData = array_intersect_key($_POST, array_flip($allowedFields));
            $newListingData['user_id'] = Session::get('user')['id'];
            
            foreach ($newListingData as $field => $value) {
                if ($value === '') {
                    $newListingData[$field] = null;
                }
            }
            
            $newListingData = array_map('sanitize', $newListingData);
            
            $requiredFields = ['title', 'description', 'salary', 'email', 'city', 'state'];
            $errors = [];
            
            foreach ($requiredFields as $field) {
                if (empty($newListingData[$field]) || !Validation::string($newListingData[$field])) {
                    $errors[] = ucfirst($field) . ' is required';
                }
            }
            
            if (!empty($errors)) {
                loadView('listings/create', [
                    'errors' => $errors,
                    'listing' => (object) $newListingData
                ]);
            } else {
                $fields = implode(', ', array_keys($newListingData));
                $values = ':' . implode(', :', array_keys($newListingData));
                
                $query = "INSERT INTO listings ({$fields}) VALUES ({$values})";
                $this->db->query($query, $newListingData);
                
                Session::setFlashMessage('success_message', 'Listing created successfully!');
                redirect('/listings');
            }
        }
        
        public function edit($params = []) {
            $id = $params['id'] ?? null;
            
            $listing = $this->db->query(
                "SELECT * FROM listings WHERE id = :id",
                ['id' => $id]
            )->fetch();
            
            if (!$listing) {
                ErrorController::notFound('Listing not found');
                return;
            }
            
            if (!Authorization::isOwner($listing->user_id)) {
                Session::setFlashMessage('error_message', 'You are not authorized to edit this listing');
                redirect('/listings/' . $id);
                return;
            }
            
            loadView('listings/edit', ['listing' => $listing]);
        }
        
        public function update($params = []) {
            $id = $params['id'] ?? null;
            
            $listing = $this->db->query(
                "SELECT * FROM listings WHERE id = :id",
                ['id' => $id]
            )->fetch();
            
            if (!$listing) {
                ErrorController::notFound('Listing not found');
                return;
            }
            
            if (!Authorization::isOwner($listing->user_id)) {
                Session::setFlashMessage('error_message', 'You are not authorized to update this listing');
                redirect('/listings/' . $id);
                return;
            }
            
            $allowedFields = [
                'title', 'description', 'salary', 'tags',
                'company', 'address', 'city', 'state',
                'phone', 'email', 'requirements', 'benefits'
            ];
            
            $updatedValues = array_intersect_key($_POST, array_flip($allowedFields));
            $updatedValues = array_map('sanitize', $updatedValues);
            
            $requiredFields = ['title', 'description', 'salary', 'email', 'city', 'state'];
            $errors = [];
            
            foreach ($requiredFields as $field) {
                if (empty($updatedValues[$field]) || !Validation::string($updatedValues[$field])) {
                    $errors[] = ucfirst($field) . ' is required';
                }
            }
            
            if (!empty($errors)) {
                loadView('listings/edit', [
                    'listing' => $listing,
                    'errors' => $errors
                ]);
                return;
            }
            
            $updateFields = [];
            foreach (array_keys($updatedValues) as $field) {
                $updateFields[] = "{$field} = :{$field}";
            }
            $updateFields = implode(', ', $updateFields);
            $updatedValues['id'] = $id;
            
            $query = "UPDATE listings SET {$updateFields} WHERE id = :id";
            $this->db->query($query, $updatedValues);
            
            Session::setFlashMessage('success_message', 'Listing updated successfully!');
            redirect('/listings/' . $id);
        }
        
        public function destroy($params = []) {
            $id = $params['id'] ?? null;
            
            $listing = $this->db->query(
                "SELECT * FROM listings WHERE id = :id",
                ['id' => $id]
            )->fetch();
            
            if (!$listing) {
                ErrorController::notFound('Listing not found');
                return;
            }
            
            if (!Authorization::isOwner($listing->user_id)) {
                Session::setFlashMessage('error_message', 'You are not authorized to delete this listing');
                redirect('/listings/' . $id);
                return;
            }
            
            $this->db->query("DELETE FROM listings WHERE id = :id", ['id' => $id]);
            
            Session::setFlashMessage('success_message', 'Listing deleted successfully!');
            redirect('/listings');
        }
        
        public function search($params = []) {
            $keywords = isset($_GET['keywords']) ? trim($_GET['keywords']) : '';
            $location = isset($_GET['location']) ? trim($_GET['location']) : '';
            
            $query = "SELECT * FROM listings WHERE
                (title LIKE :keywords OR description LIKE :keywords 
                OR tags LIKE :keywords OR company LIKE :keywords)
                AND (city LIKE :location OR state LIKE :location)
                ORDER BY created_at DESC";
            
            $params = [
                'keywords' => '%' . $keywords . '%',
                'location' => '%' . $location . '%'
            ];
            
            $listings = $this->db->query($query, $params)->fetchAll();
            
            loadView('listings/index', [
                'listings' => $listings,
                'keywords' => $keywords,
                'location' => $location
            ]);
        }
    }
?>