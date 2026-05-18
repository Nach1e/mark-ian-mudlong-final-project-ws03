<?php
    namespace App\Controllers;
    
    use Framework\Database;
    use Framework\Validation;
    use Framework\Session;
    
    class UserController {
        protected $db;
        
        public function __construct() {
            $config = require basePath('config/db.php');
            $this->db = new Database($config);
        }
        
        public function create($params = []) {
            loadView('users/create');
        }
        
        public function login($params = []) {
            loadView('users/login');
        }
        
        public function store($params = []) {
            $name = $_POST['name'] ?? '';
            $email = $_POST['email'] ?? '';
            $city = $_POST['city'] ?? '';
            $state = $_POST['state'] ?? '';
            $password = $_POST['password'] ?? '';
            $passwordConfirmation = $_POST['password_confirmation'] ?? '';
            
            $errors = [];
            
            if (!Validation::email($email)) {
                $errors['email'] = 'Please enter a valid email address';
            }
            
            if (!Validation::string($name, 2, 50)) {
                $errors['name'] = 'Name must be between 2 and 50 characters';
            }
            
            if (!Validation::string($password, 6)) {
                $errors['password'] = 'Password must be at least 6 characters';
            }
            
            if (!Validation::match($password, $passwordConfirmation)) {
                $errors['password_confirmation'] = 'Passwords do not match';
            }
            
            if (!empty($errors)) {
                loadView('users/create', [
                    'errors' => $errors,
                    'user' => [
                        'name' => $name,
                        'email' => $email,
                        'city' => $city,
                        'state' => $state
                    ]
                ]);
                return;
            }
            
            // Check if email exists
            $existingUser = $this->db->query(
                "SELECT * FROM users WHERE email = :email",
                ['email' => $email]
            )->fetch();
            
            if ($existingUser) {
                $errors['email'] = 'That email already exists';
                loadView('users/create', [
                    'errors' => $errors,
                    'user' => [
                        'name' => $name,
                        'email' => $email,
                        'city' => $city,
                        'state' => $state
                    ]
                ]);
                return;
            }
            
            // Hash password
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
            
            // Insert user
            $this->db->query(
                "INSERT INTO users (name, email, city, state, password)
                VALUES (:name, :email, :city, :state, :password)",
                [
                    'name' => $name,
                    'email' => $email,
                    'city' => $city,
                    'state' => $state,
                    'password' => $hashedPassword
                ]
            );
            
            $userId = $this->db->conn->lastInsertId();
            
            Session::set('user', [
                'id' => $userId,
                'name' => $name,
                'email' => $email,
                'city' => $city,
                'state' => $state
            ]);
            
            Session::setFlashMessage('success_message', 'Registration successful! Welcome!');
            redirect('/');
        }
        
        public function authenticate($params = []) {
            $email = $_POST['email'] ?? '';
            $password = $_POST['password'] ?? '';
            
            $errors = [];
            
            if (!Validation::email($email)) {
                $errors['email'] = 'Please enter a valid email address';
            }
            
            if (!Validation::string($password, 6)) {
                $errors['password'] = 'Password must be at least 6 characters';
            }
            
            if (!empty($errors)) {
                loadView('users/login', ['errors' => $errors]);
                return;
            }
            
            // Check if email exists
            $user = $this->db->query(
                "SELECT * FROM users WHERE email = :email",
                ['email' => $email]
            )->fetch();
            
            if (!$user) {
                $errors['email'] = 'Incorrect credentials';
                loadView('users/login', ['errors' => $errors]);
                return;
            }
            
            // Verify password
            if (!password_verify($password, $user->password)) {
                $errors['email'] = 'Incorrect credentials';
                loadView('users/login', ['errors' => $errors]);
                return;
            }
            
            // Set session
            Session::set('user', [
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
                'city' => $user->city,
                'state' => $user->state
            ]);
            
            Session::setFlashMessage('success_message', 'Welcome back, ' . $user->name . '!');
            redirect('/');
        }
        
        public function logout($params = []) {
            Session::clearAll();
            
            $params = session_get_cookie_params();
            setcookie('PHPSESSID', '', time() - 86400, $params['path'], $params['domain']);
            
            redirect('/');
        }
    }
?>