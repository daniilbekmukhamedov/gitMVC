<?php

namespace application\controllers;

use application\core\Controller;

class AdminController extends Controller
{
    public function loginAction()
    {
        if (isset($_SESSION['admin']))
        {
            $this->view->redirect("/admin/add");
        }
        if (!empty($_POST))
        {
            if (!$this->model->loginValidate($_POST))
            {
                $this->view->message('Error', $this->model->error);
            }
            $_SESSION['admin'] = true;
            $this->view->location('/admin/add');
        }
        
        $this->view->render('Login Page');
    }

    public function logoutAction()
    {
        unset($_SESSION['admin']);
        $this->view->redirect('/admin/login');
    }

    public function addAction()
    {
        if (!empty($_POST))
        {
            if (!$this->model->postValidate($_POST, $this->route['action']))
            {
                $this->view->message('Error', $this->model->error);
            }
            $id = $this->model->postAdd($_POST);
            if (!$id)
            {
                $this->view->message('Error', 'Something gone wrong');
            }
            $this->model->postUploadImage($_FILES['file']['tmp_name'], $id);
            $this->view->message('Success', 'News published');
        }
        
        $this->view->render('Add Post');
    }

    public function editAction()
    {
        if (!$this->model->isPostExists($this->route['id']))
        {
            $this->view->errorCode(404);
        }
        if (!empty($_POST))
        {
            if (!$this->model->postValidate($_POST, $this->route['action']))
            {
                $this->view->message('Error', $this->model->error);
            }
            $this->model->postEdit($_POST, $this->route['id']);
            
            $this->view->message('Success', 'News updated');
        }
        $vars = 
        [
            'data' => $this->model->postData($this->route['id'])[0]
        ];
        $this->view->render('Edit Post', $vars);
    }

    public function deleteAction()
    {
        if (!$this->model->isPostExists($this->route['id']))
        {
            $this->view->errorCode(404);
        }
        $this->model->postDelete($this->route['id']);
        $this->view->redirect('/');
        exit('Delete: '.$this->route['id']);
    }
}