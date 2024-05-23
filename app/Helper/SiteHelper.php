<?php

namespace App\Helper;

use Auth,Log;
use Modules\Admin\Entities\Admin;

class SiteHelper
{
    public function can($perm,$guard = 'admin')
    {
    	$user_id = Auth::guard($guard)->id();
    	$user = Admin::find($user_id);
    	$check_list = array();
    	foreach ($user->roles()->get() as $key => $value) {
    		$check_list = array_merge($check_list,$value->permissions()->pluck('permissions.slug')->toArray());
    		$check_list = array_unique($check_list);
    	}
    	return in_array($perm, $check_list);
    }



    public function sendAndroidPush($devices,$data)
    {
        $devices = array_values(array_diff($devices, array('token')));

        $fields = array('registration_ids' => $devices,
                        'data'              => $data);
       

        $headers = array('Authorization: key=' .'AAAAJ6x3akg:APA91bFKe2nqiyU-VV1aWSXnIuT3-qs_kSex87OyAWFm5YZYyHVCK-CTOH382VVVSiFmQ8XqCTn3jO5x8Q98vrY2QExQg_ZMnDxlZQDt1i2x8Ykhrm1QZaPXIqMwsLl83Vt7S7Y7owov','Content-Type: application/json');
        $ch = curl_init();
        curl_setopt( $ch,CURLOPT_URL,'https://fcm.googleapis.com/fcm/send');
        curl_setopt( $ch,CURLOPT_POST, true );
        curl_setopt( $ch,CURLOPT_HTTPHEADER, $headers );
        curl_setopt( $ch,CURLOPT_RETURNTRANSFER, true );
        curl_setopt( $ch,CURLOPT_SSL_VERIFYPEER, false );
        curl_setopt( $ch,CURLOPT_POSTFIELDS, json_encode( $fields ) );
        $result = curl_exec($ch );
        curl_close( $ch ); 
       //dd($result);
        return $result;
    }

    public function sendAndroidBulkPush($devices,$data)
    {
        $devices = array_unique($devices);
        $split_device = array_chunk($devices, 500);

        foreach ($split_device as $split) 
        {
            $split = array_values(array_diff($split, array('token')));

            $fields = array('registration_ids' => $split,
                        'data'              => $data);
       

            $headers = array('Authorization: key=' .'AAAAJ6x3akg:APA91bFKe2nqiyU-VV1aWSXnIuT3-qs_kSex87OyAWFm5YZYyHVCK-CTOH382VVVSiFmQ8XqCTn3jO5x8Q98vrY2QExQg_ZMnDxlZQDt1i2x8Ykhrm1QZaPXIqMwsLl83Vt7S7Y7owov','Content-Type: application/json');
            $ch = curl_init();
            curl_setopt( $ch,CURLOPT_URL,'https://fcm.googleapis.com/fcm/send');
            curl_setopt( $ch,CURLOPT_POST, true );
            curl_setopt( $ch,CURLOPT_HTTPHEADER, $headers );
            curl_setopt( $ch,CURLOPT_RETURNTRANSFER, true );
            curl_setopt( $ch,CURLOPT_SSL_VERIFYPEER, false );
            curl_setopt( $ch,CURLOPT_POSTFIELDS, json_encode( $fields ) );
            $result = curl_exec($ch );
            curl_close( $ch ); 
        }
        
        return $result;
    }

