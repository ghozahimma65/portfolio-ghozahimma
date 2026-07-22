<?php

namespace App\Services;

use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Log;

class CloudinaryService
{
    /**
     * Upload a file or array of files to Cloudinary and return their secure URLs.
     *
     * @param UploadedFile|string $file
     * @param string $folder
     * @return string
     */
    public function upload($file, string $folder = 'portfolio'): string
    {
        $filePath = $file instanceof UploadedFile ? $file->getRealPath() : $file;
        
        // Detect if the file is a PDF to use the correct 'raw' resource type on Cloudinary
        $resourceType = 'auto';
        if ($file instanceof UploadedFile) {
            if ($file->getClientOriginalExtension() === 'pdf' || $file->getMimeType() === 'application/pdf') {
                $resourceType = 'raw';
            }
        } elseif (is_string($file)) {
            if (str_ends_with(strtolower($file), '.pdf')) {
                $resourceType = 'raw';
            }
        }

        $options = [
            'folder' => $folder,
            'resource_type' => $resourceType,
        ];

        $response = Cloudinary::uploadApi()->upload($filePath, $options);
        return $response['secure_url'];
    }

    /**
     * Extract the public ID from a Cloudinary URL.
     *
     * @param string $url
     * @return string|null
     */
    public function getPublicId(string $url): ?string
    {
        $path = parse_url($url, PHP_URL_PATH);
        if (!$path) {
            return null;
        }

        // Example path: /cloud-name/image/upload/v123456789/folder/public_id.jpg
        // or /cloud-name/raw/upload/v123456789/folder/public_id.pdf
        if (preg_match('/\/upload\/(?:v\d+\/)?([^\s?#]+)$/', $path, $matches)) {
            $publicIdWithExt = $matches[1];
            $pathInfo = pathinfo($publicIdWithExt);
            
            // For raw files (like PDFs), Cloudinary requires the extension in the public ID.
            if (str_contains($path, '/raw/')) {
                return $publicIdWithExt;
            }

            return $pathInfo['dirname'] === '.' ? $pathInfo['filename'] : $pathInfo['dirname'] . '/' . $pathInfo['filename'];
        }

        return null;
    }

    /**
     * Delete an asset from Cloudinary by its URL.
     *
     * @param string|null $url
     * @return bool
     */
    public function delete(?string $url): bool
    {
        if (empty($url)) {
            return false;
        }

        // Ignore placeholder/asset urls that do not point to Cloudinary
        if (!str_contains($url, 'cloudinary.com')) {
            return false;
        }

        $publicId = $this->getPublicId($url);
        if (!$publicId) {
            return false;
        }

        try {
            $resourceType = str_contains($url, '/raw/') ? 'raw' : 'image';
            
            Cloudinary::uploadApi()->destroy($publicId, [
                'resource_type' => $resourceType,
                'invalidate' => true
            ]);
            
            return true;
        } catch (\Exception $e) {
            Log::error("Failed to delete Cloudinary asset ({$publicId}): " . $e->getMessage());
            return false;
        }
    }
}
