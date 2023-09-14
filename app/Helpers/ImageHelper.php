<?php

use Illuminate\Support\Facades\Storage;
use Aws\S3\Exception\S3Exception;
use Illuminate\Support\Facades\Log;

class ImageHelper
{
    public static function uploadFileToS3($file,$path)
    {
        if ($file) {
            
            $extension  = $file->getClientOriginalExtension(); 
            $image_name = time() .  '.' . $extension;
            $urlPath = $path . '/' .$image_name;
            Storage::disk('s3')->putFileAs($path, $file, $image_name);
            return $urlPath;
        }
    }

    public static function getS3FileUrl($path, $defaultImage = null)
    {
        try {
            $disk = Storage::disk('s3');
            if ($disk->exists($path) ) {
                $s3Client = $disk->getDriver()->getAdapter()->getClient();
                $command = $s3Client->getCommand(
                    'GetObject',
                    [
                        'Bucket' => config('filesystems.disks.s3.bucket'),
                        'Key' => $path,
                        'ResponseContentDisposition' => 'attachment;',
                    ]
                );
                $request = $s3Client->createPresignedRequest($command, '+1440 minutes');
                return (string)$request->getUri();
            }
            return $defaultImage;
        } catch (S3Exception $e) {
            Log::error($e->getMessage() . $e->getTraceAsString());
            return $defaultImage;
        }
    }

    public static function deleteFileFromS3($path)
    {
        $disk = Storage::disk('s3');
        if ($disk->exists($path)) {
            Storage::disk('s3')->delete($path);
        }
    }

    public static function updateFileFromS3($file,$pathUpdate,$path)
    {
        if($file)
        {
            $disk = Storage::disk('s3');
            if ($disk->exists($pathUpdate)) {
                if($pathUpdate != "images/avatars/avatar.png")
                {
                    Storage::disk('s3')->delete($pathUpdate);
                }
                
            }

            $extension  = $file->getClientOriginalExtension(); 
            $image_name = time() .  '.' . $extension;
            $urlPath = $path . '/' .$image_name;
            Storage::disk('s3')->putFileAs($path, $file, $image_name);
            return $urlPath;
        }
        
    } 
}

?>