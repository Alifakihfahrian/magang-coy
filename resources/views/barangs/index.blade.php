<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Barang List</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-4">
        <h1>Barang List</h1>
        <a href="{{ route('barangs.create') }}" class="btn btn-primary mb-3">Create New Barang</a>
        <table class="table table-bordered">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Stok</th>
                    <th>Files</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($barangs as $barang)
                    <tr>
                        <td>{{ $barang->id }}</td>
                        <td>{{ $barang->name }}</td>
                        <td>{{ $barang->description }}</td>
                        <td>{{ $barang->stok->jumlah_stok ?? 'Not available' }}</td>
                        <td>
                            @if($barang->files->isNotEmpty())
                                <ul>
                                    @foreach($barang->files as $file)
                                        <li><img width="40px" height="40px" src="{{ asset('storage/' . $file->path) }}" alt="File"></li>
                                    @endforeach
                                </ul>
                            @else
                                No files uploaded
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('barangs.show', $barang->id) }}" class="btn btn-info btn-sm">View</a>
                            <a href="{{ route('barangs.edit', $barang->id) }}" class="btn btn-warning btn-sm">Edit</a>
                            <form action="{{ route('barangs.destroy', $barang->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Bootstrap JS + Popper.js -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
