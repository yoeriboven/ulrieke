<?php

namespace App;

class Crypter
{
    private $key = "ULRIEKE";

    public function encrypt($s)
    {
        return $this->base64Encode($this->xorWithKey(str_split($s), str_split($this->key)));
    }

    public function decrypt($s)
    {
        return $this->xorWithKey($this->base64Decode($s), str_split($this->key));
    }

    private function xorWithKey($a, $key2)
    {
        $out = [];
        $keyLen = count($key2);
        for ($i = 0; $i < strlen($a); $i++) {
            $out[] = $a[$i] ^ $key2[$i % $keyLen];
        }
        return implode('', $out);
    }

    private function base64Decode($s)
    {
        return base64_decode($s);
    }

    private function base64Encode($bytes)
    {
        return base64_encode($bytes);
    }
}
