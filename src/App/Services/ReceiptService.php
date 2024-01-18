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

        if (!preg_match('/^[A-za-z0-9\s._-]+$/', $originalFileName)) {
            throw new ValidationException(['receipt' => ['File name contains invalid characters']]);
        }

        $clientMimeType = $file['type'];
        $allowedMimeType = ['image/jpeg', 'image/png', 'application/pdf'];

        if (!in_array($clientMimeType, $allowedMimeType)) {
            throw new ValidationException(['receipt' => ['File type not allowed']]);
        }
    }

    public function upload(array $file, int $transaction)
    {
        $fileExtention = pathInfo($file['name'], PATHINFO_EXTENSION);
        $newFileName = bin2hex(random_bytes(16)) . '.' . $fileExtention;

        $uploadPath = Paths::UPLOADS . '/' . $newFileName;

        if (!move_uploaded_file($file['tmp_name'], $uploadPath)) {
            throw new ValidationException(['receipt' => ['Failed to upload file']]);
        }

        $this->db->query(
            "INSERT INTO receipts (transaction_id, original_filename, storage_filename, media_type) VALUES (:transaction_id, :original_filename, :storage_filename, :media_type)",
            [
                'transaction_id' => $transaction,
                'original_filename' => $file['name'],
                'storage_filename' => $newFileName,
                'media_type' => $file['type'],

            ]
        );
    }

    public function getReceipt(string $id)
    {
        return $this->db->query("SELECT * FROM receipts WHERE id = :id", [
            'id' => $id
        ])->fetch();
    }
    public function read(array $receipt)
    {
        $filePath = Paths::UPLOADS . '/' . $receipt['storage_filename'];

        if (!file_exists($filePath)) {
            redirectTo('/');
        }

        header("Content-Type: {$receipt['media_type']}");
        header("Content-Disposition: inline; filename={$receipt['original_filename']}");

        readfile($filePath);
    }

    public function delete(array $receipt)
    {
        $filePath = Paths::UPLOADS . '/' . $receipt['storage_filename'];

        unlink($filePath);

        $this->db->query("DELETE FROM receipts WHERE id = :id", [
            'id' => $receipt['id']
        ]);
    }
}
