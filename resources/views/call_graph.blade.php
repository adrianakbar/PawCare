<!-- resources/views/call_graph.blade.php -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Call Graph</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/schedule.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
    <link rel="icon" href="images/websiteicon.png">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>

<body>
    <nav id="sidebar">
        <ul>
            <li>
                <span class="logo"><img src="images/applicationlogo.png" alt="" width="80%"></span>
                <button onclick=toggleSidebar() id="toggle-btn">
                    <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px"
                        fill="#e8eaed">
                        <path
                            d="m313-480 155 156q11 11 11.5 27.5T468-268q-11 11-28 11t-28-11L228-452q-6-6-8.5-13t-2.5-15q0-8 2.5-15t8.5-13l184-184q11-11 27.5-11.5T468-692q11 11 11 28t-11 28L313-480Zm264 0 155 156q11 11 11.5 27.5T732-268q-11 11-28 11t-28-11L492-452q-6-6-8.5-13t-2.5-15q0-8 2.5-15t8.5-13l184-184q11-11 27.5-11.5T732-692q11 11 11 28t-11 28L577-480Z" />
                    </svg>
                </button>
            </li>
            <li class="">
                <a href="/animal">
                    <i class="fa-solid fa-paw"></i>
                    <span>&nbsp;Animal</span>
                </a>
            </li>
            <li>
                <a href="/doctor">
                    <i class="fa-solid fa-user-doctor"></i>
                    <span>&nbsp;Doctor</span>
                </a>
            </li>
            <li>
                <a href="/schedule">
                    <i class="fa-solid fa-calendar-days"></i>
                    <span>&nbsp;Schedule</span>
                </a>
            </li>
            <li>
                <a href="/diagnosis">
                    <i class="fa-solid fa-stethoscope"></i>
                    <span>Diagnosis</span>
                </a>
            </li>
            <li class="active">
                <a href="/graph">
                    <i class="fa-solid fa-chart-column"></i>
                    <span>&nbsp;Graph</span>
                </a>
            </li>
            <li>
                <a href="/logout">
                    <i class="fa-solid fa-right-from-bracket"></i>
                    <span>&nbsp;Logout</span>
                </a>
            </li>
        </ul>
    </nav>

    <div class="container-fluid">
        <div class="mt-4">
            <div class="">
                <div class="card p-3">
                    <div class="d-flex align-items-center">
                        <h6 class="card-title mb-0">Method Performance Analysis</h6>
                    </div>
                    <div class="table-responsive mt-3">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Controller</th>
                                    <th>Method</th>
                                    <th>Performance Score</th>
                                    <th>Total Calls</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($criticalMethods as $method)
                                    <tr>
                                        <td>{{ $method['controller'] }}</td>
                                        <td>{{ $method['method'] }}</td>
                                        <td>{{ number_format($method['performance_score'], 2) }}</td>
                                        <td>{{ $method['total_calls'] }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="card p-3 mt-5">
            <div class="d-flex align-items-center">
                <h6 class="card-title mb-0">Performance Visualization</h6>
            </div>
            <div class="mt-3">
                <canvas id="performanceChart"></canvas>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var ctx = document.getElementById('performanceChart').getContext('2d');

            var chartData = {
                labels: [
                    @foreach ($criticalMethods as $method)
                        "{{ $method['controller'] }}.{{ $method['method'] }}",
                    @endforeach
                ],
                datasets: [{
                        label: 'Performance Score',
                        data: [
                            @foreach ($criticalMethods as $method)
                                {{ number_format($method['performance_score'], 2) }},
                            @endforeach
                        ],
                        backgroundColor: 'rgba(75, 192, 192, 0.6)',
                        borderColor: 'rgba(75, 192, 192, 1)',
                        borderWidth: 1
                    },
                    {
                        label: 'Total Calls',
                        data: [
                            @foreach ($criticalMethods as $method)
                                {{ $method['total_calls'] }},
                            @endforeach
                        ],
                        backgroundColor: 'rgba(255, 99, 132, 0.6)',
                        borderColor: 'rgba(255, 99, 132, 1)',
                        borderWidth: 1
                    }
                ]
            };

            new Chart(ctx, {
                type: 'bar',
                data: chartData,
                options: {
                    responsive: true,
                    plugins: {
                        title: {
                            display: true,
                            text: 'Method Performance Analysis'
                        },
                    },
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        });
    </script>
    <script src="js/main.js"></script>
</body>

</html>
