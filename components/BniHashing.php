<?php
namespace app\components;

class BniHashing
{
    const TIME_DIFF_LIMIT = 300; // 5 menit

    // Use this to encrypt
    public static function hashData(array $json_data, $cid, $secret)
    {
        return self::doubleEncrypt(strrev(time()) . '.' . json_encode($json_data), $cid, $secret);
    }

    // Use this to decrypt
    public static function parseData($hased_string, $cid, $secret)
    {
        $parsed_string = self::doubleDecrypt($hased_string, $cid, $secret);
        list($timestamp, $data) = array_pad(explode('.', $parsed_string, 2), 2, null);
        if (self::tsDiff(strrev($timestamp)) === true) {
            return json_decode($data, true);
        }
        return null;
    }

    private static function tsDiff($ts)
    {
        return abs($ts - time()) <= self::TIME_DIFF_LIMIT;
    }

    private static function doubleEncrypt($string, $cid, $secret)
    {
        $result = '';
        $result = self::encrypt($string, $cid);
        $result = self::encrypt($result, $secret);
        return strtr(rtrim(base64_encode($result), '='), '+/', '-_');
    }

    private static function encrypt($string, $key)
    {
        $result = '';
        $strls = strlen($string);
        $strlk = strlen($key);
        for ($i = 0; $i < $strls; $i++) {
            $char = substr($string, $i, 1);
            $keychar = substr($key, ($i % $strlk) - 1, 1);
            $char = chr((ord($char) + ord($keychar)) % 128);
            $result .= $char;
        }
        return $result;
    }

    private static function doubleDecrypt($string, $cid, $secret)
    {
        $result = base64_decode(strtr(str_pad($string, ceil(strlen($string) / 4) * 4, '=', STR_PAD_RIGHT), '-_', '+/'));
        $result = self::decrypt($result, $cid);
        $result = self::decrypt($result, $secret);
        return $result;
    }

    private static function decrypt($string, $key)
    {
        $result = '';
        $strls = strlen($string);
        $strlk = strlen($key);
        for ($i = 0; $i < $strls; $i++) {
            $char = substr($string, $i, 1);
            $keychar = substr($key, ($i % $strlk) - 1, 1);
            $char = chr(((ord($char) - ord($keychar)) + 256) % 128);
            $result .= $char;
        }
        return $result;
    }
}
