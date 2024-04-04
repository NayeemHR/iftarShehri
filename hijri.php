<?php

// File path to the CSV file
$csvFilePath = 'iftar_and_sheri_times.csv';

$selectedDate ='2024-04-01';

// Check if the file exists
if (file_exists($csvFilePath)) {
    // Open the file
    $csvFile = fopen($csvFilePath, 'r');

    // Initialize an empty array to store the data
    $data = [];

    // Read each line of the CSV file
    while (($line = fgetcsv($csvFile)) !== false) {
        // Check if the date matches the selected date
        if ($line[0] == $selectedDate) {
            // Add the line as an array to the data array
            $data[] = $line;
        }
    }
    // Close the file
    fclose($csvFile);

    // Display the data
    echo '<table border="1">';
    echo '<tr><th>Date</th><th>Iftar Time</th><th>Sheri Time</th></tr>';
    foreach ($data as $row) {
        echo '<tr>';
        foreach ($row as $value) {
            echo '<td>' . $value . '</td>';
        }
        echo '</tr>';
    }
    echo '</table>';
} else {
    // File doesn't exist
    echo 'The CSV file does not exist.';
}

?>