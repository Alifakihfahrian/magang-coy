<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Show Barang</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-4">
        <h1>Barang Details</h1>
        <p><strong>ID:</strong> {{ $barang->id }}</p>
        <p><strong>Name:</strong> {{ $barang->name }}</p>
        <p><strong>Description:</strong> {{ $barang->description }}</p>

        <h3>Stok Details</h3>
        <p><strong>Jumlah Stok:</strong> {{ $stok->jumlah_stok ?? 'Not available' }}</p>

        <!-- Display uploaded files -->
        @if($barang->files->isNotEmpty())
            <div class="mb-3">
                <strong>Files:</strong>
                <ul>
                    @foreach($barang->files as $file)
                        <li><img width="40px" height="40px" src="{{ asset('storage/' . $file->path) }}" alt="File"></li>
                    @endforeach
                </ul>
            </div>
        @else
            <p>No files uploaded</p>
        @endif

        <a href="{{ route('barangs.index') }}" class="btn btn-secondary">Back to List</a>
    </div>

    <!-- Bootstrap JS + Popper.js -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
