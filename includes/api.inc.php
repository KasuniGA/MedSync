<?php
// Check if file(s) were uploaded
if ($_FILES && isset($_FILES['images'])) {
    $uploadedFiles = $_FILES['images'];
    $uniqueFileNames = array();

    // Loop through each uploaded file
    foreach ($uploadedFiles['tmp_name'] as $key => $tmpName) {
        // Generate a unique filename
        $fileName = $uploadedFiles['name'][$key];
        $uniqueFileName = uniqid() . '_' . $fileName;
        
        // Move the file to the desired directory
        $uploadDir = '../img/';
        $destination = $uploadDir . $uniqueFileName;
        move_uploaded_file($tmpName, $destination);

        // Add the unique filename to the list
        $uniqueFileNames[] = $uniqueFileName;
    }

    // Return the list of unique filenames as JSON
    echo json_encode($uniqueFileNames);
} else {
    // No files uploaded
    echo "No files uploaded";
}
?>