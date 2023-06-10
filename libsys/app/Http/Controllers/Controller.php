<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    /**
     * Method to format cpf number
     * @access protected
     * @param int $cpf
     * @return string
     */
    protected function formatCpf(int $cpf)
    {
        return substr($cpf, 0, 3) . '.' . substr($cpf, 3, 3) . '.' . substr($cpf, 6, 3) . '-' . substr($cpf, 9);
    }

    /**
     * Method to get the delete icon
     * @access private
     * @param string $id
     * @return array
     */
    protected function getIconDelete(string $id)
    {
        return [
            'id' => $id,
            'title' => 'Excluir Usuário',
            'target' => '#delete_user_' . $id,
            'icon' => 'text-primary fa-solid fa-trash-can',
            'dataToggle' => 'modal'
        ];
    }
}
