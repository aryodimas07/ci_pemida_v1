<?php
defined('BASEPATH') or exit('No direct script access allowed');

if (!function_exists('is_logged_in')) {
    function is_logged_in()
    {
        $ci = get_instance();
        if (isset($ci->session->userdata()['logged_in'])) {
            return true;
        } else {
            return false;
        }
    }
}

if (!function_exists('is_admin')) {
  function is_admin()
  {
    $ci = get_instance();
    $admin = $ci->session->userdata()['logged_in']['isAdmin'];
    if ($admin === 1) {
      return true;
    } else {
      return false;
    }
  }
}

if (!function_exists('get_email_info')) {
  function get_email_info()
  {
    $ci = get_instance();
    $result = $ci->session->userdata()['logged_in']['email'];
    return $result;
  }
}
