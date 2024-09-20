<!-- resources/views/posts/index.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Barang</title>
    <link rel="stylesheet" href="{{ asset('style.css') }}">
</head>
<body>
    <div class="container">
        <h1>List Barang</h1>
        
        <a href="{{ route('posts.create') }}" class="btn">Insert New Barang</a>
        
        @if (session('success'))
            <div class="alert">{{ session('success') }}</div>
        @endif
        
        <ul class="post-list">
            @forelse ($posts as $post)
                <li>
                    <a href="{{ route('posts.show', $post->id) }}">{{ $post->title }}</a>
                    <a href="{{ route('posts.edit', $post->id) }}" class="btn" style="margin-left: 10px;">Edit</a>
                    <form action="{{ route('posts.destroy', $post->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn" style="background-color: #dc3545; margin-left: 10px;">Delete</button>
                    </form>
                </li>
            @empty
                <li>No data available.</li>
            @endforelse
        </ul>
    </div>
</body>
</html>
