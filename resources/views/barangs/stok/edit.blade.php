<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Stok</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
    <div class="container mt-4">
        <h1>Edit Stok</h1>
        <!-- Form untuk mengupdate stok -->
        <form action="{{ route('stok.update', $stok->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="barang_id" class="form-label">Barang:</label>
                <select class="form-select" id="barang_id" name="barang_id" required>
                    @foreach($barangs as $barang)
                        <option value="{{ $barang->id }}" {{ $stok->barang_id == $barang->id ? 'selected' : '' }}>
                            {{ $barang->name }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label for="jumlah_stok" class="form-label">Jumlah Stok:</label>
                <input type="number" class="form-control" id="jumlah_stok" name="jumlah_stok" value="{{ old('jumlah_stok', $stok->jumlah_stok) }}" required>
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
            <a href="{{ route('stok.index') }}" class="btn btn-secondary">Back to List</a>
        </form>
    </div>

    <!-- Bootstrap JS + Popper.js -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
