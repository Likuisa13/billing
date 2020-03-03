<?php

namespace app\components;
use app\components\BniHashing;

class Ecoll
{
    const ECOLL_URL = 'http://172.20.2.84/bni-ecollection/_api/';

    public function createBilling($data, $sk)
    {
        /* sample $data */
        /*{
            "type" : "createbilling",
            "client_id" : "001",
            "trx_id" : "1230000001",
            "trx_amount" : "100000",
            "billing_type" : "c",
            "customer_name" : "Mr. X",
            "customer_email" : "xxx@email.com",
            "customer_phone" : "08123123123",
            "virtual_account" : "8001000000000001",
            "datetime_expired" : "2016-03-01T16:00:00+07:00",
            "description" : "Payment of Trx 123000001"
        }*/
        // $dt = "FBkYGR5JIBoWGERcCExUe3pVCEZJdzMiChRFFwcUOFxTWT9QSjUiBjU4RxEaDBQzDFAFXFVzfkdISHhUW1YJCxsCGiAVRBkTFBhIFBUZGUFFGTUTAwYDYUZFA1RaVwkKHAIQChE1TFhUWwVOS1tHAHZUeQkaNVVfUU9";
        $hashdata = BniHashing::hashData($data, $data['client_id'], $sk);
        // $hashdata = BniHashing::parseData($dt, $data['client_id'], $sk);
        $array_hash = array(
            'client_id' => $data['client_id'],
            'data' => $hashdata,
        );

        $ecoll_data = json_encode($array_hash);
        return $ecoll_data;
        // return $this->call($ecoll_data);
    }

    public function updateBilling($data, $sk) 
    {
        /* sample $data */
        /*{
            "client_id" : "001",
            "trx_id" : "1230000001",
            "trx_amount" : "100000",
            "customer_name" : "Mr. X",
            "customer_email" : "xxx@email.com",
            "customer_phone" : "08123123123",
            "datetime_expired" : "2016-03-30T23:00:00+07:00",
            "description" : "Payment of Trx 123000001",
            "type" : "updateBilling"
        }*/
        $hashdata = BniHashing::hashData($data, $data['client_id'], $sk);

        $array_hash = array(
            'client_id' => $data['client_id'],
            'data' => $hashdata,
        );

        $ecoll_data = json_encode($array_hash);

        return $this->call($ecoll_data);
    }

    public function inquiryBilling($data, $sk) 
    {
        /* sample $data */
        /*{
            "type" : "inquirybilling",
            "client_id" : "001",
            "trx_id" : "1230000001", 
        }*/
        $hashdata = BniHashing::hashData($data, $data['client_id'], $sk);

        $array_hash = array(
            'client_id' => $data['client_id'],
            'data' => $hashdata,
        );

        $ecoll_data = json_encode($array_hash);

        return $this->call($ecoll_data);
    }

    public function call($data)
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => self::ECOLL_URL,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => $data,
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_HTTPHEADER => array("content-type: application/json"),
        ));

        $result = curl_exec($curl);
        if(curl_errno($curl) == 28) {
            return '{"status":"010", "message":"Request Timeout"}';
        }
        curl_close($curl);

        return $result;
    }
}
