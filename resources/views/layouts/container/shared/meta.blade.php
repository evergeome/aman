{{-- layouts/container/shared/meta.blade.php --}}
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<meta http-equiv="x-ua-compatible" content="ie=edge" />

<!-- Meta -->
<title>@yield('title')</title>
<meta name="author" content="{{ Author() }}" />
<meta name="description" content="@yield('description')" />
<meta name="keywords" content="{{ Name() }},{{ Description() }}@yield('keywords')" />

<!-- Icon -->
<link rel="icon" type="image/x-icon" href="/logo/favicon.ico">

<!-- Font -->
<link href="https://fonts.googleapis.com/css2?family=Cairo&display=swap" rel="stylesheet">
