<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <title>Laravel</title>
    <!-- Fonts -->
    <link href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
    <!-- Styles -->
    <style>
        body {
            font-family: 'Nunito', sans-serif;
        }

    </style>
</head>

<body class="antialiased">
    <div class="container">
        <h1>Books</h1>
        <table class="table table-striped table-bordered">
            <thead class="thead-light">
                <tr>
                    <th>ID</th>
                    <th>Book ID</th>
                    <th>Title</th>
                    <th>Author</th>
                    <th>Publisher</th>
                    <th>Keywords</th>
                    <th>ISBN</th>
                    <th>Category</th>
                    <th>Preview Link</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($books as $datas)
                {{-- @dd($datas->category) --}}
                <tr>
                    <td>{{ $start + $loop->index }}</td>
                    <td>{{ $datas['b_id'] }}</td>
                    <td>{{ $datas['title'] }}</td>
                    <td>{{ $datas['author'] }}</td>
                    <td>{{ $datas['publisher'] }}</td>
                    <td>
                        @if(!$datas->keywords->isEmpty())
                        @foreach ($datas->keywords as $keywords)
                        {{ $keywords->keywords }}<br>
                        @endforeach
                        @else
                        N/A
                        @endif
                    </td>

                    <td>{{ $datas['isbn'] }}</td>
                    <td>{{ $datas->category }}</td>
                    <td><a target="_blank" href="{{ $datas['preview_link'] }}" class="btn btn-primary">Preview</a></td>
                </tr>
                @endforeach
            </tbody>

        </table>
        {{ $books->links("pagination::bootstrap-4") }}
    </div>
</body>

</html>
