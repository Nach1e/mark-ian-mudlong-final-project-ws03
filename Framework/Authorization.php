<?php
    namespace Framework;
    
    class Authorization {
        public static function isOwner($resourceId) {
            $sessionUser = Session::get('user');
            
            if ($sessionUser !== null && isset($sessionUser['id'])) {
                return (int)$sessionUser['id'] === (int)$resourceId;
            }
            
            return false;
        }
    }
?>