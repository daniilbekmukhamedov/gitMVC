<?php

namespace application\controllers;

use application\core\Controller;
use application\lib\Pagination;
use application\models\Admin;

class MainController extends Controller
{
    public function indexAction()
    {
        $pagination = new Pagination($this->route, $this->model->postsCount());
        $vars = [
            'pagination' => $pagination->get(),
            'list' => $this->model->postsList($this->route)
        ];
        $this->view->render('Main Page', $vars);
    }

    public function aboutAction()
    {
        $this->view->render('About Us');
    }

    public function contactAction()
    {
        if (!empty($_POST))
        {
            if (!$this->model->contactValidate($_POST))
            {
                $this->view->message('Error', $this->model->error);
            }

            header('Content-Type: text/html; charset=utf-8');

            $subjectText = 'Message MVC';
            $subject = '=?UTF-8?B?'.base64_encode($subjectText).'?=';

            $headers = 'Content-Type: text/plain; charset=utf-8' . "\r\n";
            $headers .= 'Content-Transfer-Encoding: base64';
            $message = base64_encode('From '.$_POST['name'].".\r\n".$_POST['message']);

            mail($_POST['email'], $subject, $message, $headers);

            $this->view->message('Success', 'Message has sent');
        }

        $this->view->render('Contact Us');
    }

    public function postAction()
    {
        $adminModel = new Admin;
        if (!$adminModel->isPostExists($this->route['id']))
        {
            $this->view->errorCode(404);
        }
        $vars = 
        [
            'data' => $adminModel->postData($this->route['id'])[0]
        ];
        $this->view->render('Post Page', $vars);
    }
}