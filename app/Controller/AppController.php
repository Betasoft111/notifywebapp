<?php
/**
 * Application level Controller
 *
 * This file is application-wide controller file. You can put all
 * application-wide controller-related methods here.
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Controller
 * @since         CakePHP(tm) v 0.2.9
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

App::uses('Controller', 'Controller');

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @package		app.Controller
 * @link		http://book.cakephp.org/2.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller {
	 public $components = array(
        'Session',
        'Auth' => array(
            'loginRedirect' => array(
                'controller' => 'users',
                'action' => 'profile'
            ),
            'logoutRedirect' => array(
                'controller' => 'users',
                'action' => 'login'
            )
        )
    );
public function gen_uuid() {
   $len=6;
    $hex = md5("abcdefghijklmnopqrstuvwxyz0123456789" . uniqid("", true));

    $pack = pack('H*', $hex);
    $tmp =  base64_encode($pack);

    $uid = preg_replace("#(*UTF8)[^a-z0-9]#", "", $tmp);

    $len = max(4, min(128, $len));

    while (strlen($uid) < $len)
        $uid .= $this->gen_uuid(22);
        
    return substr($uid, 0, $len);die;
}
public function sendPushNotificationToAndroid($gcmid, $message)
{
  
   $url = 'https://android.googleapis.com/gcm/send';
            $fields = array(
                'registration_ids' => array($gcmid),
                'data' => array("m" =>$message),

            );
        // Google Cloud Messaging GCM API Key
           
                  $headers = array(
                      'Authorization: key=' . GOOGLE_API_KEY,
                      'Content-Type: application/json'
                  );
                  $ch = curl_init();
                  curl_setopt($ch, CURLOPT_URL, $url);
                  curl_setopt($ch, CURLOPT_POST, true);
                  curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
                  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                  curl_setopt ($ch, CURLOPT_SSL_VERIFYHOST, 0); 
                  curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
                  curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
                  $resu = curl_exec($ch); 
                                    //echo "<pre>"; print_r($result); die;      
                  if ($resu === FALSE) {
                                        
                      die('Curl failed: ' . curl_error($ch));
                  }
                  curl_close($ch);
                   //return $resu;
}
}
