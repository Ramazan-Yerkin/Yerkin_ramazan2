<?php

/**
 * PayTabs PHP library
 *
 **/

class PayTabs
{
    /**
     * Privates
     */
    private $profileId = '';
    private $serverKey = '';
    private $lang = 'en';
    private $endpoint = 'https://secure-global.paytabs.com/';

    /**
     * Constructor
     *
     * @access public
     */
    public function __construct($payTabs)
    {
        if (!empty($payTabs)) {
            $this->profileId = $payTabs->public_key;
            $this->serverKey = $payTabs->secret_key;
            if ($payTabs->base_currency == 'AED') {
                $this->endpoint = 'https://secure.paytabs.com/';
                $this->lang = '';
            } elseif ($payTabs->base_currency == 'SAR') {
                $this->endpoint = 'https://secure.paytabs.sa/';
            } elseif ($payTabs->base_currency == 'OMR') {
                $this->endpoint = 'https://secure-oman.paytabs.com/';
            } elseif ($payTabs->base_currency == 'JOD') {
                $this->endpoint = 'https://secure-jordan.paytabs.com/';
            } elseif ($payTabs->base_currency == 'EGP') {
                $this->endpoint = 'https://secure-egypt.paytabs.com/';
            }
            $this->endpoint .= 'payment/request';
        }
    }

    /**
     * Send API Request
     *
     * @access public
     */

    public function sendApiRequest($data)
    {
        $data['profile_id'] = $this->profileId;
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => $this->endpoint,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => json_encode($data, true),
            CURLOPT_HTTPHEADER => array(
                'authorization:' . $this->serverKey,
                'Content-Type:application/json'
            )
        ));

        $response = json_decode(curl_exec($curl), true);
        curl_close($curl);
        return $response;
    }

    /**
     * Verify Redirect
     *
     * @access public
     */

    public function isValidRedirect($postData)
    {
        if (!empty($postData['signature'])) {
            // Request body include a signature post Form URL encoded field
            // 'signature' (hexadecimal encoding for hmac of sorted post form fields)
            $requestSignature = $postData['signature'];
            unset($postData['signature']);
            $fields = array_filter($postData);
            // Sort form fields
            ksort($fields);
            // Generate URL-encoded query string of Post fields except signature field.
            $query = http_build_query($fields);
            $signature = hash_hmac('sha256', $query, $this->serverKey);
            if (hash_equals($signature, $requestSignature) === TRUE) {
                // VALID Redirect
                return true;
            } else {
                // INVALID Redirect
                return false;
            }
        }
        return false;
    }
}