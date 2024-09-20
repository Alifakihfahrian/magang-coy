<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Barang</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
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
                <label for="jumlah_stok" class="form-label">Jumlah Stok:</label>
                <input type="number" class="form-control" id="jumlah_stok" name="jumlah_stok" value="{{ $barang->stok->jumlah_stok ?? '' }}" required>
            </div>
            <div class="mb-3">
                <label for="files" class="form-label">Upload New Files (Optional):</label>
                <input type="file" class="form-control" id="files" name="files[]" multiple>
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
            <a href="{{ route('barangs.index') }}" class="btn btn-secondary">Back to List</a>
        </form>
    </div>

    <!-- Bootstrap JS + Popper.js -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
