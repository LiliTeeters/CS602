<?php
    require_once('database.php');

// Get the course form data
$courseName = filter_input(INPUT_POST, 'courseName');
$ID = filter_input(INPUT_POST, 'courseID');

// Validate inputs
if ($courseName == null || $ID == null) {
    $error = "Invalid. Please go back and check all fields.";
    include('error.php');
} else {
    require_once('database.php');
    // Add the course to the database  
    $query = 'INSERT INTO sk_courses
                 (courseID,courseName)
              VALUES
                 (:courseID, :courseName)';
    $statement = $db->prepare($query);
    $statement->bindValue(':courseName', $courseName);
    $statement->bindValue(':courseID', $ID);
    $statement->execute();
    $statement->closeCursor();
   
    // Display the Course List page
    include('course_list.php');
}
?>