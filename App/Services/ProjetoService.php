<?php

namespace App\Services;

use App\Models\Projeto;

class ProjetoService
{
    public function get($id = null)
    {
        if ($id) {
            return Projeto::select($id);
        } else {
            return Projeto::selectAll();
        }
    }

    public function post()
    {
        $data = $_POST;
        return Projeto::insert($data);
    }

    public function postAlter($data)
    {
        $data = $_POST;
        return Projeto::alterar($data);
    }

    public function postDelete($id = null)
    {
        if ($id) {
            return Projeto::delete($id);
        }else{
            echo 'ID N LOCALIZADO'; //TESTAR AINDA O ELSE
        }
    }
}
