<?php

namespace Src\Controllers;

use Core\AuthMiddleware;

class ARController extends Controller
{
    protected AuthMiddleware $authMiddleware;

    public function __construct()
    {
        parent::__construct();

        $this->authMiddleware = new AuthMiddleware();

        $this->authMiddleware->redirectRestrictedUsers(['admin', 'staff']);
    }

    public function index($id)
    {
        $getAr = $this->fetchAR($id);

        echo $this->view('ar', ['getAr' => $getAr]);
    }

    public function arGallery()
    {
        echo $this->view('ar-experience');
    }

    public function arCamera()
    {
        echo $this->view('imagetracking');
    }

    private function fetchAR($id)
    {

        return $this->db->findOrFail('ar', ['ar_id' => $id]);

    }
}