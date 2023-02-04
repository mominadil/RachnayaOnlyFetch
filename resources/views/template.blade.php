<!DOCTYPE html>
<html lang="en">
@include('include.head')
{{-- @dd($book) --}}
{{-- @foreach($categories as $category => $books) --}}
{{-- {{Str::headline($category)}} --}}
{{-- @endforeach --}}

<body>
    <!-- Header section start -->
    @include('include.header')
    <!-- Header section ends -->
    <!-- Main section starts -->
    <main>
        <section id="main-content">
            <div class="container">
                <div class="row container-fluid toggle">
                    <!-- Sidebar Section starts here -->
                    @include('include.sidebar', ['categories' => $categories])
                    <!-- Sidebar Section ends here -->
                    <!-- Books Category Section starts here -->
                    <section class="col-lg-9 col-sm-12 book-categories pb-5">
                        <div class="container">
                            <img class="prahat-books-img" src="{{ Storage::url('images/prabhat-books.jpg') }}" alt="prahat books image" />
                        </div>
                        <!-- Popular Book Category Section  Starts-->
                        <!-- Popular Book Category Section  Ends-->
                        @if(Route::is('home'))
                        @include('show_books', ['categories' => $categories])
                        @elseif(Route::is('category.slug'))
                        @include('show_books', ['book' => $book])
                        {{-- @include('show_books', ['category' => $category, 'book' => $book]) --}}
                        @endif
                    </section>
                    <!-- Books category section ends here -->
                </div>
            </div>
        </section>
    </main>
    <!-- Main section ends -->
    <!-- Footer 1 section starts -->
    @include('include.footer')
    <!-- Footersection 1 ends -->
    <!-- Bootstrap -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
    <!-- Javascrit file -->
    {{-- <script src="script/main.js"></script> --}}
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</body>

</html>
