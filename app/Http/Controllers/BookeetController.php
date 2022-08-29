<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BookeetController extends Controller
{

    public function createVirtualAccount(Request $request)
    {
        $curl = curl_init();

        $customer_reference = $request->customer_reference;
        $name = $request->name;
        $email = $request->email;
        $mobile_number = $request->mobile_number;
        $expires_on = $request->expires_on;
        $use_frequency = $request->use_frequency;
        $min_amount = $request->min_amount;
        $max_amount = $request->max_amount;

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
                    "customer_reference": "' . 'someone' . '",
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

    public function getVirtualAccount(Request $request)
    {
        $curl = curl_init();

        $customer_reference = $request->customer_reference;

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://fsi.ng/api/woven/vnubans/' . 'customer_reference',
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

    public function getTransactions(Request $request)
    {
        $curl = curl_init();

        $customer_reference = $request->customer_reference;

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

    public function payout(Request $request)
    {
        $curl = curl_init();

        $source_account = $request->source_account;
        $pin = $request->pin;
        $beneficiary_account_name = $request->beneficiary_account_name;
        $beneficiary_nuban = $request->beneficiary_nuban;
        $beneficiary_bank_code = $request->beneficiary_bank_code;
        $bank_code_scheme = $request->bank_code_scheme;
        $currency_code = $request->currency_code;
        $narration = $request->narration;
        $amount = $request->amount;
        $reference = $request->reference;
        $callback_url = $request->callback_url;

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://fsi.ng/api/woven/payouts/request?command=initiate',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => '{
                "source_account": "7191836728",
                "PIN": "0047",
                "beneficiary_account_name": "Tosin Yadeka",
                "beneficiary_nuban": "3086177402",
                "beneficiary_bank_code": "000016",
                "bank_code_scheme": "NIP",
                "currency_code": "NGN",
                "narration": "For kitchen utensils",
                "amount": 100,
                "reference": "payout_87798184092728",
                "callback_url": ""
            }',
            CURLOPT_HTTPHEADER => array(
                'requestId: 73aedfdb-798e-46cc-86a1-4cd2db61fa64',
                'api-secret: vb_ls_bfac75fe54a952841971b6918d06aeb2659523dc92d6',
                'sandbox-key: aJM3F6DSJS0QLsa6eqDG05sHlTh9kKun1658897758',
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        echo $response;
    }
}
