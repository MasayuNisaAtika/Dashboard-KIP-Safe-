<?php
// Simulasi data obat untuk contoh
$medications = [
    1 => ['name' => 'Coba', 'quantity' => 10],
    2 => ['name' => 'Coba 2', 'quantity' => 5],
    // Tambahkan data lain sesuai kebutuhan
];

// Ambil ID dari parameter query
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;
$medication = isset($medications[$id]) ? $medications[$id] : null;

if (!$medication) {
    die("Obat tidak ditemukan.");
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Obat</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 p-5">

    <div class="container mx-auto">
        <h1 class="text-2xl font-bold mb-6">Edit Obat</h1>
        
        <form action="proses_edit.php" method="POST" class="bg-white shadow-md rounded-lg p-6">
            <input type="hidden" name="id" value="<?php echo $id; ?>">
            <div class="mb-4">
                <label for="name" class="block text-sm font-semibold mb-2">Nama Obat</label>
                <input type="text" id="name" name="name" value="<?php echo htmlspecialchars($medication['name']); ?>" class="border border-gray-300 rounded-lg p-2 w-full" required>
            </div>
            <div class="mb-4">
                <label for="quantity" class="block text-sm font-semibold mb-2">Jumlah Penggunaan</label>
                <input type="number" id="quantity" name="quantity" value="<?php echo htmlspecialchars($medication['quantity']); ?>" class="border border-gray-300 rounded-lg p-2 w-full" required>
            </div>
            <button type="submit" class="bg-blue-500 text-white rounded-lg px-4 py-2">Simpan</button>
            <a href="dashboard.php" class="text-blue-500 hover:underline ml-4">Kembali</a>
        </form>
    </div>

</body>
</html>
