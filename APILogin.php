<?php
include("koneksi/koneksi.php");

// Check if the request method is GET
if ($_SERVER["REQUEST_METHOD"] == "GET") {
    
    // Query to select all records from tbl_user
    $query_sql = "SELECT * FROM tbl_user";
    
    // Perform the query
    $result = mysqli_query($conn, $query_sql);

    // Check if any records were found
    if ($result) {
        
        // Fetch all rows as an associative array
        $user_data = mysqli_fetch_all($result, MYSQLI_ASSOC);

        // Return the user data as JSON
        header('Content-Type: application/json');
        echo json_encode($user_data);

        // Free the result set
        mysqli_free_result($result);
    } else {
        // Handle the case where the query fails
        echo json_encode(array('error' => 'Failed to fetch user data'));
    }
    
    // Close the database connection
    mysqli_close($conn);
} else {
    // Handle the case where the request method is not GET
    echo json_encode(array('error' => 'Invalid request method'));
}
?>
