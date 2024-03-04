@extends('layout.master')
@section('content')
    @include('admin.layout.nav-side')
    <div class="p-4 sm:ml-64">
        <div class="container mx-auto p-2">
            <div class="grid grid-cols-1 gap-6">
                <!-- Grafik Pengguna yang Melakukan Pelaporan -->
                <div data-aos="fade-up" class="border border-gray-200 rounded-sm bg-white p-4 shadow-md">
                    <h2 class="text-lg font-semibold mb-4">Laporan Masuk</h2>
                    <canvas class="w-full" id="reportsChart" height="200"></canvas>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        $(document).ready(function() {
            $.ajax({
                url: '/getData',
                type: 'get',
                success: function(response) {
                    var reportsPerDay = response.data;
                    console.log(reportsPerDay); 
                    createChart(reportsPerDay);

                },
                error: function(xhr, status, error) {
                    console.error('Error:', error);
                }

            })

            function createChart(reportsPerDay) {
                var labels = reportsPerDay.map(function(report) {
                    return report.date;
                });
                var data = reportsPerDay.map(function(report) {
                    return report.count;
                });

                // Konfigurasi untuk grafik
                var ctx = document.getElementById('reportsChart').getContext('2d');
                var chartConfig = {
                    type: 'line',
                    data: {
                        labels: labels,
                        datasets: [{
                            label: 'Jumlah Laporan',
                            data: data,
                            backgroundColor: 'rgba(54, 162, 235, 0.2)',
                            borderColor: 'rgba(54, 162, 235, 1)',
                            borderWidth: 1
                        }]
                    },
                    options: {
                        scales: {
                            y: {
                                beginAtZero: true
                            }
                        }
                    }
                };

                // Buat grafik menggunakan konfigurasi yang telah ditentukan
                var reportsChart = new Chart(ctx, chartConfig);
            }
        })
    </script>
@endpush
