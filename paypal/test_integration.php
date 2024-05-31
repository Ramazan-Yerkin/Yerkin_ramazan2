<?php

include_once('helpers.php');

echo 'test';

$paypal_api_url = 'https://api-m.sandbox.paypal.com/';

$PAYPAL_CLIENT_ID = 'ASXMt5U5Sokwze0HpAod389w_qub0t4yD271ijUq2ukNxEjg-Vpa5ZlxT1Gb4r4uFbQW9UBxXFQiLyak';
$PAYPAL_SECRET = 'ECpHAIXUuIFHWVtatGygOrJ13ZrkHQ08cT-6wqryQ_nVHMqGk7zx3dumFJPJgnma4PHTb7gH7mXghQV9';

$method = '';

if(isset($_GET['method']))
{
    $method = $_GET['method'];
}


// Get access token

if($method == 'token')
{

/*
curl -v POST https://api-m.sandbox.paypal.com/v1/oauth2/token \
  -H "Accept: application/json" \
  -H "Accept-Language: en_US" \
  -u "CLIENT_ID:SECRET" \
  -d "grant_type=client_credentials"
*/

    $headers = array(   "Accept: application/json", 
        "Accept-Language: en_US",
        "Content-Type: multipart/form-data"
    ); 

    $data = "grant_type=client_credentials";

    $results = paypal_api_call('POST', $paypal_api_url.'v1/oauth2/token', $data, $headers, $PAYPAL_CLIENT_ID.':'.$PAYPAL_SECRET);

    $json = json_decode($results);

/*

object(stdClass)#1 (6) {
["scope"]=>
string(780) "https://uri.paypal.com/services/invoicing https://uri.paypal.com/services/vault/payment-tokens/read https://uri.paypal.com/services/disputes/read-buyer https://uri.paypal.com/services/payments/realtimepayment https://uri.paypal.com/services/disputes/update-seller https://uri.paypal.com/services/payments/payment/authcapture openid https://uri.paypal.com/services/disputes/read-seller Braintree:Vault https://uri.paypal.com/services/payments/refund https://api.paypal.com/v1/vault/credit-card https://api.paypal.com/v1/payments/.* https://uri.paypal.com/payments/payouts https://uri.paypal.com/services/vault/payment-tokens/readwrite https://api.paypal.com/v1/vault/credit-card/.* https://uri.paypal.com/services/subscriptions https://uri.paypal.com/services/applications/webhooks"
["access_token"]=>
string(97) "A21AAJLZsv5p0j7bPyYQEFMO7sEb9AVqaqxROXmoNn7mUnchtzUSOvMvRLe6e50RfOcFbfrCugJPcD-pr6f9O8Fq-V0qtbshA"
["token_type"]=>
string(6) "Bearer"
["app_id"]=>
string(21) "APP-80W284485P519543T"
["expires_in"]=>
int(32400)
["nonce"]=>
string(63) "2021-07-20T12:49:06ZSLtCOEHxBW-mLxC5dAvO1WmHlH1MDlos2QJZTJfGEnQ"
}

*/

    dump($json);
}

// Create product

