<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/5.1.3/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <title>Spotify Data Analytics Dashboard</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="styles.css">
</head>

<body>
    <!-- Header Section (Static) -->
    <div class="header">
        <span>Spotify Data Analytics Dashboard</span>
        <i class="fas fa-sign-out-alt logout-icon" onclick="logout()"></i>
    </div>

    <!-- Filter Section (Scrollable) -->
    <div class="filter-container">
    <div class="filter-form">
        <div class="select-row">
            <div class="form-group">
                <label for="songType" class="form-label">Select Song Type:</label>
                <select id="songType" class="form-select" onchange="updateCharts()">
                    <option value="all">All Songs</option>
                    <!-- Song types will be dynamically added here -->
                </select>
            </div>
            <div class="form-group">
                <label for="artist" class="form-label">Select Artist:</label>
                <select id="artist" class="form-select" onchange="updateCharts()">
                    <option value="all">All Artists</option>
                    <!-- Artists will be dynamically added here -->
                </select>
            </div>
            <div class="form-group">
                <label for="language" class="form-label">Select Language:</label>
                <select id="language" class="form-select" onchange="updateCharts()">
                    <option value="all">All Languages</option>
                    <!-- Languages will be dynamically added here -->
                </select>
            </div>
        </div>

        <div class="row">
            <div class="col-md-3">
                <label for="startDate" class="form-label">Select Start Date:</label>
                <input type="date" id="startDate" class="form-control" onchange="updateCharts()">
            </div>
            <div class="col-md-3">
                <label for="endDate" class="form-label">Select End Date:</label>
                <input type="date" id="endDate" class="form-control" onchange="updateCharts()">
            </div>
        </div>
    </div>
</div>


    <!-- Content Section with Charts -->
    <div class="chart-container">
        <div class="chart" id="pieChartContainer">
            <canvas id="pieChart" width="500" height="400"></canvas>
        </div>
        <div class="chart" id="barChartContainer">
            <canvas id="barChart" width="500" height="400"></canvas>
        </div>
    </div>

    <?php
    include 'db.php'; // Include the database connection

    // Fetch data for the bar chart
    $sql = "SELECT genre, COUNT(*) as count FROM songs GROUP BY genre";
    $result = $conn->query($sql);

    $labels = [];
    $data = [];

    while ($row = $result->fetch_assoc()) {
        $labels[] = $row['genre'];
        $data[] = $row['count'];
    }

    $conn->close();
    ?>

    <script>

document.addEventListener('DOMContentLoaded', function() {
    // Function to update dropdown options dynamically
    function updateDropdowns() {
        fetch('fetch_data.php')
            .then(response => response.json())
            .then(data => {
                // Populate Genre Dropdown
                const genreSelect = document.getElementById('songType');
                data.genres.forEach(genre => {
                    const option = document.createElement('option');
                    option.value = genre;
                    option.textContent = genre.charAt(0).toUpperCase() + genre.slice(1);
                    genreSelect.appendChild(option);
                });

                // Populate Artist Dropdown
                const artistSelect = document.getElementById('artist');
                data.artists.forEach(artist => {
                    const option = document.createElement('option');
                    option.value = artist;
                    option.textContent = artist.charAt(0).toUpperCase() + artist.slice(1);
                    artistSelect.appendChild(option);
                });

                // Populate Language Dropdown
                const languageSelect = document.getElementById('language');
                data.languages.forEach(language => {
                    const option = document.createElement('option');
                    option.value = language;
                    option.textContent = language.charAt(0).toUpperCase() + language.slice(1);
                    languageSelect.appendChild(option);
                });
            })
            .catch(error => {
                console.error('Error fetching data:', error);
            });
    }

    // Call the function to populate dropdowns when the page loads
    updateDropdowns();
});


        const ctxBar = document.getElementById('barChart').getContext('2d');
        const ctxPie = document.getElementById('pieChart').getContext('2d');

        let barChart, pieChart;

        function renderCharts(labels, data) {
            const barColors = ['#FF5733', '#33FF57', '#5733FF', '#FF33A1', '#F5C200', '#33C1FF'];

            if (barChart) {
                barChart.destroy();
            }
            barChart = new Chart(ctxBar, {
                type: 'bar',
                data: {
                    labels: labels,
                    datasets: [{
                        label: 'Number of Songs by Genre',
                        data: data,
                        backgroundColor: barColors.slice(0, data.length),
                        borderColor: barColors.slice(0, data.length).map(color => color.replace('0.6', '1')),
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

            if (pieChart) {
                pieChart.destroy();
            }
            pieChart = new Chart(ctxPie, {
                type: 'pie',
                data: {
                    labels: labels,
                    datasets: [{
                        label: 'Number of Songs by Genre',
                        data: data,
                        backgroundColor: [
                            'rgba(255, 99, 132, 0.8)',
                            'rgba(54, 162, 235, 0.8)',
                            'rgba(255, 206, 86, 0.8)',
                            'rgba(75, 192, 192, 0.8)',
                            'rgba(153, 102, 255, 0.8)',
                            'rgba(255, 159, 64, 0.8)'
                        ],
                        borderColor: [
                            'rgba(255, 99, 132, 1)',
                            'rgba(54, 162, 235, 1)',
                            'rgba(255, 206, 86, 1)',
                            'rgba(75, 192, 192, 1)',
                            'rgba(153, 102, 255, 1)',
                            'rgba(255, 159, 64, 1)'
                        ],
                        borderWidth: 1
                    }]
                }
            });
        }

        function updateCharts() {
            const songType = document.getElementById('songType').value;
            const artist = document.getElementById('artist').value;
            const startDate = document.getElementById('startDate').value;
            const endDate = document.getElementById('endDate').value;
            const language = document.getElementById('language').value;

            fetch(`fetch_data.php?songType=${songType}&artist=${artist}&startDate=${startDate}&endDate=${endDate}&language=${language}`)
                .then(response => response.json())
                .then(data => {
                    const labels = data.labels;
                    const counts = data.counts;
                    renderCharts(labels, counts);
                })
                .catch(error => console.error('Error fetching data:', error));
        }

        // Initial render of charts with all songs
        renderCharts(<?php echo json_encode($labels); ?>, <?php echo json_encode($data); ?>);

        // Logout function
        function logout() {
            alert('Logging out...');
        }
    </script>
</body>

</html>
