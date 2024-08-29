<?php

namespace App\Traits;

use Illuminate\Http\UploadedFile;

trait UploadFiles
{
    public function uploadFile(UploadedFile $file, $field = '', $subField = false, $subFieldValue = '')
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

        if ($field && $this->{$field} && ($subField == true && $subFieldValue != '')) {
            $previousThumbnailPath = $subdirectoryPath . '/' .  ($subFieldValue != '' ? $subFieldValue : $this->{$field});
            if (file_exists($previousThumbnailPath)) {
                unlink($previousThumbnailPath);
            }
        }

        $fileExtension = $file->getClientOriginalExtension();
        $fileName = random_int(100, 999) . '_file_' . time() . '.' . $fileExtension;
        $filePath = $file->move($subdirectoryPath, $fileName);

        return $fileName;
    }

    public function getFile($field = '', $subField = false, $subFieldValue = '')
    {
        $value = $this->{$field};
        if ($value != "") {
            $uploadPath = $this->getUploadUrl() . '/' . $this->id;
            if($subField) {
                $uploadPath .= '/' . $field;
            }
            return $uploadPath . '/' . ($subFieldValue != '' ? $subFieldValue : $value);
        } else {
            return asset('images/profile.png');
        }
    }

    public function getFilePath($field = '', $subField = false, $subFieldValue = '')
    {
        $value = $this->{$field};
        if ($value != "") {
            $uploadPath = $this->getUploadPath() . '/' . $this->id;
            if($subField) {
                $uploadPath .= '/' . $field;
            }
            return $uploadPath . '/' . ($subFieldValue != '' ? $subFieldValue : $value);
        } else {
            return public_path('images/profile.png');
        }
    }

    protected function getUploadPath()
    {
        return public_path('uploads/' . strtolower(class_basename($this)));
    }

    protected function getUploadUrl()
    {
        return asset('uploads/' . strtolower(class_basename($this)));
    }
}
