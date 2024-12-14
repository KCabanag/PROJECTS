<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dynamic Dropdowns</title>
    <!-- Add your CSS links here -->
</head>
<body>

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

    <script>
        // Wait for the DOM content to be fully loaded
        document.addEventListener('DOMContentLoaded', function() {
            // Fetch the data from fetch_data.php
            fetch('fetch_data.php')
                .then(response => response.json())
                .then(data => {
                    // Populate the Song Type dropdown (Genre)
                    const genreSelect = document.getElementById('songType');
                    data.genres.forEach(genre => {
                        const option = document.createElement('option');
                        option.value = genre;
                        option.textContent = genre.charAt(0).toUpperCase() + genre.slice(1);
                        genreSelect.appendChild(option);
                    });

                    // Populate the Artist dropdown
                    const artistSelect = document.getElementById('artist');
                    data.artists.forEach(artist => {
                        const option = document.createElement('option');
                        option.value = artist;
                        option.textContent = artist.charAt(0).toUpperCase() + artist.slice(1);
                        artistSelect.appendChild(option);
                    });

                    // Populate the Language dropdown
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
        });

        function updateCharts() {
            // Function to handle the update of charts when dropdowns are changed
            console.log('Updating charts...');
            // Implement your chart update logic here
        }
    </script>

</body>
</html>


