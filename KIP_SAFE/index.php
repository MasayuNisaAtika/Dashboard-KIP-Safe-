<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KIP SAFE</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<nav class="bg-gray-100">
    <div class="bg-blue-600 p-4 text-white flex justify-between items-center">
        <h1 class="text-2xl font-bold">KIP SAFE</h1>
        <ul class="flex space-x-4">
            <li><a href="index.php" onclick="loadHome()" class="hover:underline">Home</a></li>
            <li><a href="dasboard-kip-safe.html" onclick="loadDashboard()" class="hover:underline">Dashboard</a></li>
            <li><a href="about.php" class="hover:underline">About</a></li>
            <li><a href="contact.php" class="hover:underline">Contact</a></li>
        </ul>
    </div>
    </nav>
<body>
    <div class="container mx-auto p-5" id="contentArea">
        <!-- Konten utama akan dimuat di sini -->
        <h1 class="text-2xl font-bold mb-6">Selamat Datang di KIP SAFE</h1>
        <p>Silakan pilih menu di atas untuk mulai.</p>
    </div>
    </body>
    <script>
        function loadHome() {
            const contentArea = document.getElementById('contentArea');
            contentArea.innerHTML = `
                <h1 class="text-2xl font-bold mb-6">Selamat Datang di KIP SAFE</h1>
                <p>Silakan pilih menu di atas untuk mulai.</p>
            `;
        }

        function loadDashboard() {
            const contentArea = document.getElementById('contentArea');
            contentArea.innerHTML = `
                <h1 class="text-2xl font-bold mb-6">Dashboard Klinik KBS</h1>
                <section class="bg-white shadow-md rounded-lg p-6 mb-6">
                    <h2 class="text-xl font-semibold mb-2">Kondisi Alat</h2>
                    <td class="text-left py-3 px-4">
                    </td>
                    <div id="equipmentStatus" aria-live="polite"></div>
                    <div class="flex gap-4">
                        <a href="hal_kondisi_baik.html" class="flex-1 p-4 border border-green-400 text-center rounded-lg shadow hover:bg-green-200 transition">
                            <h1 class="text-5xl font-normal">11</h1>
                            <h2 class="text-lg">Kondisi Baik</h2>
                        </a>
                        <a href="hal_kondisi_tidak_baik.html" class="flex-1 p-4 border border-red-400 text-center rounded-lg shadow hover:bg-red-200 transition">
                            <h1 class="text-5xl font-normal">7</h1>
                            <h2 class="text-lg">Kondisi Tidak Baik</h2>
                        </a>
                    </div>
                </section>
                <div class="bg-white shadow-md rounded-lg p-6 mb-6">
                    <h2 class="text-xl font-semibold mb-4">Kunjungan Pasien ke Klinik</h2>
                    <canvas id="patientVisitsChart"></canvas>
                </div>
                <section class="bg-white shadow-md rounded-lg p-6">
                    <h2 class="text-xl font-semibold mb-4">Penggunaan Obat</h2>
                    <table class="min-w-full bg-white">
                        <thead>
                            <tr class="bg-gray-200 border-b-2 border-gray-300">
                                <th class="py-2 px-4 text-left">No</th>
                                <th class="py-2 px-4 text-left">Nama Obat</th>
                                <th class="py-2 px-4 text-left">Jumlah Penggunaan</th>
                            </tr>
                        </thead>
                        <tbody id="medicationUsageTable">
                            <tr>
                                <td class="py-2 px-4 text-left">1</td>
                                <td class="py-2 px-4 text-left">Coba</td>
                                <td class="py-2 px-4 text-left">10</td>
                            </tr>
                            <tr>
                                <td class="py-2 px-4 text-left">2</td>
                                <td class="py-2 px-4 text-left">Coba 2</td>
                                <td class="py-2 px-4 text-left">5</td>
                            </tr>
                        </tbody>
                    </table>
                </section>
            `;

            // Ambil data kondisi alat dari backend
            fetch('api/equipment_status.php')
                .then(response => response.json())
                .then(data => {
                    const equipmentStatusDiv = document.getElementById('equipmentStatus');
                    let html = '<ul>';
                    data.forEach(item => {
                        html += `
                            <li class="flex justify-between border-b py-2">
                                <span>${item.name}</span>
                                <span class="${item.condition === 'Baik' ? 'text-green-500' : item.condition === 'Perlu Perawatan' ? 'text-yellow-500' : 'text-red-500'}">${item.condition}</span>
                            </li>
                        `;
                    });
                    html += '</ul>';
                    equipmentStatusDiv.innerHTML = html;
                })
                .catch(error => {
                    console.error('Error fetching equipment status:', error);
                });

            // Grafik Kunjungan Pasien
            const ctx1 = document.getElementById('patientVisitsChart').getContext('2d');
            const patientVisitsChart = new Chart(ctx1, {
                type: 'line',
                data: {
                    labels: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt','Nov','Des'],
                    datasets: [{
                        label: 'Kunjungan Pasien',
                        data: [2,4,3,6,4,8,8.5,7,5,6,3,8],
                        borderColor: 'rgba(75, 192, 192, 1)',
                        backgroundColor: 'rgba(75, 192, 192, 0.2)',
                        fill: true,
                    }]
                },
                options: {
                    responsive: true,
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        }
    </script>

</nav>
</html>
