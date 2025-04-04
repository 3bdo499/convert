<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['file'])) {
    $uploadDir = "uploads/";
    if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0777, true);
    }

    $fileType = pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);

    if (strtolower($fileType) !== "bin") {
        http_response_code(400);
        echo "الملف لازم يكون بصيغة .bin فقط.";
        exit;
    }

    $originalFile = $_FILES['file']['tmp_name'];
    $newFileName = $uploadDir . "rom.bin";

    if (move_uploaded_file($originalFile, $newFileName)) {
        echo "تم التحويل بنجاح!";
    } else {
        http_response_code(500);
        echo "حدث خطأ أثناء رفع الملف.";
    }
}
?>