<?php
include 'db.php'; // Include the database connection

$sql_genre = "SELECT DISTINCT genre FROM songs";
$result_genre = $conn->query($sql_genre);
$genres = [];

if ($result_genre->num_rows > 0) {
    while ($row = $result_genre->fetch_assoc()) {
        $genres[] = $row['genre'];
    }
}

// Fetch distinct artists (for Artist dropdown)
$sql_artist = "SELECT DISTINCT artist FROM songs";
$result_artist = $conn->query($sql_artist);
$artists = [];

if ($result_artist->num_rows > 0) {
    while ($row = $result_artist->fetch_assoc()) {
        $artists[] = $row['artist'];
    }
}

// Fetch distinct languages (for Language dropdown)
$sql_language = "SELECT DISTINCT language FROM songs";
$result_language = $conn->query($sql_language);
$languages = [];

if ($result_language->num_rows > 0) {
    while ($row = $result_language->fetch_assoc()) {
        $languages[] = $row['language'];
    }
}

$conn->close();

// Return the data as JSON
echo json_encode([
    'genres' => $genres,
    'artists' => $artists,
    'languages' => $languages
]);
?>