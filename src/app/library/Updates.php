<?php 
namespace App\library;

class Updates {

    /**
     * Atualiza a sessão do usuário
     * @param array $userInfos
     */
    static public function updateSession($userInfos){
        foreach ($userInfos as $key => $value) {
            $_SESSION[$key] = $value;
        }
    }

}