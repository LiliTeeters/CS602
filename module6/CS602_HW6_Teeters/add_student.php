<?php
    
    require_once('database.php');

// Get the student form data
$courseID = filter_input(INPUT_POST, 'course_id');
$email = filter_input(INPUT_POST, 'email');
$firstName = filter_input(INPUT_POST, 'firstName');
$lastName = filter_input(INPUT_POST, 'lastName');
$email = filter_input(INPUT_POST, 'email');

// Validate inputs
if ($courseID == null || $courseID == false ||
        $email == null || $firstName == null || 
        $lastName == null || $email == null) {

    $error = "Invalid. Please go back and check all fields";
    include('error.php');
} else {
    require_once('database.php');

// Add the student to the database  
$query = 'INSERT INTO sk_students
(courseID, email, firstName, lastName)
VALUES
(:course_id, :email, :firstName, :lastName)';
$statement = $db->prepare($query);
$statement->bindValue(':course_id', $courseID);
$statement->bindValue(':email', $email);
$statement->bindValue(':firstName', $firstName);
$statement->bindValue(':lastName', $lastName);
$statement->execute();
$statement->closeCursor();




    // Display the Student List page
    include('index.php');
}
?>