<?php
require_once('database.php');

$format = filter_input(INPUT_GET, 'format');

if (isset($format)) {
    if ($format == 'xml')
        echo header("Content-type: text/xml");
    else if ($format == 'json')
        echo header("Content-type: application/json");
    else
        exit;
} else {
    $format = 'xml';
    echo header("Content-type: text/xml");
}

    // Get all courses
    $query = 'SELECT * FROM sk_courses ORDER BY courseID';
    $statement = $db->prepare($query);
    $statement->execute();
    $courses = $statement->fetchAll(PDO::FETCH_ASSOC);
    $statement->closeCursor();

    $action = filter_input(INPUT_GET, 'action');

if ($action == 'courses') {
    if ($format == 'json') {
        echo json_encode($courses, JSON_PRETTY_PRINT); 
    }
    else {
        $doc = new DOMDocument('1.0', 'utf-8');
        $doc->preserveWhiteSpace = false;
        $doc->formatOutput = true;
        $root = $doc->createElement('courses');
        $root = $doc->appendChild($root);

        foreach ($courses as $course) {
            $courseNode = $doc->createElement('course');
            $courseNode = $root->appendChild($courseNode);
            
            foreach($course as $key => $value) {
                $i = $doc->createElement($key, $value);
                $courseNode->appendChild($i);
            }
        }
        echo $doc->saveXML();
    }
}
else if ($action == 'students') {
    # Fill in the code for this part
    $course_id = filter_input(INPUT_GET, 'course');

     // Get students for selected course
    $queryForStudents = 'SELECT * FROM sk_students WHERE courseID = :course_id
     ORDER BY studentID';
    $statements = $db->prepare($queryForStudents);
    $statements->bindValue(':course_id', $course_id);
    $statements->execute();
    $students = $statements->fetchAll(PDO::FETCH_ASSOC);
    $statements->closeCursor();   

    //  root element
    $xml = new SimpleXMLElement('<students/>');

    // loop through courses and build child XML elements
    for ($i = 0; $i < count($students); ++$i) {                            
        $student = $xml->addChild('student');
        $student->addChild('studentID', $students[$i]['studentID']);
        $student->addChild('courseID', $students[$i]['courseID']);
        $student->addChild('firstName', $students[$i]['firstName']);
        $student->addChild('lastName', $students[$i]['lastName']);
        $student->addChild('email', $students[$i]['email']);
    }   
            
    // render XML
    if ($format == 'xml') {
        echo ($xml->asXML());                                       
    }                
    // render JSON
    else if ($format == 'json') {
        echo json_encode($students, JSON_PRETTY_PRINT);                                 
    } 
    else {
        echo "format type is invalid.";
    }  
}
?>