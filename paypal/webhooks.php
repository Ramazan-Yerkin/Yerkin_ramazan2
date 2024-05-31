<?php

include_once('helpers.php');

//proptino.co.uk/paypal/webhooks.php

$paypal_api_url = 'https://api-m.sandbox.paypal.com/';
$PAYPAL_CLIENT_ID = 'ASXMt5U5Sokwze0HpAod389w_qub0t4yD271ijUq2ukNxEjg-Vpa5ZlxT1Gb4r4uFbQW9UBxXFQiLyak';
$PAYPAL_SECRET = 'ECpHAIXUuIFHWVtatGygOrJ13ZrkHQ08cT-6wqryQ_nVHMqGk7zx3dumFJPJgnma4PHTb7gH7mXghQV9';

$request_body = file_get_contents('php://input');
file_put_contents('hooks_data/data_received_'.date("Y-m-d-H-i-s").'.txt', $request_body); 

$received_data = json_decode($request_body);

if($received_data->resource_type == 'subscription')
if($received_data->event_type == 'BILLING.SUBSCRIPTION.ACTIVATED')
{
    $ubscription_id = $received_data->resource->id;
    $plan_id = '';

    // Get access token
/*
    $headers = array(   "Accept: application/json", 
        "Accept-Language: en_US",
        "Content-Type: multipart/form-data"
    ); 

    $data = "grant_type=client_credentials";

    $results = paypal_api_call('POST', $paypal_api_url.'v1/oauth2/token', $data, $headers, $PAYPAL_CLIENT_ID.':'.$PAYPAL_SECRET);
    $json_token = json_decode($results);


    $received_data_ex = var_export($json_token, true);
    file_put_contents('hooks_data/received_data_ex'.date("Y-m-d-H-i-s").'.txt', $received_data_ex);

    if(empty($json_token->access_token))exit('Failing get access token');

    $access_token = $json_token->access_token;

    $headers = array(   "Accept: application/json", 
                        "Accept-Language: en_US",
                        "Content-Type: application/json",
                        "Authorization: Bearer $access_token",
                        ); 

    $subscription_activate = paypal_api_call('POST', $paypal_api_url."v1/billing/subscriptions/".$received_data->resource->id."/activate", NULL, $headers);

    file_put_contents('hooks_data/subscription_activate_'.date("Y-m-d-H-i-s").'.txt', $subscription_activate);

*/

    // if activated, save to db


}


// if PAYMENT.SALE.COMPLETED then extend for 1 month

if($received_data->resource_type == 'sale')
if($received_data->event_type == 'PAYMENT.SALE.COMPLETED')
{
    $subscription_id = $received_data->resource->billing_agreement_id;

    // extend package related

    // save sale transaction to transactions table

}

?>