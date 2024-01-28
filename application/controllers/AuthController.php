<?php
defined('BASEPATH') or exit('No direct script access allowed');

class AuthController extends CI_Controller
{

    protected $isUseAuth = true;

    function __construct()
    {
        parent::__construct();
        if ($this->isUseAuth) {
            if (!$this->isLoggedIn()) {
                return redirect(base_url());
                die;
            }
        }
    }

    protected function isLoggedIn(): bool
    {
        return isset($_SESSION['id_user']);
    }

    protected function authCheck()
    {
        if (!$this->isLoggedIn()) {
            redirect(base_url());
        }
    }

    protected function accessAllowed(array $role)
    {
        $isAllow = false;
        foreach ($role as $dt) {
            if (strtolower($dt) == strtolower($_SESSION['hak_akses'])) {
                $isAllow = true;
            }
        }
        if (!$isAllow) {
            echo "<script>window.history.back()</script>";
            die;
        }
    }

    protected function redirectBack()
    {
        echo "<script>window.history.back()</script>";
        die;
    }
}
