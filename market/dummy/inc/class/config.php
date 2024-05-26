<?php
namespace cuonic\PHPAuth2;

class Config
{
    private $lang = 'en';
    private $lang_list = array(
            'en',
            'fr',
            'es'
        );
    //private $base_url = 'http://capm.smartsolutionpro.us/iportal/market/contest/';
	private $base_url = "http://localhost/iportal/market/contest/";
    private $salt_1 = '=UhFhurEpG8al= RL-|*jAF01BmM|D7OyXkc*RNKzG7QX^p3|9tBCiGTJLFr';
    private $salt_2 = 'MrHYVHKCEsi%SLgXHfQlm1mVv2veknEcQj2r|vOFBvnmyrl+%198EGaX8tn8';
    private $salt_3 = 'AhOFYJxGYVDYdo*zqewpIeml1+swG k%WLmL9n2h0FPhtkhMydgjpj~21M6P';
    private $cookie_domain;
    private $cookie_path = '/';
    private $cookie_auth = 'auth_session';
    private $sitekey = 'dk;l189654è(tyhj§!dfgdfàzgq_f4fá.';
    private $admin_level = 99;
    private $table_activations = 'activations';
    private $table_attempts = 'attempts';
    private $table_log = 'log';
    private $table_resets = 'resets';
    private $table_sessions = 'sessions';
    private $table_users = 'users';

    public function __get($name)
    {
        return $this->$name;
    }

    public function __set($name, $value)
    {
        $this->$name = $value;
    }
}
