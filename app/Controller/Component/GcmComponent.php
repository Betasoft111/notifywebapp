<?php
App::uses('Component', 'Controller');
class GcmComponent extends Component {
    public function send_notification($id = null, $data = null) {


        $apiKey = "AIzaSyAOcNSrmgeUJzgL7NMB4lz5uhfI6F5yeOA";
        configure::write('debug', 2);
        // Replace with real client registration IDs
//        $id=145;
//        $user_id=26;
        $registrationIDs = array($id);

        // Message to be sent
        // $message = "user_id:".$user_id."user_name:".$name;
//        $data='{"type":"'.$type.'","id":"'.$user_id.'"}';
//        $message = array("price" => $user_id . "/" . $name);
        $message = array("price" => $data);
        // Set POST variables
        $url = 'https://android.googleapis.com/gcm/send';
        $fields = array(
            'registration_ids' => $registrationIDs,
            'data' => $message,
        );
        $headers = array(
            'Authorization: key=' . $apiKey,
            'Content-Type: application/json'
        );

        // Open connection
        $ch = curl_init();

        // Set the url, number of POST vars, POST data
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        //curl_setopt( $ch, CURLOPT_POSTFIELDS, json_encode( $fields ) );

        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        //     curl_setopt($ch, CURLOPT_POST, true);
        //     curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));

        // Execute post
        $result = curl_exec($ch);

        // Close connection
        
        return $result;
    } 
}