<?php
if (isset($_GET['n'])) {
    $fileName = $_GET['n'];
    $imagePath = "uploads/images/" . $fileName;
    $pdfPath = "uploads/pdfs/" . $fileName;
    $audioPath = "uploads/audios/" . $fileName;

    // Check if the file exists in the image directory
    if (file_exists($imagePath)) {
        // Attempt to delete the image file
        if (unlink($imagePath)) {
            echo "Image file deleted successfully.";
            header("location: pictures.php");
        } else {
            echo "Unable to delete the image file.";
        }
    }
    // Check if the file exists in the PDF directory
    elseif (file_exists($pdfPath)) {
        // Attempt to delete the PDF file
        if (unlink($pdfPath)) {
            echo "PDF file deleted successfully.";
            header("location: documents.php");
        } else {
            echo "Unable to delete the PDF file.";
        }
    } elseif (file_exists($audioPath)) {
        // Attempt to delete the PDF file
        if (unlink($audioPath)) {
            echo "Audio file deleted successfully.";
            header("location: audios.php");
        } else {
            echo "Unable to delete the Audio file.";
        }
    } else {
        echo "File not found.";
    }
} else {
    echo "Invalid request.";
}
?>
