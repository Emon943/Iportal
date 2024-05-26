<?php
namespace cuonic\PHPAuth2\Localization;

class es extends Handler
{
    private $data;

    public function __construct(array $data)
    {
        $this->data = $data;
    }

    public function getActivationEmail()
    {
        $email = array();
        
        $email['subject'] = 'PHPAuth 2.0 : Activacion de cuenta';

        $email['head']  = 'MIME-Version: 1.0' . "\r\n";
        $email['head'] .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
        $email['head'] .= 'From: PHPAuth 2.0 <no-reply@phpauth.cuonic.com>' . "\r\n";

        $email['body'] = 'Hola,' . "\r\n";
        $email['body'] .= '<br/><br/>' . "\r\n";
        $email['body'] .= 'Acabas de crear una cuenta en PHPAuth 2.0.' . "\r\n";
        $email['body'] .= '<br/>' . "\r\n";
        $email['body'] .= 'Para activar tu cuenta debes acceder al siguente enlace : <strong><a href="' . $this->data['base_url'] .'?page=activate&key=' . $this->data['key'] . '" target="_blank">Activar mi cuenta</a></strong>' . "\r\n";
        $email['body'] .= '<br/><br/>' . "\r\n";
        $email['body'] .= 'Si no, puedes acceder a <a href="' . $this->data['base_url'] . '?page=activate" target="_blank">esta pagina</a> y poner el siguente codigo : <strong>' . $this->data['key'] . '</strong>' . "\r\n";
        $email['body'] .= '<br/><br/>' . "\r\n";
        $email['body'] .= 'Recuerda : Esta clave unica de activacion caduca en 24 horas, a partir del envio de este correo.' . "\r\n";

        return $email;
    }

    public function getResetEmail()
    {
        $email = array();
        
        $email['subject'] = 'PHPAuth 2.0 : Restablecer contrase&ntilde;a';

        $email['head']  = 'MIME-Version: 1.0' . "\r\n";
        $email['head'] .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
        $email['head'] .= 'From: PHPAuth 2.0 <no-reply@phpauth.cuonic.com>' . "\r\n";

        $email['body'] = 'Hola,' . "\r\n";
        $email['body'] .= '<br/><br/>' . "\r\n";
        $email['body'] .= 'Acabas de pedir una contrase&ntilde;a nueva en PHPAuth 2.0.' . "\r\n";
        $email['body'] .= '<br/>' . "\r\n";
        $email['body'] .= 'Para proceder a restablecer tu contrase&ntilde;a debes acceder al siguente enlace : <strong><a href="' . $this->data['base_url'] .'?page=reset&step=2&key=' . $this->data['key'] . '" target="_blank">Restablecer mi contrase&ntilde;a</a></strong>' . "\r\n";
        $email['body'] .= '<br/><br/>' . "\r\n";
        $email['body'] .= 'Si no, puedes acceder a <a href="' . $this->data['base_url'] . '?page=activate" target="_blank">esta pagina</a> y poner el siguente codigo : <strong>' . $this->data['key'] . '</strong>' . "\r\n";
        $email['body'] .= '<br/><br/>' . "\r\n";
        $email['body'] .= 'Recuerda : Esta clave de restablecimiento caduca en 24 horas, a partir del envio de este correo.' . "\r\n";

        return $email;
    }
}
