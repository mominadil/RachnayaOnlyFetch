<head>
    @if(Route::is('home'))
    <title>Rachnaye - Ecosystem for Publishers, Readers, and Writers - Connect, Collaborate, and Create</title>
    @elseif(Route::is('category.slug'))
    <title>Rachnaye - Category: {{ Str::headline(Route::current()->parameter('category_slug')) }}</title>
    @elseif(Route::is('search'))
    <title>Rachnaye - Search Result for '{{ Str::headline(request('key')) }}', {{ count($book) }} records found</title>
    @elseif(Route::is('author.author_id'))
    <title>Rachnaye - Author: {{ Str::headline($book['author']) }}</title>
    @elseif(Route::is('publisher.publisher_id'))
    <title>Publisher: {{ Str::headline($book['publisher']) }}</title>
    @endif
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <!-- Font Awesome -->
    <script src="https://kit.fontawesome.com/53575efaf3.js" crossorigin="anonymous"></script>
    <!-- Google Fonts start -->
    <!-- Raleway Font -->
    <link rel="icon" type="image/x-icon" href="{{ asset(Storage::url('public/images/rachnaye-favicon.png')) }}">
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Raleway:wght@300;400;500;600;700&display=swap" rel="stylesheet" />
    <!-- Poppins Font -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&family=Raleway:wght@300;400;500;600;700&display=swap" rel="stylesheet" />
    <!-- Open Sans -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;500;600;700&family=Poppins:wght@300;400;500;600;700&family=Raleway:wght@300;400;500;600;700&display=swap" rel="stylesheet" />
    <!-- Google Fonts end -->
    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous" />
    <!-- CSS FILE -->
    {{--
    <link rel="stylesheet" href="css/style.css" /> --}}
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    {{-- <title>Rachaye</title> --}}
</head>