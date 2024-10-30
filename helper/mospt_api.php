<?php

class MOSPT_API
{

    public function mospt_wp_remote_post($url, $args = array())
    {
        $response = wp_remote_post($url, $args);

        if(!is_wp_error($response))
            {
            return $response['body'];
            } else
            {
            return json_encode('ERROR');
            }
    }

    function mospt_make_curl_call( $url, $fields, $http_header_array =array("Content-Type"=>"application/json","charset"=>"UTF-8","Authorization"=>"Basic")) {

        if ( gettype( $fields ) !== 'string' ) {
            $fields = json_encode( $fields );
        }

        $args = array(
            'method' => 'POST',
            'body' => $fields,
            'timeout' => '5',
            'redirection' => '5',
            'httpversion' => '1.0',
            'blocking' => true,
            'headers' => $http_header_array
        );

        $mospt_api =  new MOSPT_API();
        return $mospt_api->mospt_wp_remote_post($url, $args);

    }

   
}