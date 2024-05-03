<?php
/**
 * Redirect to a specified URL
 *
 * @param string $url The URL to redirect to
 */
function redirect($url) {
    header("Location: $url");
    exit();
}

/**
 * Check if the user is logged in
 *
 * @return bool True if the user is logged in, false otherwise
 */
function is_logged_in() {
    return isset($_SESSION['user_id']);
}

/**
 * Check if the user is a customer
 *
 * @return bool True if the user is a customer, false otherwise
 */
function is_customer() {
    return is_logged_in() && $_SESSION['role'] === 'customer';
}

/**
 * Check if the user is an agency
 *
 * @return bool True if the user is an agency, false otherwise
 */
function is_agency() {
    return is_logged_in() && $_SESSION['role'] === 'agency';
}

/**
 * Get the current user's ID
 *
 * @return int|null The user's ID or null if not logged in
 */
function get_user_id() {
    return is_logged_in() ? $_SESSION['user_id'] : null;
}

/**
 * Escape a string for use in a database query
 *
 * @param string $str The string to escape
 * @return string The escaped string
 */
function escape_string($str) {
    global $conn;
    return mysqli_real_escape_string($conn, $str);
}