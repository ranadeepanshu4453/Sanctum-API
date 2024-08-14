<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
    <div class="div">
        <h1>Data Visualization Dashboard</h1>
        
        <!-- Bar Chart -->
        <canvas id="myChart" width="400" height="200"></canvas>

        <!-- Student Information Table -->
        <h2>Student Information</h2>
        <table border="1" style="width:100%; margin-top: 20px;">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Address</th>
                    <th>Email</th>
                </tr>
            </thead>
            <tbody>
                @foreach($students as $student)
                <tr>
                    <td>{{ $student->name }}</td>
                    <td>{{ $student->address }}</td>
                    <td>{{ $student->email }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <script>
        const data = @json($data);
        const labels = data.map(item => item.name); // Assuming 'name' is a column in your data
        const counts = data.map(item => item.count); // Assuming 'count' is the aggregate count

        const ctx = document.getElementById('myChart').getContext('2d');
        const myChart = new Chart(ctx, {
            type: 'bar', // Change to 'bar','line', 'pie', etc. as needed
            data: {
                labels: labels,
                datasets: [{
                    label: 'Student Count',
                    data: counts,
                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                    borderColor: 'rgba(75, 192, 192, 1)',
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
        });
    </script>

</body>
<style>
    h1 {
        margin-left: 20%;
    }
    .div {
        max-width: 50%;
        margin: auto;
    }
    table {
        margin-top: 20px;
        border-collapse: collapse;
        width: 100%;
    }
    th, td {
        padding: 8px;
        text-align: left;
    }
    th {
        background-color: #f2f2f2;
    }
</style>
</html>
