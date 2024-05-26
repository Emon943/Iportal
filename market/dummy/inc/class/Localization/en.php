<?php
namespace cuonic\PHPAuth2\Localization;

class en extends Handler
{
    private $data;

    public function __construct(array $data)
    {
        $this->data = $data;
    }

    public function getActivationEmail()
    {
        $email = array();

        $email['subject'] = 'Iportal Dummy Portfolio : Account Activation required';

        $email['head']  = 'MIME-Version: 1.0' . "\r\n";
        $email['head'] .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
        $email['head'] .= 'From: Iportal Dummy Portfolio <no-reply@capmadvisorybd.com>' . "\r\n";

        $email['body'] = 'Hello,' . "\r\n";
        $email['body'] .= '<br/><br/>' . "\r\n";
        $email['body'] .= 'You recently created an account on Iportal Dummy Portfolio.' . "\r\n";
        $email['body'] .= '<br/>' . "\r\n";
        $email['body'] .= 'To be able to use your account, you need to activate it by clicking the following link : <strong><a href="' . $this->data['base_url'] .'?page=activate&key=' . $this->data['key'] . '" target="_blank">Activate my account</a></strong>' . "\r\n";
        $email['body'] .= '<br/><br/>' . "\r\n";
        $email['body'] .= 'Or alternatively, go to <a href="' . $this->data['base_url'] . '?page=activate" target="_blank">this page</a> and paste the following code : <strong>' . $this->data['key'] . '</strong>' . "\r\n";
        $email['body'] .= '<br/><br/>' . "\r\n";
        $email['body'] .= 'Reminder : This unique activation key will expire within 24 hours of account creation.' . "\r\n";

        return $email;
    }

    public function getResetEmail()
    {
        $email = array();

        $email['subject'] = 'Iportal Dummy Portfolio : Password reset request';

        $email['head']  = 'MIME-Version: 1.0' . "\r\n";
        $email['head'] .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
        $email['head'] .= 'Iportal Dummy Portfolio <no-reply@capmadvisorybd.com>' . "\r\n";

        $email['body'] = 'Hello,' . "\r\n";
		$email['body'] .= '<br/><br/>' . "\r\n";
		$email['body'] .= 'You recently requested a password reset request at Iportal Dummy Portfolio.' . "\r\n";
		$email['body'] .= '<br/>' . "\r\n";
		$email['body'] .= 'To proceed with resetting your password, click the following link : <strong><a href="' . $this->data['base_url'] .'?page=reset&step=2&key=' . $this->data['key'] . '" target="_blank">Reset my password</a></strong>' . "\r\n";
		$email['body'] .= '<br/><br/>' . "\r\n";
		$email['body'] .= 'Or alternatively, go to <a href="' . $this->data['base_url'] . '?page=reset&step=2" target="_blank">this page</a> and paste the following code : <strong>' . $this->data['key'] . '</strong>' . "\r\n";
		$email['body'] .= '<br/><br/>' . "\r\n";
		$email['body'] .= 'Reminder : This unique reset key will expire within 24 hours of the password reset request.' . "\r\n";

        return $email;
    }
}
