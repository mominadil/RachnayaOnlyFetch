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
                        @elseif(Route::is('author.author_id'))
                        @include('show_books', ['book' => $author_book])
                        @elseif(Route::is('publisher.publisher_id'))
                        @include('show_books', ['book' => $publisher_book])
                        @elseif(Route::is('search'))
                        @include('show_books', ['book' => $results])
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
    <script src="{{ asset('js/app.js') }}"></script>
    {{--
    <link href="{{ asset('css/app.css') }}" rel="stylesheet"> --}}
</body>
<script>
$(document).ready(function() {
    $('input[name="key"]').on('keyup', function() {
        var key = $(this).val();
        $.ajax({
            url: '{{ route("search") }}',
            method: 'get',
            data: {
                key: key
            },
            success: function(response) {
                var html = '';
                if (response.length > 0) {
                    html += '<h3>Search results for "' + key + '":</h3>';
                    html += '<ul class="results-list">';
                    for (var i = 0; i < response.length; i++) {
                        html += '<li class="result-item">';
                        html += '<a href="/book/' + response[i]['slug'] + '">' + response[i]['title'] + '</a>';
                        html += '</li>';
                    }
                    html += '</ul>';
                } else {
                    html += '<p>No results found for "' + key + '".</p>';
                }
                // console.log(html)
                $('.results-container').html(html);
            }

        });
    });
});

</script>

</html>
