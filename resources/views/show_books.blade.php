<!-- Astrology Section Starts -->
@if(Route::is('home') )
{{-- @dd($categories); --}}
@foreach($categories as $category => $books)
<section class="bk-ctg-astrology mt-4 panel">
    <div class="bks-heading flex-wrap d-flex py-4 align-items-center justify-content-between">
        <h3 class="book-heading">{{ Str::headline($category) }}</h3>
        <!-- View All Forth comings button Start -->
        <div class="add-cart more">
            <a class="view-all-btn text-decoration-none" href="{{ url('/category/'.Str::slug($category)) }}">
                View All
            </a>
        </div>
        <!-- View All Forth comings button end -->
    </div>
    <!-- Forth coming Title and View All Button ends -->
    <ul class="row book-info-container">
        <!-- Book 1 -->
        @foreach($books as $book)


        {{-- @dd($book['pricing']['hardboundPrice']) --}}


        <li class="col-lg-3 col-sm-6 col-md-3 book-info p-2 d-flex flex-column align-items-center">
            <div class="book-image mb-2">
                <a href="{{ url('/book/'.$book['slug']) }}">
                    <img class="display-book" title="{{ $book['title'] }}" src="{{ $book['thumbnailFront'] }}" alt="{{ $book['title'] }}" />
                </a>
            </div>
            <label class="book-title mb-2 text-center">
                <a class="text-danger text-decoration-none" href="{{ url('/book/'.$book['slug']) }}">{{ $book['title'] }}</a>
            </label>
            <span class="buy">
                <i class="fa fa-inr"></i>
                @if(isset($book['pricing']))
                @isset($book['pricing']['paperBackPrice'])
                {{ $validatedData['price'] = $book['pricing']['paperBackPrice'] }}
                @elseif(!isset($book['pricing']['paperBackPrice']))
                @isset($book['pricing']['sellPrice'])
                {{ $validatedData['price'] = $book['pricing']['sellPrice'] }}
                @else
                {{ $validatedData['price'] = $book['pricing']['hardboundPrice'] }}
                @endif
                @endif
                @endif


            </span>
            <div class="add-cart mt-2">
                <a href="{{ url('/book/'.$book['slug']) }}">
                    <button class="cart-button">View Details</button>
                </a>
            </div>
        </li>
        {{-- @if(Request::path() !== 'category/'.$category->slug) --}}
        @if($loop->iteration =='4')
        @php break; @endphp
        @endif
        {{-- @endif --}}
        @endforeach
    </ul>
</section>
<!-- Astrology Section End -->
@if($loop->iteration =='4')
@php break; @endphp
@endif
@endforeach
@else
{{-- @foreach($book as $book) --}}
{{-- @dd($book['title']) --}}
<section class="bk-ctg-astrology mt-4 panel">
    <div class="bks-heading flex-wrap d-flex py-4 align-items-center justify-content-between">
        {{-- <h3 class="book-heading">{{ Str::headline($category->category) }}</h3> --}}
        <!-- View All Forth comings button Start -->
        {{-- <div class="add-cart more">
            <a class="view-all-btn text-decoration-none" href="#">
                View All
            </a>
        </div> --}}
        <!-- View All Forth comings button end -->
    </div>
    <!-- Forth coming Title and View All Button ends -->
    <ul class="row book-info-container">
        <!-- Book 1 -->
        @foreach($book as $book)
        <li class="col-lg-3 col-sm-6 col-md-3 book-info p-2 d-flex flex-column align-items-center">
            <div class="book-image mb-2">
                <a href="{{ url('/book/'.$book['slug']) }}">
                    <img class="display-book" title="{{ $book['title'] }}" src="{{ $book['thumbnailFront'] }}" alt="{{ $book['title'] }}" />
                </a>
            </div>
            <label class="book-title mb-2 text-center">
                <a class="text-danger text-decoration-none" href="{{ url('/book/'.$book['slug']) }}">{{ $book['title'] }}</a>
            </label>
            <span class="buy">
                <i class="fa fa-inr"></i>
                @if(isset($book['pricing']))
                @isset($book['pricing']['paperBackPrice'])
                {{ $validatedData['price'] = $book['pricing']['paperBackPrice'] }}
                @elseif(!isset($book['pricing']['paperBackPrice']))
                @isset($book['pricing']['sellPrice'])
                {{ $validatedData['price'] = $book['pricing']['sellPrice'] }}
                @else
                {{ $validatedData['price'] = $book['pricing']['hardboundPrice'] }}
                @endif
                @endif
                @endif


            </span>
            <div class="add-cart mt-2">
                <a href="{{ url('/book/'.$book['slug']) }}">
                    <button class="cart-button">View Details</button>
                </a>
            </div>
        </li>
        @endforeach
    </ul>
</section>
{{-- @endforeach --}}
@endif
