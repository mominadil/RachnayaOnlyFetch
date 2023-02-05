<!DOCTYPE html>
<html lang="en">
@include('include.book.head')
{{-- @foreach($book as $book) --}}
{{-- @dd($book['title']) --}}

<body>
    @include('include.book.header')
    <main>
        <div class="container">
            {{-- @foreach($book as $book) --}}
            {{-- @dd($book) --}}

            <section id="book-info" class="book-info container-fluid">
                <!-- Book Short Description Start-->
                <section class="bk-srt-desc row">
                    <div class="bk-img-details d-flex gap-5 col-xl-7">
                        <div class="bk-info-name-img">
                            <!-- Book image -->
                            <div class="bk-img">
                                @php
                                use Cocur\Slugify\Slugify;
                                $slugify = new Slugify();
                                $slug = $slugify->slugify($book['title']);
                                // $slug = Str::slug($book['title']);
                                $imagePath = 'public/cached_images/image_'.$slug.'.jpg';
                                @endphp
                                @if (Storage::exists($imagePath)) 
                                <img class="bk-img-tag saved" title="{{ $book['title'] }}" src="{{ asset(Storage::url('public/cached_images/image_'.$slug.'.jpg')) }}" alt="{{ $book['title'] }}" />
                                @else
                                <img class="bk-img-tag {{$imagePath}}" src="{{ $book['thumbnailFront'] }}" alt="{{ $book['title'] }}" />
                                @endif
                            </div>
                        </div>
                        <!-- Book Short Info -->
                        <div class="bk-info-details">
                            <!-- Book name -->
                            <div class="info-name">
                                <h2 class="bk-info-head">{{ $book['title'] }}</h2>
                            </div>
                            <div class="info-authors d-flex">
                                <h4 class="info-ttl">Authors(s):</h4>
                                @foreach ($book['authors'] as $authors)
                                <h4 class="info-ans">{{ $authors['name'] }}</h4>
                                @endforeach
                            </div>
                            <div class="info-publisher d-flex">
                                <h4 class="info-ttl">Publisher:</h4>
                                <h4 class="info-ans">{{ $book['publisher']['name'] }}</h4>
                            </div>
                            <div class="info-language d-flex">
                                <h4 class="info-ttl">Language:</h4>
                                <h4 class="info-ans">{{ $book['language'] }}</h4>
                            </div>
                            <div class="info-pages d-flex">
                                <h4 class="info-ttl">Pages:</h4>
                                <h4 class="info-ans">{{ $book['digital']['pages'] ?? $book['paperback']['pages'] ?? $book['hardbound']['pages'] }}</h4>
                            </div>
                            <div class="info-country d-flex">
                                <h4 class="info-ttl">Country of Origin:</h4>
                                <h4 class="info-ans">{{ $book['originCountry'] }}</h4>
                            </div>
                            <div class="info-age d-flex">
                                <h4 class="info-ttl">Age Range:</h4>
                                <h4 class="info-ans">{{ $book['ageRange']['lowerLimit'] }}-{{ $book['ageRange']['upperLimit'] }}</h4>
                            </div>
                            <div class="info-time d-flex">
                                <h4 class="info-ttl">Average Reading Time</h4>
                                <h4 class="info-ans">{{ $book['avgReadingTime'] }} mins</h4>
                            </div>
                        </div>
                    </div>
                    <!-- Book price and buy option -->
                    <div class="bk-buy-con col-xl-4 col-lg-4">
                        <div class="bk-price-con d-flex align-items-center gap-3 mb-3">
                            <div class="price-radio">
                                <input class="input-radio-buy" type="radio" checked />
                            </div>
                            <div class="bk-price">
                                <h4>Buy Digital Copy</h4>
                                <div class="d-flex">
                                    <h5 class="me-2 bk-final-price">for</h5>
                                    {{-- <h5 class="bk-price-previous me-2 bk-final-price">
                                        &#8377;99
                                    </h5> --}}
                                    @if(isset($book['pricing']))
                                    @if(isset($book['pricing']['paperBackPrice']))
                                    <h5 class="bk-price-new bk-final-price">&#8377;{{  $book['pricing']['paperBackPrice'] }}</h5>
                                    @else
                                    @if(isset($book['pricing']['sellPrice']))
                                    <h5 class="bk-price-new bk-final-price">&#8377;{{  $book['pricing']['sellPrice'] }}</h5>
                                    @else
                                    @if(isset($book['pricing']['hardboundPrice']))
                                    <h5 class="bk-price-new bk-final-price">&#8377;{{  $book['pricing']['hardboundPrice'] }}</h5>
                                    @endif
                                    @endif
                                    @endif
                                    @endif

                                    {{-- <h5 class="bk-price-new bk-final-price">&#8377;{{ $validatedData['price'] }}</h5> --}}
                                </div>
                            </div>
                        </div>
                        <div class="bk-buy">
                            <a target="_blank" href="{{ redirect('http://app.rachnaye.com/digital/book?id='.$book['id'])->getTargetUrl() }}"><button class="w-100 bk-buy-btn">Buy Now</button></a>
                        </div>
                    </div>
                    <!-- Book Short Description End-->
                </section>
                <!-- Book Long Description starts -->
                <section class="bk-long-desc">
                    <div class="bk-head">
                        <h2 class="bk-head-ttl">Book Description</h2>
                    </div>
                    <div class="bk-summary">
                        <h4>
                            {{$book['description']}}
                        </h4>
                    </div>
                </section>
                {{-- @dd($book['keywords']) --}}
                <!-- Book Long Description ends -->
                <!-- Book Cover points start -->
                <section class="bk-cvr-pts d-flex">
                    {{-- @dd($book['keywords']) --}}
                    @foreach($book['keywords'] as $keywords)
                    {{-- @dd($keywords) --}}
                    <div class="cvr-ptr-ctr">
                        <div class="cvr-pt">{{ $keywords }}</div>
                    </div>
                    @endforeach
                </section>
                <!-- Book Cover points end -->
                <!-- Publisher info start -->
                {{-- @dd($book) --}}
                <section class="publisher-info">
                    <div class="pub-abt">
                        <h2>About Publisher</h2>
                    </div>
                    <div class="pub-abt-info">
                        {{-- @dd($book->publisher->bio) --}}
                        {{-- @foreach($book['publisher_details'] as $publisher) --}}
                        <h4>
                            {{-- {{ $book['publisher']['bio'] }} --}}
                        </h4>
                        {{-- @endforeach --}}
                    </div>
                </section>
                <!-- Publisher info end -->
                <!-- More Books Section starts -->
                <section class="more-bks-sec">
                    <div class="more-bks-heading">
                        <h2>More Books from {{ $book['publisher']['name'] }}</h2>
                    </div>
                    <div class="img-grid-container mt-3 row">
                        @foreach($book['publisher_details'] as $publisher_books)
                        {{-- @dd($publisher_books['slug']) --}}
                        <div class="img-grid-item col-xl-2 col-lg-3 col-md-4 col-sm-6">
                            <a href="{{ url('/book/'.$publisher_books['slug']) }}">
                                @php
                                // use Cocur\Slugify\Slugify;
                                $slugify = new Slugify();
                                $slug = $slugify->slugify($publisher_books['title']);
                                // $slug = Str::slug($book['title']);
                                $imagePath = 'public/cached_images/image_'.$slug.'.jpg';
                                @endphp
                                @if (Storage::exists($imagePath)) 
                                <img class="bk-img-tag saved" title="{{ $publisher_books['title'] }}" src="{{ asset(Storage::url('public/cached_images/image_'.$slug.'.jpg')) }}" alt="{{ $publisher_books['title'] }}" />
                                @else
                                <img class="bk-img-tag {{$imagePath}}" src="{{ $publisher_books['thumbnailFront'] }}" alt="{{ $publisher_books['title'] }}" />
                                @endif
                                {{-- <img class="bk-img-tag" src="{{ $publisher_books['thumbnailFront'] }}" alt="{{ $publisher_books['title'] }}" /> --}}
                            </a>
                        </div>
                        {{-- @if($loop->iteration =='6') --}}
                        {{-- @php break; @endphp --}}
                        {{-- @endif --}}
                        @endforeach
                    </div>
                </section>
                <!-- More Books Section ends -->
            </section>
            {{-- @endforeach --}}

        </div>
    </main>
</body>

</html>
