<?php

namespace application\models;

use application\core\Model;
// If your hosting has an Imagic class, you could be using this script for compressing images
// use Imagick;

class Admin extends Model
{
    public $error;

    public function loginValidate($post)
    {
        $config = require 'application/config/admin.php';
        if ($config['login'] != $post['login'] or $config['password'] != $post['password'])
        {
            $this->error = 'Wrong login or password.';
            return false;
        }

        return true;
    }

    public function postValidate($post, $action)
    {
        $titleLen = iconv_strlen($post['title']);
        $descriptionLen = iconv_strlen($post['description']);

        if ($titleLen < 1)
        {
            $this->error = 'Add title';
            return false;
        }
        else if ($titleLen > 50)
        {
            $this->error = 'Title is so long';
            return false;
        }
        else if ($descriptionLen < 1)
        {
            $this->error = 'Add description';
            return false;
        }
        else if ($descriptionLen > 1000)
        {
            $this->error = 'Description is so long';
            return false;
        }

        return true;
    }

    public function postAdd($post)
    {
        $params = [
            'id' => '0',
            'title' => $post['title'],
            'description' => $post['description'],
            'date' => time()
        ];
        $this->db->query('INSERT INTO posts VALUES (:id, :title, :description, :date)', $params);
        return $this->db->lastInsertId();
    }

    public function postUploadImage($path, $id)
    {
        // If your hosting has an Imagic class, you could be using this script for compressing images

        // $img = new Imagick($path);
        // $img->cropThumbnailImage(1080, 800);
        // $img->setImageCompressionQuality(80);
        // $img->writeImage('public/materials/'.$id.'.jpg');
        move_uploaded_file($path, 'public/materials/'.$id.'.jpg'); // If you use above script you have got to comment this line
    }

    public function isPostExists($id)
    {
        $params =
        [
            'id' => $id
        ];
        return $this->db->column('SELECT id FROM posts WHERE id = :id', $params);
    }

    public function postEdit($post, $id)
    {
        $params = [
            'id' => $id,
            'title' => $post['title'],
            'description' => $post['description'],
        ];
        $this->db->query('UPDATE posts SET title = :title, description = :description WHERE id = :id', $params);
    }

    public function postData($id)
    {
        $params =
        [
            'id' => $id
        ];
        return $this->db->row('SELECT * FROM posts WHERE id = :id', $params);
    }

    public function postDelete($id)
    {
        $params =
        [
            'id' => $id
        ];
        $this->db->query('DELETE FROM posts WHERE id = :id', $params);
        unlink('public/materials/'.$id.'.jpg');
    }
}