<?php

/**
 * Class UrlReader
 */
class UrlReader
{
    /**
     * @param $url
     * @param null $referer
     * @return mixed|string
     */
    static public function url_reader($url, $referer = null)
    {
        if (function_exists('curl_init')) {
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            if ($referer) {
                curl_setopt($ch, CURLOPT_REFERER, $referer);
            }
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            $data = curl_exec($ch);
            curl_close($ch);
        }
        else {
            $data = '';
            $handle = fopen($url, 'rb');
            while (!feof($handle)) {
                $data .= fread($handle, 8192);
            }
            fclose($handle);
        }
        return $data;
    }
}