<?php

namespace App\Http\Helper;

use Illuminate\Support\Facades\Log;

class TokenClass {
    //https://stackoverflow.com/questions/1846202/how-to-generate-a-random-unique-alphanumeric-string
    /** @var string */
    protected static $alphabet;

    /** @var int */
    protected static $alphabetLength;


    /**
     * @param string $alphabet
     */
    public function __construct($alphabet = '')
    {
        // if ('' !== $alphabet) {
        //     self::setAlphabet($alphabet);
        // } else {
            // self::setAlphabet(
            //       implode(range('a', 'z'))
            //     . implode(range('A', 'Z'))
            //     . implode(range(0, 9))
            // );
        // }
    }

    /**
     * @param string $alphabet
     */
    public static function setAlphabet($alphabets)
    {
        self::$alphabet = $alphabets;
        self::$alphabetLength = strlen($alphabets);
    }

    /**
     * @param int $length
     * @return string
     */
    public static function generate($length)
    {
        // $token = '';
        // Log::info(self::$alphabetLength);
        // for ($i = 0; $i < $length; $i++) {
        //     $randomKey = rand(0, self::$alphabetLength);
        //     $token .= self::$alphabet[$randomKey];
        // }
        // String of all alphanumeric character
    $str_result = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
 
    // Shuffle the $str_result and returns substring
    // of specified length
    return substr(str_shuffle($str_result),
                       0, $length);

        // return $token;
    }

    /**
     * @param int $min
     * @param int $max
     * @return int
     */
    protected static function getRandomInteger($min, $max)
    {
        $range = ($max - $min);

        if ($range < 0) {
            // Not so random...
            return $min;
        }

        $log = log($range, 2);

        // Length in bytes.
        $bytes = (int) ($log / 8) + 1;

        // Length in bits.
        $bits = (int) $log + 1;

        // Set all lower bits to 1.
        $filter = (int) (1 << $bits) - 1;

        do {
            $rnd = hexdec(bin2hex(openssl_random_pseudo_bytes($bytes)));

            // Discard irrelevant bits.
            $rnd = $rnd & $filter;

        } while ($rnd >= $range);

        return ($min + $rnd);
    }
}