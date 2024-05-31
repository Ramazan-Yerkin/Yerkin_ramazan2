<?php

function paypal_api_call($method, $url, $data, $headers = false, $userpass = NULL){
    $curl = curl_init();

    //$data = 'email=test';

    switch ($method){
       case "POST":
          curl_setopt($curl, CURLOPT_POST, 1);
          //curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "POST");
          if ($data)
          {
            //$data = http_build_query($data);

            if(is_array($data))
                $data = json_encode($data);

            curl_setopt($curl, CURLOPT_POSTFIELDS, $data);

            if($headers === FALSE)
                $headers = array('Content-Type: multipart/form-data');
          }
             
          break;
       case "PUT":
          curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "PUT");
          if ($data)
             curl_setopt($curl, CURLOPT_POSTFIELDS, $data);			 					
          break;
        case "DELETE":
          curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "DELETE");
          if ($data)
             curl_setopt($curl, CURLOPT_POSTFIELDS, $data);			 					
          break; 
       default:
          if ($data)
             $url = sprintf("%s?%s", $url, http_build_query($data));
    }
    // OPTIONS:
    curl_setopt($curl, CURLOPT_URL, $url);
    if(!$headers){
        curl_setopt($curl, CURLOPT_HTTPHEADER, array(
           'Content-Type: application/json',
        ));
    }else{
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);

        if(isset($headers['User-Agent']))
            curl_setopt($curl, CURLOPT_USERAGENT, $headers['User-Agent']);
    }
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);

    if(!empty($userpass))
    {
        curl_setopt($curl, CURLOPT_USERPWD, $userpass);
    }

    // EXECUTE:
    $result = curl_exec($curl);
    if(!$result){return FALSE;}
    curl_close($curl);
    return $result;
}

function dump($var)
{
    echo '<pre>';
    var_dump($var);
    echo '</pre>';
}


?>