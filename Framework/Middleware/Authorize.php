<?php
    namespace Framework\Middleware;
    
    use Framework\Session;
    
    class Authorize {
        public function handle($middleware) {
            Session::start();
            
            $user = Session::get('user');
            
            if ($middleware === 'auth') {
                if ($user === null) {
                    redirect('/login');
                    exit;
                }
            }
            
            if ($middleware === 'guest') {
                if ($user !== null) {
                    redirect('/');
                    exit;
                }
            }
        }
    }
?>