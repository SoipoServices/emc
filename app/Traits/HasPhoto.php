<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

trait HasPhoto
{
    /**
     * Update the user's profile photo.
     *
     * @param UploadedFile $photo
     * @param  string  $storagePath
     * @return void
     */
    public function updateProfilePhoto(UploadedFile $photo, $storagePath = 'profile-photos')
    {
        tap($this->profile_photo_path, function ($previous) use ($photo, $storagePath) {
            $this->forceFill([
                'photo_path' => $photo->storePublicly(
                    $storagePath, ['disk' => $this->photoDisk()]
                ),
            ])->save();

            if ($previous) {
                Storage::disk($this->photoDisk())->delete($previous);
            }
        });
    }

    /**
     * Delete the user's profile photo.
     *
     * @return void
     */
    public function deleteProfilePhoto()
    {

        if (is_null($this->photo_path)) {
            return;
        }

        Storage::disk($this->photoDisk())->delete($this->photo_path);

        $this->forceFill([
            'photo_path' => null,
        ])->save();
    }

    /**
     * Get the URL to the  photo.
     *
     * @return Attribute
     */
    public function photoUrl(): Attribute
    {
        return Attribute::get(function (): string {
            return $this->photo_path
                    ? Storage::disk($this->photoDisk())->url($this->photo_path)
                    : '';
        });
    }

    /**
     * Get the disk that profile photos should be stored on.
     *
     * @return string
     */
    protected function photoDisk()
    {
        return isset($_ENV['VAPOR_ARTIFACT_NAME']) ? 's3' : config('emc.photo_disk', 'public');
    }
}
