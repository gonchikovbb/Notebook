<?php

namespace App\Services;

use App\Exceptions\SaveNotebookException;
use App\Models\Notebook;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class NotebookService
{
    public function saveNotebook(Notebook $notebook, ?UploadedFile $file): Notebook
    {

        if (is_null($file)) {
            $oldPhotoPath = $notebook->getPhotoPath();
            if(!empty($oldPhotoPath)) {
                Storage::disk('public')->delete($oldPhotoPath);

                $notebook->setPhotoPath(null);
                $notebook->setPhotoName(null);
            }
            $notebook->save();

            return $notebook;
        }

        $photoPath = $file->store('uploads','public');
        if (!$photoPath) {
            throw new SaveNotebookException("Don't save photo to uploads");
        }

        try {
            $photoName = $file->getClientOriginalName();

            $oldPhotoPath = $notebook->getPhotoPath();
            if (!empty($oldPhotoPath)) {
                Storage::disk('public')->delete($oldPhotoPath);
            }

            $notebook->setPhotoPath($photoPath);
            $notebook->setPhotoName($photoName);

            $notebook->save();
        } catch (\Exception $e) {
            Storage::disk('public')->delete($photoPath);
            throw new SaveNotebookException("Don't save notebook with photo",0, $e);
        }
        return $notebook;
    }
}