if($method == 'product')
{

/*
    
curl -v -X POST https://api-m.sandbox.paypal.com/v1/catalogs/products \
  -H "Content-Type: application/json" \
  -H "Authorization: Bearer <Access-Token>" \
  -H "PayPal-Request-Id: <merchant-generated-ID>" \ // Optional and if passed, helps identify idempotent requests
-d '{
  "name": "Video Streaming Service",
  "description": "Video streaming service",
  "type": "SERVICE",
  "category": "SOFTWARE",
  "image_url": "https://example.com/streaming.jpg",
  "home_url": "https://example.com/home"
}'

*/

$headers = array(   "Accept: application/json", 
                    "Accept-Language: en_US",
                    "Content-Type: application/json",
                    "Authorization: Bearer A21AAJLZsv5p0j7bPyYQEFMO7sEb9AVqaqxROXmoNn7mUnchtzUSOvMvRLe6e50RfOcFbfrCugJPcD-pr6f9O8Fq-V0qtbshA",
                    //"PayPal-Request-Id: ".rand(1,9999)
); 

$data = array(
    "name" => "Video Streaming Service 1",
    "description"=> "Video streaming service 1",
    "type"=> "SERVICE",
    "category"=> "SOFTWARE",
    "image_url"=> "https://example.com/streaming1.jpg",
    "home_url"=> "https://example.com/home1"
);

//$data = http_build_query($data);

//echo $data;

/*
$data = '{
    "name": "Video Streaming Service 1",
    "description": "Video streaming service 1",
    "type": "SERVICE",
    "category": "SOFTWARE",
    "image_url": "https://example.com/streaming1.jpg",
    "home_url": "https://example.com/home1"
  }';*/

$results = paypal_api_call('POST', $paypal_api_url.'v1/catalogs/products', $data, $headers);


dump($results);

$json = json_decode($results);

dump($json);

/*

object(stdClass)#1 (5) {
  ["id"]=>
  string(22) "PROD-7K675233WJ360260S"
  ["name"]=>
  string(25) "Video Streaming Service 1"
  ["description"]=>
  string(25) "Video streaming service 1"
  ["create_time"]=>
  string(20) "2021-07-20T13:17:50Z"
  ["links"]=>
  array(2) {
    [0]=>
    object(stdClass)#2 (3) {
      ["href"]=>
      string(74) "https://api.sandbox.paypal.com/v1/catalogs/products/PROD-7K675233WJ360260S"
      ["rel"]=>
      string(4) "self"
      ["method"]=>
      string(3) "GET"
    }
    [1]=>
    object(stdClass)#3 (3) {
      ["href"]=>
      string(74) "https://api.sandbox.paypal.com/v1/catalogs/products/PROD-7K675233WJ360260S"
      ["rel"]=>
      string(4) "edit"
      ["method"]=>
      string(5) "PATCH"
    }
  }
}

*/

}

// Create plan

