<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class USSDController extends Controller
{
    public function index()
    {
        $sessionId   = $_POST["sessionId"];
        $serviceCode = $_POST["serviceCode"];
        $phoneNumber = $_POST["phoneNumber"];
        $text        = $_POST["text"];

        if ($text == "") {
            $response  = "CON Welcome back \n";
            $response .= "1. My Account details \n";
            $response .= "2. Transactions \n";
            $response .= "3. Transfer";
        } else if ($text == "1") {
            $response = "CON Choose account information you want to view \n";
            $response .= "1. Account number \n";
            $response .= "2. Account balance \n";
        } else if ($text == "2") {
            $response = "END You don't have any transactions";
        } else if ($text == "3") {
            $response  = "CON Choose a bank \n";
            $response .= "1. Sterling \n";
            $response .= "2. GTBank \n";
            $response .= "3. Zenith";
        } else if ($text == "1*1") {
            $account = $this->createVirtualAccount($phoneNumber);

            $data = json_decode($account, true);

            $accountNumber = $data['data']['vnuban'];

            $response = "END Your account number is " . $accountNumber;
        } else if ($text == "1*2") {
            $account = $this->createVirtualAccount($phoneNumber);

            $data = json_decode($account, true);

            $bankName = $data['data']['bank_name'];
            $accountBalance = "₦ 0.00";

            $response = "END Your " . $bankName . " account balance is " . $accountBalance;
        } else if ($text == "3*1") {
            $response  = "End Dial *384*8334*1*ACCOUNT NUMBER*AMOUNT# to complete your transaction. \n";
        }

        header('Content-type: text/plain');
        echo $response;
    }

    public function createVirtualAccount(String $phone)
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://fsi.ng/api/woven/vnubans/create_customer',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => '{
                "customer_reference": "' . $phone . '",
                "name": "Adelaide Jones",
                "email": "jones_adelaide@mail.com",
                "mobile_number": "08012345678",
                "expires_on": "2021-11-01",
                "use_frequency": "5",
                "min_amount": 2000,
                "max_amount": 12000
            }',
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json',
                'requestId: 5422cb96-5598-4568-b69d-a4875db41c2e',
                'api-secret: vb_ls_bfac75fe54a952841971b6918d06aeb2659523dc92d6',
                'sandbox-key: aJM3F6DSJS0QLsa6eqDG05sHlTh9kKun1658897758',
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);

        return $response;
    }

    public function getVirtualAccount(String $phone)
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://fsi.ng/api/woven/vnubans/' . $phone,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json',
                'requestId: 6c1e9208-5ef3-4e3e-92b1-f2bf6d03bb89',
                'api-secret: vb_ls_bfac75fe54a952841971b6918d06aeb2659523dc92d6',
                'sandbox-key: aJM3F6DSJS0QLsa6eqDG05sHlTh9kKun1658897758',
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);

        return $response;
    }

    public function getTransactions()
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://fsi.ng/api/woven/transactions?unique_reference=SPKL100007629691015402841616569308257',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
            CURLOPT_HTTPHEADER => array(
                'requestId: 91c5d097-3d90-456f-9f9f-bd4387a75ead',
                'api-secret: vb_ls_bfac75fe54a952841971b6918d06aeb2659523dc92d6',
                'sandbox-key: aJM3F6DSJS0QLsa6eqDG05sHlTh9kKun1658897758',
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);

        echo $response;
    }
}
