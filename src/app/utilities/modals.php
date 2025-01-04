<?php

namespace App\Utilities;

class Modals
{
    /**
     * Retorna um modal dinâmico
     * 
     * @param string $errorTitle
     * @param string|array $message
     * @param string $type
     * @return string
     */
    public static function getModal($errorTitle, $message, $type)
    {
        switch ($type) {
            case 'error':
                $class = 'error';
                $title = 'Error';
                break;
            case 'alert':
                $class = 'alert';
                $title = 'Alert';
                $svg = '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512"><!--!Font Awesome Free 6.7.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2025 Fonticons, Inc.--><path d="M342.6 150.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0L192 210.7 86.6 105.4c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3L146.7 256 41.4 361.4c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0L192 301.3 297.4 406.6c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L237.3 256 342.6 150.6z"/></svg>';
                break;
            case 'success':
                $class = 'success';
                $title = 'Sucesso';
                break;
            case 'info':
                $class = 'info';
                $title = 'Info';
                break;
        }
        $finalMessage = '';

        if (is_array($message)) {
            foreach ($message as $key => $value) {
                $finalMessage = $finalMessage . '<p>' . trim($value) . '</p>';
            }
        } elseif (is_string($message)) {
            $finalMessage = '<p>' . $message . '</p>';
        }

        return '<div class="modal-back-blur" role="alert">
                    <div class="modal-container">
                        <div class="modal ' . $class . '">
                            <div class="modal-header">
                                <h2>' . $title . '</h2>
                                <h3>' . $errorTitle . '</h3>
                                <button class="close-modal">
                                    
                                </button>
                            </div>
                            <div class="modal-body">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 128 512"><!--!Font Awesome Free 6.7.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2025 Fonticons, Inc.--><path d="M96 64c0-17.7-14.3-32-32-32S32 46.3 32 64l0 256c0 17.7 14.3 32 32 32s32-14.3 32-32L96 64zM64 480a40 40 0 1 0 0-80 40 40 0 1 0 0 80z"/></svg>
                                <div class="modal-message">
                                    ' . $finalMessage . '
                                </div>
                            </div>
                        </div>
                    </div>
                </div>';
    }
}