    public function sendIosBulkPush($devices,$data)
    {
        /*foreach ($devices as $key => $value) 
        {
            if(strlen($value) > 30)
            {
                Log::info('IOS Push --> 1');
                $msg=$data['message'];
                 // $apnsServer = 'ssl://gateway.sandbox.push.apple.com:2195';
                $apnsServer ='ssl://gateway.push.apple.com:2195';
                $privateKeyPassword = '';
                $message = $msg;
                $deviceToken =$value;
                $certificate =getcwd();
               // dd($certificate);
                $pushCertAndKeyPemFile = $certificate.'/iOS_certificates/apns-prod.pem';
                $stream = stream_context_create();
                stream_context_set_option($stream, 'ssl', 'passphrase', $privateKeyPassword);

                stream_context_set_option($stream, 'ssl', 'local_cert', $pushCertAndKeyPemFile);

                $connectionTimeout = 20;
                $connectionType = STREAM_CLIENT_CONNECT | STREAM_CLIENT_PERSISTENT;
                $connection = stream_socket_client($apnsServer, $errorNumber, $errorString, $connectionTimeout, $connectionType, $stream);

                $messageBody['aps'] = array('alert' => $message, 'sound' => 'default', 'badge' => 2,'category'=>'rich-apns');



                $data['aps']['badge']=0;
                $payload = json_encode($messageBody);
               // dd($payload);
                Log::info('IOS Push --> payload', $messageBody);
                $notification = chr(0) .
                pack('n', 32) .

               // $deviceToken = pack('H*', str_replace(' ', '', sprintf('%u', CRC32($deviceToken))));

                pack('H*', $deviceToken) .
                pack('n', strlen($payload)) .
                $payload;
                $wroteSuccessfully = fwrite($connection, $notification, strlen($notification));
                Log::info('IOS Push --> 2');
                if (!$wroteSuccessfully){
                    Log::info('IOS Push --> 3');
                    $result[]= "Could not send the message<br/>";
                }
                else {
                    Log::info('IOS Push --> 4');
                    $result[]= "Successfully sent the message<br/>";
                }
                Log::info('IOS Push --> 5');
                fclose($connection);
            }
        }*/

    }

    public function sendIosPush($devices,$data)
    {
        $devices = array_unique($devices);
        $result = array();
        foreach ($devices as $key => $value) 
        {
            if(strlen($value) > 60)
            {
                $apnsServer ='ssl://gateway.push.apple.com:2195';
                $privateKeyPassword = '';
                $deviceToken = $value;
                $certificate =getcwd();
                $pushCertAndKeyPemFile = $certificate.'/iOS_certificates/apns-prod.pem';
                
                $stream = stream_context_create();
                stream_context_set_option($stream,
                'ssl',
                'passphrase',
                $privateKeyPassword);
                stream_context_set_option($stream,
                'ssl',
                'local_cert',
                $pushCertAndKeyPemFile);

                $connectionTimeout = 20;
                $connectionType = STREAM_CLIENT_CONNECT | STREAM_CLIENT_PERSISTENT;
                $connection = stream_socket_client($apnsServer,
                $errorNumber,
                $errorString,
                $connectionTimeout,
                $connectionType,
                $stream);
                $messageBody['aps'] = array('alert' => $data,
                'sound' => 'default',
                'badge' => 1,
                "mutable-content" =>  "1",
                "category" =>  "rich-apns"
                );
                $payload = json_encode($messageBody);
                $notification = chr(0) .
                pack('n', 32) .
                pack('H*', $deviceToken) .
                pack('n', strlen($payload)) .
                $payload;
                $wroteSuccessfully = fwrite($connection, $notification, strlen($notification));
                if (!$wroteSuccessfully){
                // echo "Could not send the message<br/>";
                $result[] = "Could not send the message<br/>";
                }
                else {
                // echo "Successfully sent the message<br/>";
                    $result[] = "Successfully sent the message<br/>";
                }
                fclose($connection);
            }
        }
        return $result;
    }
    
    public function sendSms($number,$message,$template='')
    {
        $number = preg_replace('/(?<=\d)\s+(?=\d)/', '', $number);
        
        if($template == '')
            $url1 = 'thesmsbuddy.com/api/v1/sms/send?key=o7ILHF2vyRbMuoiWWuNmiJ0X0Mp6dvWX&type=1&to='.$number.'&sender=LULUMK&message='.urlencode($message).'&flash=0';
        else    
            $url1 = 'thesmsbuddy.com/api/v1/sms/send?key=o7ILHF2vyRbMuoiWWuNmiJ0X0Mp6dvWX&type=1&to='.$number.'&sender=LULUMK&message='.urlencode($message).'&flash=0&template_id='.$template;

        $response = '';
        $curl = curl_init();
        curl_setopt_array($curl, array(
        CURLOPT_RETURNTRANSFER => 1,
        CURLOPT_URL => $url1
        ));
        $response = curl_exec($curl);

        curl_close ($curl);

        return $response;
    }
}
