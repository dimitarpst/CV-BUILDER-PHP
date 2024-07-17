<?php
ini_set('session.use_only_cookies', 1);
ini_set('session.use_strict_mode', 1);

session_set_cookie_params([
    'lifetime' => 1800,
    'domain' => 'localhost',
    'path' => '/',
    'secure' => true, 
    'httponly' => true,
]);

session_start();


if (!isset($_SESSION['last_regeneration']) || (time() - $_SESSION['last_regeneration'] >= (60 * 30))) {
    if (isset($_SESSION['user_id'])) {
        regenerate_session_id_loggedin();

        $newSessionId = session_create_id();
        $sessionId = $newSessionId . "_" . $_SESSION['user_id'];
        session_id($sessionId);
    } else {
        regenerate_session_id(); 
    }
} 


function regenerate_session_id() {
    session_regenerate_id(true);
    $_SESSION['last_regeneration'] = time();
}

function regenerate_session_id_loggedin() {
    session_regenerate_id(true);
    $_SESSION['last_regeneration'] = time(); 
}
