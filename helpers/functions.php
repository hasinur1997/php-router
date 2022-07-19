<?php

/**
 * Include file
 *
 * @param string $file
 * @param array $data
 * @return void
 */
function view( $file = '', $data = [] ) {
    $file = documentRoot() . '/resources/views/' . $file;

    if ( file_exists( $file ) ) {
        include $file;
    }
}

/**
 * Get document root
 *
 * @return void
 */
function documentRoot() {
    return $_SERVER['DOCUMENT_ROOT'];
}

/**
 * Include template
 *
 * @param string $template
 * @return void
 */
function template( $template ) {
    $template = documentRoot() . '/resources/views/' . $template;

    if ( file_exists( $template ) ) {
        include $template;
    }
}

/**
 * Get assets link
 *
 * @param string $file
 * @return string
 */
function url() {
    $link = isset( $_SERVER['HTTPS'] ) && $_SERVER['HTTPS'] === 'on' ? 'https' : 'http';

    $link .= "://";
    // ip) to the URL.
    $link .= $_SERVER['HTTP_HOST'];

    // Display the link
    return $link;
}

/**
 * Get client ip address
 *
 * @return void
 */
function get_client_ip() {
    $ipaddress = '';
    if ( isset( $_SERVER['HTTP_CLIENT_IP'] ) ) {
        $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
    } else if ( isset( $_SERVER['HTTP_X_FORWARDED_FOR'] ) ) {
        $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
    } else if ( isset( $_SERVER['HTTP_X_FORWARDED'] ) ) {
        $ipaddress = $_SERVER['HTTP_X_FORWARDED'];
    } else if ( isset( $_SERVER['HTTP_FORWARDED_FOR'] ) ) {
        $ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
    } else if ( isset( $_SERVER['HTTP_FORWARDED'] ) ) {
        $ipaddress = $_SERVER['HTTP_FORWARDED'];
    } else if ( isset( $_SERVER['REMOTE_ADDR'] ) ) {
        $ipaddress = $_SERVER['REMOTE_ADDR'];
    } else {
        $ipaddress = 'UNKNOWN';
    }

    return $ipaddress;
}

/**
 * Get app config
 *
 * @param string $key
 * @return void
 */
function get_config() {
    return require_once documentRoot() . '/config/app.php';
}