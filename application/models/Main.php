<?php

namespace application\models;

use application\core\Model;

class Main extends Model
{
    public $error;

    public function contactValidate($post)
    {
        $nameLen = iconv_strlen($post['name']);
        $emailLen = iconv_strlen($post['email']);
        $messageLen = iconv_strlen($post['message']);

        if ($nameLen < 1)
        {
            $this->error = 'Add name';
            return false;
        }
        else if ($nameLen > 20)
        {
            $this->error = 'Name is so long';
            return false;
        }
        if ($emailLen < 1)
        {
            $this->error = 'Add email';
            return false;
        }
        else if (!filter_var($post['email'], FILTER_VALIDATE_EMAIL))
        {
            $this->error = 'Your email is not valid';
            return false;
        }
        else if ($messageLen < 1)
        {
            $this->error = 'Add message';
            return false;
        }
        else if ($messageLen > 257)
        {
            $this->error = 'Message length more than 257 symbols';
            return false;
        }
        return true;
    }

    public function postsCount()
    {
        return $this->db->column('SELECT COUNT(id) FROM posts');
    }

    public function postsList($route)
    {
        $max = 10;
        $params =
        [
            'max' => $max,
            'start' => (($route['page'] ?? 1) - 1) * $max
        ];
        return $this->db->row('SELECT * FROM posts ORDER BY id DESC LIMIT :start, :max', $params);
    }
}