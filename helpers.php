<?php
    function basePath(string $path): string {
        return BASE_PATH . '/' . $path;
    }
    
    function loadView($name, $data = []) {
        // Use App with capital A to match your folder structure
        $viewPath = BASE_PATH . '/App/Views/' . $name . '.view.php';
        
        if (file_exists($viewPath)) {
            extract($data);
            require $viewPath;
        } else {
            die("View not found: " . $name . " at path: " . $viewPath);
        }
    }
    
    function loadPartial($name, $data = []) {
        // Use App with capital A to match your folder structure
        $partialPath = BASE_PATH . '/App/Views/Partials/' . $name . '.php';
        
        if (file_exists($partialPath)) {
            extract($data);
            require $partialPath;
        } else {
            die("Partial not found: " . $name . " at path: " . $partialPath);
        }
    }
    
    function url($path = '') {
        return '/WS03-main/Public' . $path;
    }
    
    function inspect($value) {
        echo '<pre>';
        var_dump($value);
        echo '</pre>';
    }
    
    function inspectAndDie($value) {
        echo '<pre>';
        var_dump($value);
        echo '</pre>';
        die();
    }
    
    function formatSalary($salary) {
        return '$' . number_format((float)$salary, 2, '.', ',');
    }
    
    function sanitize($dirty) {
        return filter_var(trim($dirty), FILTER_SANITIZE_SPECIAL_CHARS);
    }
    
    function redirect($url) {
        header("Location: /WS03-main/Public{$url}");
        exit();
    }
    
    /**
     * Format textarea content for safe HTML display
     * Preserves line breaks and prevents XSS attacks
     * 
     * @param string|null $text The text to format
     * @return string Formatted HTML safe text with line breaks
     */
    function formatTextarea($text) {
        if (empty($text)) {
            return '';
        }
        // First decode any HTML entities (like &#13;&#10;), then convert line breaks to <br>, then escape for safety
        $decoded = html_entity_decode($text, ENT_QUOTES, 'UTF-8');
        return nl2br(htmlspecialchars($decoded, ENT_QUOTES, 'UTF-8'));
    }
    
    /**
     * Escape HTML special characters
     * 
     * @param string $string The string to escape
     * @return string Escaped string
     */
    function escape($string) {
        return htmlspecialchars($string ?? '', ENT_QUOTES, 'UTF-8');
    }
    
    /**
     * Format date for display
     * 
     * @param string $date The date string
     * @param string $format The format to use
     * @return string Formatted date
     */
    function formatDate($date, $format = 'M d, Y') {
        if (empty($date)) {
            return '';
        }
        $timestamp = strtotime($date);
        return date($format, $timestamp);
    }
    
    /**
     * Truncate text to a specific length
     * 
     * @param string $text The text to truncate
     * @param int $length Maximum length
     * @param string $suffix Suffix to add when truncated
     * @return string Truncated text
     */
    function truncateText($text, $length = 100, $suffix = '...') {
        if (empty($text)) {
            return '';
        }
        $cleanText = strip_tags($text);
        if (strlen($cleanText) <= $length) {
            return $cleanText;
        }
        return substr($cleanText, 0, $length) . $suffix;
    }
    
    /**
     * Get current year for copyright
     * 
     * @return string Current year
     */
    function currentYear() {
        return date('Y');
    }
    
    /**
     * Check if user is logged in
     * 
     * @return bool True if logged in, false otherwise
     */
    function isLoggedIn() {
        return Framework\Session::has('user');
    }
    
    /**
     * Get current user data
     * 
     * @return array|null User data or null if not logged in
     */
    function getCurrentUser() {
        return Framework\Session::get('user');
    }
    
    /**
     * Generate a slug from a string
     * 
     * @param string $string The string to slugify
     * @return string The slug
     */
    function slugify($string) {
        if (empty($string)) {
            return '';
        }
        $string = strtolower(trim($string));
        $string = preg_replace('/[^a-z0-9-]/', '-', $string);
        $string = preg_replace('/-+/', '-', $string);
        return trim($string, '-');
    }
    
    /**
     * Redirect back to previous page
     * 
     * @return void
     */
    function redirectBack() {
        $referer = $_SERVER['HTTP_REFERER'] ?? url('/');
        header("Location: $referer");
        exit();
    }
    
    /**
     * Get the current URL
     * 
     * @return string Current URL
     */
    function currentUrl() {
        return (isset($_SERVER['HTTPS']) ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
    }
    
    /**
     * Check if a value is empty
     * 
     * @param mixed $value The value to check
     * @return bool True if empty, false otherwise
     */
    function isEmpty($value) {
        return empty($value) && $value !== '0' && $value !== 0;
    }
    
    /**
     * Format phone number
     * 
     * @param string $phone The phone number to format
     * @return string Formatted phone number
     */
    function formatPhone($phone) {
        if (empty($phone)) {
            return 'Not specified';
        }
        // Remove all non-numeric characters
        $phone = preg_replace('/[^0-9]/', '', $phone);
        
        // Format based on length
        if (strlen($phone) === 10) {
            return '(' . substr($phone, 0, 3) . ') ' . substr($phone, 3, 3) . '-' . substr($phone, 6, 4);
        } elseif (strlen($phone) === 11) {
            return '+' . substr($phone, 0, 1) . ' (' . substr($phone, 1, 3) . ') ' . substr($phone, 4, 3) . '-' . substr($phone, 7, 4);
        }
        
        return $phone;
    }
    
    /**
     * Generate random string
     * 
     * @param int $length Length of the string
     * @return string Random string
     */
    function randomString($length = 10) {
        return substr(str_shuffle('0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ'), 0, $length);
    }
    
    /**
     * Get file extension
     * 
     * @param string $filename The filename
     * @return string The extension
     */
    function getFileExtension($filename) {
        return strtolower(pathinfo($filename, PATHINFO_EXTENSION));
    }
    
    /**
     * Check if request is AJAX
     * 
     * @return bool True if AJAX request, false otherwise
     */
    function isAjax() {
        return isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest';
    }
    
    /**
     * Set flash message
     * 
     * @param string $type The type of message (success, error, warning, info)
     * @param string $message The message content
     * @return void
     */
    function setFlashMessage($type, $message) {
        Framework\Session::setFlashMessage($type . '_message', $message);
    }
    
    /**
     * Get flash message
     * 
     * @param string $type The type of message
     * @return string|null The flash message or null
     */
    function getFlashMessage($type) {
        return Framework\Session::getFlashMessage($type . '_message');
    }
    
    /**
     * Convert newlines to HTML line breaks
     * 
     * @param string $text The text to convert
     * @return string Text with line breaks converted to <br>
     */
    function nl2brSafe($text) {
        if (empty($text)) {
            return '';
        }
        return nl2br(htmlspecialchars($text, ENT_QUOTES, 'UTF-8'));
    }
    
    /**
     * Strip all HTML tags safely
     * 
     * @param string $text The text to strip
     * @param string $allowableTags Allowed tags
     * @return string Stripped text
     */
    function stripTagsSafe($text, $allowableTags = '') {
        if (empty($text)) {
            return '';
        }
        return strip_tags($text, $allowableTags);
    }
    
    /**
     * Convert special characters to HTML entities
     * 
     * @param string $text The text to convert
     * @return string Converted text
     */
    function htmlEncode($text) {
        if (empty($text)) {
            return '';
        }
        return htmlspecialchars($text, ENT_QUOTES, 'UTF-8');
    }
    
    /**
     * Convert HTML entities back to characters
     * 
     * @param string $text The text to decode
     * @return string Decoded text
     */
    function htmlDecode($text) {
        if (empty($text)) {
            return '';
        }
        return html_entity_decode($text, ENT_QUOTES, 'UTF-8');
    }
?>