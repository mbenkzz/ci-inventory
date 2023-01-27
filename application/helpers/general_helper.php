<?php
defined('BASEPATH') or exit('No direct script access allowed');

function admin_url($uri = '')
{
    return base_url("admin_dapur/$uri");
}

function ajax_only()
{
    if (!is_ajax()) {
        show_error('Forbidden', 403);
    }
}

/**
 * Create message format using raw array type variable, can still be processed.
 * @param string $result success, error, expired, if expired the page will redirect to login page
 * @param string $message message text to user
 * 
 * @return array ready for json_encode
 * @see https://www.php.net/manual/en/function.json-encode.php
 * 
 */
function get_response_array($result, $message) {
    return array(
        'result' => $result,
        'message' => $message
    );
}

/**
 * Create message format using raw array type variable, it already json string format
 * @param string $result success, error, expired, if expired the page will redirect to login page
 * @param string $message message text to user
 * 
 * @return string encoded json
 * 
 */
function json_response($result, $message)
{
    return json_encode(
        get_response_array($result, $message)
    );
}

function getSegment($segment) {
    $that = &get_instance();
    return $that->uri->segment($segment);
}

/**
 * Get current date time
 * @param string $format default is 'Y-m-d H:i:s'
 * 
 * @return string
 * @see https://www.php.net/manual/en/function.date.php
 */
function getCurrentDateTime($format = 'Y-m-d H:i:s') {
    return date($format);
}

function dd($data) {
    echo "<pre>";
    var_dump($data);
    echo "</pre>";
    die();
}
