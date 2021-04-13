<?php
if (!function_exists('text')) {
    function text($data)
    {
        $utf8 = array(
            "ç",
            "ı",
            "ü",
            "ğ",
            "ö",
            "ş",
            "İ",
            "Ğ",
            "Ü",
            "Ö",
            "Ş",
            "Ç");
        $url = array(
            "=C3=A7",
            "=C4=B1",
            "=C3=BC",
            "=C4=9F",
            "=C3=B6",
            "=C5=9F",
            "=C4=B0",
            "=C4=9E",
            "=C3=9C",
            "=C3=96",
            "=C5=9E",
            "=C3=87");
        $data = str_replace($url, $utf8, $data);
        return $data;
    }
}

if (!function_exists('zaman')) {
    function zaman($zaman)
    {
        $zaman = strtotime($zaman);
        $zaman_farki = time() - $zaman;
        $saniye = $zaman_farki;
        $dakika = round($zaman_farki / 60);
        return $dakika;
    }
}

if (!function_exists('locales')) {
    function locales($route = false)
    {
        if ($route) {
            $locales = ['tr', 'en', 'de'];
        } else {
            $locales = [
                'tr' => 'Türkçe',
                'en' => 'English',
                'de' => 'Deutsch'
            ];
        }

        return $locales;
    }
}
