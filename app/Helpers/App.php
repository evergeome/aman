<?php
/** app/Helpers/App.php */

use App\Models\Contact;
use Illuminate\Support\Facades\Http;

/** App Env */
function Name(): string
{
    return Lang(env('APP_NAME','Laravel'));
}
function Description(): string
{
    return Lang(env('APP_DESCR','Description'));
}
function Keywords($string): string
{
    mb_internal_encoding('UTF-8');
    $stopwords =
        array('i', 'a', 'about', 'an', 'and', 'are', 'as', 'at', 'be', 'by', 'com', 'de', 'en',
            'for', 'from', 'how', 'in', 'is', 'it', 'la', 'of', 'on', 'or', 'that', 'the', 'this',
            'to', 'was', 'what', 'when', 'where', 'who', 'will', 'with', 'und', 'the', 'www');
    $string = preg_replace('/[^\p{L}0-9 ]/u', '', trim(preg_replace('/\s\s+/iu', '', mb_strtolower($string))));
    $matchWords = array_filter(explode(' ', $string), function ($item) use ($stopwords) {
        return !($item == '' || in_array($item, $stopwords) || mb_strlen($item) <= 2 || is_numeric($item));
    });
    $wordCountArr = array_count_values($matchWords);
    arsort($wordCountArr);
    $return = array_keys(array_slice($wordCountArr, 0, 15));
    return (',' . implode(',', $return));
}
function Author(): string
{
    return Lang(env('AUTHOR','Karim'));
}
function Aman(): string
{
    return 'https://' . env('APP_URL') . '/';
}

/** Admin */
function isAdmin()
{
    return auth()->check() && in_array(auth()->id(), [1]);
}

/** Route */
function Subdomain()
{
    $domain = (explode('.', request()->getHost()));
    return (count($domain) > 2) ? $domain[0] : 'main';
}

/** Contact */
function Contact($get)
{
    if(has_cache('contact_'.$get)){
        return get_cache('contact_'.$get);
    }

    $value = Contact::where('get', $get)->first()?->value ?? '';
    set_cache('contact_'.$get, $value);
    return $value;
}

/** Api */
function Api($route)
{
    $response = Http::get($route);
    return $response->successful() ? $response->collect() : collect();
}