if($method == 'plan')
{

/*
    
curl -v -k -X POST https://api-m.sandbox.paypal.com/v1/billing/plans \
  -H "Accept: application/json" \
  -H "Authorization: Bearer Access-Token" \
  -H "PayPal-Request-Id: PLAN-18062020-001" \  // merchant generated ID, optional and needed for idempotent samples
  -H "Prefer: return=representation" \
  -H "Content-Type: application/json" \
  -d '{
      "product_id": "PROD-6XB24663H4094933M",
      "name": "Basic Plan",
      "description": "Basic plan",
      "billing_cycles": [
        {
          "frequency": {
            "interval_unit": "MONTH",
            "interval_count": 1
          },
          "tenure_type": "TRIAL",
          "sequence": 1,
          "total_cycles": 1
        },
        {
          "frequency": {
            "interval_unit": "MONTH",
            "interval_count": 1
          },
          "tenure_type": "REGULAR",
          "sequence": 2,
          "total_cycles": 12,
          "pricing_scheme": {
            "fixed_price": {
              "value": "10",
              "currency_code": "USD"
            }
          }
        }
      ],
      "payment_preferences": {
        "auto_bill_outstanding": true,
        "setup_fee": {
          "value": "10",
          "currency_code": "USD"
        },
        "setup_fee_failure_action": "CONTINUE",
        "payment_failure_threshold": 3
      },
      "taxes": {
        "percentage": "10",
        "inclusive": false
      }
    }'

*/

$headers = array(   "Accept: application/json", 
                    "Accept-Language: en_US",
                    "Content-Type: application/json",
                    "Authorization: Bearer A21AAJLZsv5p0j7bPyYQEFMO7sEb9AVqaqxROXmoNn7mUnchtzUSOvMvRLe6e50RfOcFbfrCugJPcD-pr6f9O8Fq-V0qtbshA",
                    "Prefer: return=representation",
                    //"PayPal-Request-Id: PLAN-18062020-".rand(1,9999)
); 

$data = array(
        "product_id" => "PROD-7K675233WJ360260S",
        "name" => "Basic Plan 1",
        "description" => "Basic plan 1",
        "billing_cycles"=> array(
            
                array(
                    "frequency" => array(
                        "interval_unit" => "MONTH",
                        "interval_count" => 1
                    ),
                    "tenure_type" => "REGULAR",
                    "sequence" => 1,
                    //"total_cycles" => 12,
                    "pricing_scheme" => array(
                        "fixed_price" => array(
                            "value" => "10",
                            "currency_code" => "USD"
                        )
                    )
                ),
        ),
        "payment_preferences" => array(
          "auto_bill_outstanding" => true,
          
          "setup_fee"=> array(
            "value"=> "0",
            "currency_code"=> "USD"
          ),

          "setup_fee_failure_action" => "CONTINUE",
          "payment_failure_threshold" => 3
        ),/*
        "taxes" => array(
          "percentage" => "10",
          "inclusive" => true
          )*/
);

echo json_encode($data);
//exit();

//$data = http_build_query($data);

//echo $data;

$results = paypal_api_call('POST', $paypal_api_url.'v1/billing/plans', $data, $headers);

dump($results);

$json = json_decode($results);

dump($json);

/*

object(stdClass)#1 (13) {
  ["id"]=>
  string(26) "P-5RA30866F8130112LMD3NFMI"
  ["product_id"]=>
  string(22) "PROD-7K675233WJ360260S"
  ["name"]=>
  string(10) "Basic Plan"
  ["status"]=>
  string(6) "ACTIVE"
  ["description"]=>
  string(10) "Basic plan"
  ["usage_type"]=>
  string(8) "LICENSED"
  ["billing_cycles"]=>
  array(1) {
    [0]=>
    object(stdClass)#4 (5) {
      ["pricing_scheme"]=>
      object(stdClass)#2 (4) {
        ["version"]=>
        int(1)
        ["fixed_price"]=>
        object(stdClass)#3 (2) {
          ["currency_code"]=>
          string(3) "USD"
          ["value"]=>
          string(4) "10.0"
        }
        ["create_time"]=>
        string(20) "2021-07-20T13:42:09Z"
        ["update_time"]=>
        string(20) "2021-07-20T13:42:09Z"
      }
      ["frequency"]=>
      object(stdClass)#5 (2) {
        ["interval_unit"]=>
        string(5) "MONTH"
        ["interval_count"]=>
        int(1)
      }
      ["tenure_type"]=>
      string(7) "REGULAR"
      ["sequence"]=>
      int(1)
      ["total_cycles"]=>
      int(1)
    }
  }
  ["payment_preferences"]=>
  object(stdClass)#6 (5) {
    ["service_type"]=>
    string(7) "PREPAID"
    ["auto_bill_outstanding"]=>
    bool(true)
    ["setup_fee"]=>
    object(stdClass)#7 (2) {
      ["currency_code"]=>
      string(3) "USD"
      ["value"]=>
      string(4) "10.0"
    }
    ["setup_fee_failure_action"]=>
    string(8) "CONTINUE"
    ["payment_failure_threshold"]=>
    int(3)
  }
  ["taxes"]=>
  object(stdClass)#8 (2) {
    ["percentage"]=>
    string(4) "10.0"
    ["inclusive"]=>
    bool(true)
  }
  ["quantity_supported"]=>
  bool(false)
  ["create_time"]=>
  string(20) "2021-07-20T13:42:09Z"
  ["update_time"]=>
  string(20) "2021-07-20T13:42:09Z"
  ["links"]=>
  array(3) {
    [0]=>
    object(stdClass)#9 (4) {
      ["href"]=>
      string(74) "https://api.sandbox.paypal.com/v1/billing/plans/P-5RA30866F8130112LMD3NFMI"
      ["rel"]=>
      string(4) "self"
      ["method"]=>
      string(3) "GET"
      ["encType"]=>
      string(16) "application/json"
    }
    [1]=>
    object(stdClass)#10 (4) {
      ["href"]=>
      string(74) "https://api.sandbox.paypal.com/v1/billing/plans/P-5RA30866F8130112LMD3NFMI"
      ["rel"]=>
      string(4) "edit"
      ["method"]=>
      string(5) "PATCH"
      ["encType"]=>
      string(16) "application/json"
    }
    [2]=>
    object(stdClass)#11 (4) {
      ["href"]=>
      string(85) "https://api.sandbox.paypal.com/v1/billing/plans/P-5RA30866F8130112LMD3NFMI/deactivate"
      ["rel"]=>
      string(4) "self"
      ["method"]=>
      string(4) "POST"
      ["encType"]=>
      string(16) "application/json"
    }
  }
}

*/

}

// Create payment

if($method == 'payment')
{

?>
<!DOCTYPE html>

<head>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
</head>

<body>
    <script
        src="https://www.paypal.com/sdk/js?client-id=<?php echo $PAYPAL_CLIENT_ID; ?>&vault=true&intent=subscription">
    </script>

    <div id="paypal-button-container"></div>

    <script>
        paypal.Buttons({
            createSubscription: function(data, actions) {
                return actions.subscription.create({
                    'plan_id': 'P-941573774M7319102MD3NOPQ'
                });
            },
            onApprove: function(data, actions) {
                alert('You have successfully created subscription ' + data.subscriptionID);
            }
        }).render('#paypal-button-container');
    </script>
</body>

<?php

/*

You have successfully created subscription I-SH9X1SD9A27S

*/

}


?>