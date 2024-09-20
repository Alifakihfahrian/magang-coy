<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Barang</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
    <div class="container mt-4">
        <h1>Edit Barang</h1>
        <form action="{{ route('barangs.update', $barang->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="name" class="form-label">Name:</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ $barang->name }}" required>
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Description:</label>
                <textarea class="form-control" id="description" name="description" required>{{ $barang->description }}</textarea>
            </div>
            <div class="mb-3">
                <label for="files" class="form-label">Upload File (Replace or Add More Files):</label>
                <input type="file" class="form-control" id="files" name="files[]" multiple>
                @if($barang->files->count() > 0)
                    <p>Current Files:</p>
                    <ul>
                        @foreach($barang->files as $file)
                            <li><a href="{{ asset('storage/' . $file->path) }}" target="_blank">{{ $file->filename }}</a></li>
                        @endforeach
                    </ul>
                @endif
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
            <a href="{{ route('barangs.index') }}" class="btn btn-secondary">Back to List</a>
        </form>
    </div>

    <!-- Bootstrap JS + Popper.js -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity
