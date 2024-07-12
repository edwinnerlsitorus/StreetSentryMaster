<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "street_sentry";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Function to calculate distance between two points using Haversine formula
function haversineGreatCircleDistance($latitudeFrom, $longitudeFrom, $latitudeTo, $longitudeTo, $earthRadius = 6371000) {
    $latFrom = deg2rad($latitudeFrom);
    $lonFrom = deg2rad($longitudeFrom);
    $latTo = deg2rad($latitudeTo);
    $lonTo = deg2rad($longitudeTo);

    $latDelta = $latTo - $latFrom;
    $lonDelta = $lonTo - $lonFrom;

    $angle = 2 * asin(sqrt(pow(sin($latDelta / 2), 2) +
      cos($latFrom) * cos($latTo) * pow(sin($lonDelta / 2), 2)));
    return $angle * $earthRadius;
}

// Fetch data from lokasi_kerusakan table
$sql_kerusakan = "SELECT lat, lng FROM lokasi_kerusakan ORDER BY id";
$result_kerusakan = $conn->query($sql_kerusakan);

$sta_km_values = [];
if ($result_kerusakan->num_rows > 0) {
    $previous_lat = null;
    $previous_lng = null;
    $total_distance = 0;

    while ($row = $result_kerusakan->fetch_assoc()) {
        $current_lat = $row["lat"];
        $current_lng = $row["lng"];

        if ($previous_lat !== null && $previous_lng !== null) {
            $distance = haversineGreatCircleDistance($previous_lat, $previous_lng, $current_lat, $current_lng);
            $total_distance += $distance;
        }

        $previous_lat = $current_lat;
        $previous_lng = $current_lng;

        $km = floor($total_distance / 1000);
        $m = $total_distance % 1000;
        $sta_km = $km . "+" . $m;
        $sta_km_values[] = $sta_km;
    }
}

// Fetch data from information_jalur table
$sql_info = "SELECT id, posisi_kiri, posisi_kanan, kategori_kerusakan, ukuran_p, ukuran_l, ukuran_d, ukuran_a, ukuran_v, ukuran_j, keterangan FROM information_jalur";
$result_info = $conn->query($sql_info);

// Check if query was successful
if (!$result_info) {
    die("Query failed: " . $conn->error);
}

// Format data as HTML table rows
$rows = '';
if ($result_info->num_rows > 0) {
    $i = 0;
    while ($row = $result_info->fetch_assoc()) {
        $sta_km = isset($sta_km_values[$i]) ? $sta_km_values[$i] : 'N/A';
        $rows .= "<tr>
                    <td>" . $row["id"] . "</td>
                    <td>" . $sta_km . "</td>
                    <td>" . $row["posisi_kiri"] . "</td>
                    <td>" . $row["posisi_kanan"] . "</td>
                    <td>" . $row["kategori_kerusakan"] . "</td>
                    <td>" . $row["ukuran_p"] . "</td>
                    <td>" . $row["ukuran_l"] . "</td>
                    <td>" . $row["ukuran_d"] . "</td>
                    <td>" . $row["ukuran_a"] . "</td>
                    <td>" . $row["ukuran_v"] . "</td>
                    <td>" . $row["ukuran_j"] . "</td>
                    <td>" . $row["keterangan"] . "</td>
                  </tr>";
        $i++;
    }
} else {
    $rows = "<tr><td colspan='12'>No data available</td></tr>";
}

// Close connection
$conn->close();

// Output HTML table
echo $rows;