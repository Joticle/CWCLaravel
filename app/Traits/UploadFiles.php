<?php

namespace App\Traits;

use Illuminate\Http\UploadedFile;

trait UploadsFiles
{
    public function uploadFile(UploadedFile $file, $field = '', $subField = false)
    {
        if (!$this->exists) {
            $this->save();
        }

        $uploadingPath = $this->getUploadPath();

        $subdirectoryPath = $uploadingPath . '/' . $this->id . '/';

        if ($subField) {
            $subdirectoryPath .= '/' . $field;
        }

        if (!is_dir($subdirectoryPath)) {
            mkdir($subdirectoryPath, 0777, true);
        }

        if ($field && $this->{$field}) {
            $previousThumbnailPath = $subdirectoryPath . '/' .  $this->{$field};
            if (file_exists($previousThumbnailPath)) {
                unlink($previousThumbnailPath);
            }
        }

        $fileExtension = $file->getClientOriginalExtension();
        $fileName = random_int(100, 999) . '_file_' . time() . '.' . $fileExtension;
        $filePath = $file->move($subdirectoryPath, $fileName);

        return $fileName;
    }

    protected function getUploadPath()
    {
        return public_path('uploads/' . strtolower(class_basename($this)));
    }
}
