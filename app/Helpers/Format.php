<?php
use Carbon\Carbon;

/** Language */
const ARABIC_PATTERNS = [
    '[يى]' => 'ي',
    '[هة]' => 'ه',
    '[اأإآ]' => 'ا',
];
function Lang(?string $name): string
{
    if (str_contains($name, '|')) {
        $parts = explode('|', $name);
        return match (getLang()) {
            'ar' => trim($parts[1] ?? $parts[0]),
            default => trim($parts[0])
        };
    }
    return trim($name);
}
function NameFormat(string $name): string
{
    $patterns = array_map(fn($p) => "/$p/u", array_keys(ARABIC_PATTERNS));
    return preg_replace($patterns, array_values(ARABIC_PATTERNS), $name);
}

/** Numbers */
function NumberFormat($value, $decimals = 2, $decimalPoint = '.', $thousandSeparator = ','): string
{
    return number_format(floatval($value), $decimals, $decimalPoint, $thousandSeparator);
}
function CountFormat(float $value): string
{
    $absValue = abs($value);
    $space = getLang() === 'ar' ? ' ' : '';

    switch (true) {
        case $absValue >= 1_000_000_000:
            return NumberFormat($value / 1_000_000_000, 1) . $space . __('date.billion');
        case $absValue >= 1_000_000:
            return NumberFormat($value / 1_000_000, 1) . $space . __('date.million');
        case $absValue >= 1_000:
            return NumberFormat($value / 1_000, 1) . $space . __('date.thousand');
        default:
            return NumberFormat($value, 0);
    }
}

/** Date & Time */
function DateFormat(?string $value = null, int $afterDays = 0): string
{
    $date = $value ? Carbon::parse($value) : Carbon::now();
    if ($afterDays > 0) {
        $date->addDays($afterDays);
    }
    return $date->translatedFormat('jS F Y');
}
function TimeFormat(?string $value = null): string
{
    $time = $value ? Carbon::parse($value) : Carbon::now();
    return $time->translatedFormat('g:i') . ' ' . trans('date.' . $time->format('a'));
}

function Year(?string $date = null): string
{
    return $date ? date('Y',$date) : date('Y');
}
function Month(?string $month = null): string
{
    return $month ? trans('date.' . $month) : trans('date.' . date('F'));
}
function Day(?string $day = null): string
{
    return $day ? trans('date.' . $day) : trans('date.' . date('l'));
}

/** Directions */
function Direction(): string
{
    return (getLang() === 'ar') ? 'rtl' : 'ltr';
}
function Arrow(): string
{
    return (getLang() === 'ar') ? 'left' : 'right';
}
function Align(): string
{
    return (getLang() === 'ar') ? 'right' : 'left';
}

