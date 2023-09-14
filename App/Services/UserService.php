<?php

namespace App\Services;

use App\Models\User;

class UserService
{
    public function get($id = null)
    {
        if ($id) {
            return User::select($id);
        } else {
            return User::selectAll();
        }
    }

    public function post()
    {
        $data = $_POST;
        return User::insert($data);
    }

    public function postAlter($data)
    {
        $data = $_POST;
        return User::alterar($data);
    }

    public function postDelete($id = null)
    {
        if ($id) {
            return User::delete($id);
        }
    }
}
