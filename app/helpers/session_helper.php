<?php
session_start();

// Flash message helper

function flash($name = '', $message = '', $class = 'alert alert-success')
{

    if ( !empty($name) ) {

        if (!empty($message) && empty($_SESSION[$name])) {

            if (!empty($_SESSION[$name])) {
                unset($_SESSION[$name]);
            }

            if (!empty($_SESSION[$name . '_class'])) {
                unset($_SESSION[$name . '_class']);
            }

            $_SESSION[$name] = $message;
            $_SESSION[$name . '_class'] = $class;

        } elseif (empty($message) && !empty($_SESSION[$name])) {

            $class = !empty($_SESSION[$name . '_class']) ? $_SESSION[$name . '_class'] : '';

            echo '<div class="text-center ' . $class . '" id="msg-flash">' . $_SESSION[$name] . '</div>';

            unset($_SESSION[$name]);
            unset($_SESSION[$name . '_class']);
        }
    }


}
function isLoggedIn()
{
    if ( isset($_SESSION['user_id']) ) {
        return true;
    } else {
        return false;
    }
}

function generateCSRFToken() {
    if (empty($_SESSION['csrf_token'])) {
        $_SESSION['csrf_token'] = bin2hex(rand(0,9999)).time(); // ایجاد یک توکن تصادفی و ذخیره در جلسه
    }
    return $_SESSION['csrf_token'];
}


function isValidCSRFToken($token) {
    return isset($_SESSION['csrf_token']) && hash_equals($_SESSION['csrf_token'], $token);
}
