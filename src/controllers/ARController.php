<?php

namespace Src\Controllers;

use Core\AuthMiddleware;
use Core\AuthService;
use Core\FileValidator;
use Core\FormValidator;
use Exception;

class ARController extends Controller
{
    protected AuthMiddleware $authMiddleware;

    public function __construct()
    {
        parent::__construct();

        $this->authMiddleware = new AuthMiddleware();

        $this->authMiddleware->redirectRestrictedUsers(['staff']);
    }

    public function index($id)
    {
        $getAr = $this->fetchAR($id);

        echo $this->view('ar', ['getAr' => $getAr]);
    }

    public function manageAR()
    {
        $this->authMiddleware->authenticate(AuthService::ROLE_ADMIN);

        $ARs = $this->fetchARs();


        echo $this->view('admin/ar', ['ARs' => $ARs]);
    }

    public function findAR()
    {
        $this->authMiddleware->authenticate(AuthService::ROLE_ADMIN);

        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {

            redirect('/feedback');

        }

        $product = $this->db->query("SELECT * FROM product WHERE product_id = :product_id or name = :name;", ['product_id' => $_POST['product'], 'name' => $_POST['product']])->fetch();

        $_SESSION['product'] = $product;

        redirect('/AR');
    }

    public function createAR()
    {
        $this->authMiddleware->authenticate(AuthService::ROLE_ADMIN);

        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {

            redirect('/AR');

        }

        $modelValidator = new FileValidator($_FILES['model_file'] ?? []);
        $modelValidator->required()
            ->maxSize(100)  
            ->allowedTypes(['glb']);

        $qrValidator = new FileValidator($_FILES['qr_image'] ?? []);
        $qrValidator->required()
            ->maxSize(5)     
            ->allowedTypes(['jpg', 'png', 'jpeg']);

        if ($modelValidator->fails() || $qrValidator->fails()) {
            $errors = array_merge(
                $modelValidator->getErrors(),
                $qrValidator->getErrors()
            );
            $this->handleValidationError('/AR', $errors);
        }

        $modelFileName = $modelValidator->move('public/models');
        $qrFileName = $qrValidator->move('public/upload/qr');

        try {

            $arID = $this->db->insert(
                'ar',
                [
                    'model_path' => $modelFileName,
                    'qr_link' => $_POST['product_link'],
                    'img_url' => $qrFileName
                ]
            );

            $this->db->update(
                'product',
                $_POST['product_id'],
                [
                    'has_ar' => 1,
                    'ar_id' => $arID
                ],
                'product_id'
            );

            setFlashMessage(
                'status',
                'New AR product join the member',
                'success'
            );

            redirect('/AR');

        } catch (Exception $e)
        {
            dd($e);
            $this->handleProcessError($e, '/AR', $e->getMessage());
        }

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

    private function fetchARs()
    {
        return $this->db->query('SELECT ar.*, p.* FROM ar JOIN product p ON ar.ar_id = p.ar_id;')->fetchAll();
    }

    private function validate($form, $file)
    {
    }
}