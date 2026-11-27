<?php 
namespace App\library;

class Updates {

    /**
     * Atualiza a sessão do usuário
     * @param array $userInfos
     */
    static public function updateSession($userInfos){
        if (!$userInfos) {
            return;
        }

        // A senha nunca vai para a sessão
        unset($userInfos['senha']);

        foreach ($userInfos as $key => $value) {
            $_SESSION[$key] = $value;
        }
    }

}