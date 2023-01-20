<?php
/*
Function for the called callAPI, makes use of the cURL php library that will call restapi
 * @param $path The path within the web service
 * @param $method "PUT", "DELETE", "GET", or "POST"
 * @param $body The body of the request (should be json encoded)
 * 
 * @return ["data"=>associative array of contents, "response"=>http response code]

*/ 

function callAPI($path, $method, $body = ""){
    $APIcall = "http://localhost/mystuff/Assignment3".$path;
    // echo$APIcall;
    // echo$method;
    // createthe curl handler
    $ch = curl_init(); 
    // setting url                             
    curl_setopt($ch, CURLOPT_URL, $APIcall);    
    // returns the body   
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); 
    // set the method
    if ($method == "POST") {                        
        curl_setopt($ch,CURLOPT_POST,1);
        // set the body
        curl_setopt($ch, CURLOPT_POSTFIELDS, $body);    
    } elseif ($method == "PUT" ) {
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");
        // set the body
        curl_setopt($ch, CURLOPT_POSTFIELDS, $body);    
    } elseif ($method == "DELETE" ) {
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "DELETE");
        // set the body
        curl_setopt($ch, CURLOPT_POSTFIELDS, $body);    
    }
    // send the request
    $output = curl_exec($ch);                       
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);
    
    return array('data'=>json_decode($output, true),'response'=>$httpCode);
}
?>