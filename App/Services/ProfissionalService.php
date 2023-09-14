<?php

namespace App\Services;

use App\Models\Profissional;

class ProfissionalService
{
    public function get($id = null)
    {
        if ($id) {
            return Profissional::select($id);
        } else {
            return Profissional::selectAll();
        }
    }

    public function post()
    {
        $data = $_POST;
        return Profissional::insert($data);
    }

    public function postAlter($data)
    {
        $data = $_POST;
        return Profissional::alterar($data);
    }

    public function postDelete($id = null)
    {
        if ($id) {
            return Profissional::delete($id);
        }else{
            echo 'ID N LOCALIZADO'; //TESTAR AINDA O ELSE
        }
    }
}
