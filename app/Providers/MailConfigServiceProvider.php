<?php

namespace App\Providers;

use Config;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\ServiceProvider;

class MailConfigServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $mail = DB::table('setting')->first();
        if (!empty($mail)) //checking if table is not empty
        {
            $config = array(
                'driver'     => !empty($mail->smtp_driver) ? $mail->smtp_driver : '',
                'host'       => !empty($mail->smtp_host) ? $mail->smtp_host : '',
                'port'       => !empty($mail->smtp_port) ? $mail->smtp_port : '',
                'from'       => array('address' => !empty($mail->from_email) ? $mail->from_email : '', 'name' => !empty($mail->from_name) ? $mail->from_name : ''),
                'encryption' => !empty($mail->smtp_encryption) ? $mail->smtp_encryption : '',
                'username'   => !empty($mail->smtp_username) ? $mail->smtp_username : '',
                'password'   => !empty($mail->smtp_password) ? $mail->smtp_password : '',
                'sendmail'   => '/usr/sbin/sendmail -bs',
                'pretend'    => false,
            );
            Config::set('mail', $config);
        }
    }
}
