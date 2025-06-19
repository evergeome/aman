<?php
/** app/Helpers/Locale.php */

/** Default */
function defaultLanguage(): string
{
    return env('APP_LOCALE', 'ar');
}
function defaultLocation(): string
{
    return env('APP_COUNTRY', 'eg');
}

/** Supported */
function Languages(): array
{
    return [
        'ar' => ['name' => 'العربية','flag' => 'eg.png',],
        'en' => ['name' => 'English','flag' => 'gb.png',],
    ];
}
function Locations(): array
{
    return ['EG'];
}

/** Localization */
function Locale(): string
{
    $locale = request()->route('locale');
    if (!$locale && request()->hasCookie('locale')) {
        $locale = request()->cookie('locale');
    }
    if (!$locale) {
        $locale = client_locale();
    }
    return localeValidation($locale);
}

/** Testing For Supported Locations and languages */
function localeValidation($locale): string
{
    // Check Language is Supported
    $lang = explode('-', $locale)[0];
    $lang = (in_array($lang, array_keys(Languages()))) ? $lang : defaultLanguage();
    app()->setLocale($lang);
    // Check Country is Supported
    $country = explode('-', $locale)[1];
    $country = (in_array(strtoupper($country), Locations())) ? $country : defaultLocation();
    // Valid Locale
    $locale = $lang . '-' . $country;
    set_cookie('locale', $locale);
    return $locale;
}

/** Default Locale By Browser and IP */
function client_locale(): string
{
    // Detect browser language
    $lang = defaultLanguage();
    if (isset($_SERVER['HTTP_ACCEPT_LANGUAGE'])) {
        foreach (explode(',', $_SERVER['HTTP_ACCEPT_LANGUAGE']) as $browserLang) {
            $langCode = substr($browserLang, 0, 2);
            if (array_key_exists($langCode, Languages())) {
                $lang = $langCode;
                break;
            }
        }
    }
    // Detect country by IP
    $country = defaultLocation();
    $context = stream_context_create(['http' => ['timeout' => 2]]);
    $data = @unserialize(@file_get_contents('http://www.geoplugin.net/php.gp?ip=' . $_SERVER['REMOTE_ADDR'], false, $context));
    if (is_array($data) && isset($data['geoplugin_countryCode'])) {
        $countryCode = $data['geoplugin_countryCode'];
        if (in_array($countryCode, Locations())) {
            $country = strtolower($countryCode);
        }
    }
    return $lang . '-' . $country;
}

/** Functions */
function getLang(): string
{
    return explode('-', Locale())[0];
}
function getLocation(): string
{
    return explode('-', Locale())[1];
}
