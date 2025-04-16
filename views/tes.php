<?php
// include __DIR__ . '/read_env.php';
$host = '127.0.0.1';
$dbname = 'tracer_study';
$username = 'root';
$password = '';

// $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
// $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$conn = new mysqli($host, $username, $password, $dbname);

// Ambil total mahasiswa
$sql_total_mahasiswa = "SELECT COUNT(*) AS total_mahasiswa FROM ts_data_mahasiswa1";
$result_total_mahasiswa = $conn->query($sql_total_mahasiswa);
$total_mahasiswa = ($result_total_mahasiswa->num_rows > 0) ? $result_total_mahasiswa->fetch_assoc()['total_mahasiswa'] : 0;

// Ambil jumlah yang sudah submit
$sql_total_submit = "
    SELECT COUNT(*) AS total_submit
    FROM ts_data_mahasiswa1 m
    LEFT JOIN register_mahasiswa r ON m.id_user = r.id_user
    LEFT JOIN submit_data s ON r.id_register = s.id_register
    WHERE s.id_register IS NOT NULL
";
$result_total_submit = $conn->query($sql_total_submit);
$total_submit = ($result_total_submit->num_rows > 0) ? $result_total_submit->fetch_assoc()['total_submit'] : 0;

$total_belum = $total_mahasiswa - $total_submit;

$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>TOAST UI Horizontal Bar Chart</title>
    <link rel="stylesheet" href="https://uicdn.toast.com/chart/latest/toastui-chart.min.css" />
    <script src="https://uicdn.toast.com/chart/latest/toastui-chart.min.js"></script>
    <style>
        #chart {
            width: 600px;
            height: 300px;
            margin: auto;
        }
    </style>
</head>
<body>
    <h2 style="text-align: center;">Statistik Submit Mahasiswa</h2>
    <div id="chart"></div>

    <script>
        const el = document.getElementById('chart');
        const data = {
            categories: ['Mahasiswa'],
            series: [
                {
                    name: 'Sudah Submit',
                    data: [<?= $total_submit ?>]
                },
                {
                    name: 'Belum Submit',
                    data: [<?= $total_belum ?>]
                }
            ]
        };

        const options = {
            chart: {
                type: 'bar',
                width: 600,
                height: 300
            },
            series: {
                horizontal: true
            },
            yAxis: {
                title: 'Kategori'
            },
            xAxis: {
                title: 'Jumlah'
            },
            legend: {
                align: 'bottom'
            }
        };

        toastui.Chart.barChart({ el, data, options });
    </script>
</body>
</html>