<?php

declare(strict_types=1);

namespace App\Services;

use Framework\Database;
use Framework\Exceptions\ValidationException;
use App\config\Paths;

class ReceiptService
{
    public function __construct(private Database $db)
    {
    }

    public function validateFile(?array $file)
    {

        if (!$file || $file['error'] !== UPLOAD_ERR_OK) {
            throw new ValidationException(['receipt' => ['Failed to upload file']]);
        }

        $maxFileSize = 3 * 1024 * 1024;

        if ($file['size'] > $maxFileSize) {
            throw new ValidationException(['receipt' => ['File size exceeds limit']]);
        }

        $originalFileName = $file['name'];

        if(!preg_match('/^[A-za-z0-9\s._-]+$/', $originalFileName)) {
            throw new ValidationException(['receipt' => ['File name contains invalid characters']]);
        }

        $clientMimeType = $file['type'];
        $allowedMimeType = ['image/jpeg', 'image/png', 'application/pdf'];

        if (!in_array($clientMimeType, $allowedMimeType)) {
            throw new ValidationException(['receipt' => ['File type not allowed']]);
        }

    }

    public function upload(array $file) {
        $fileExtention = pathInfo($file['name'], PATHINFO_EXTENSION);
        $newFileName = bin2hex(random_bytes(16)) . '.' . $fileExtention;

        $uploadPath = Paths::UPLOADS . '/' . $newFileName;

        if(!move_uploaded_file($file['tmp_name'], $uploadPath)){
            throw new ValidationException(['receipt' => ['Failed to upload file']]);
        }
    }
}
