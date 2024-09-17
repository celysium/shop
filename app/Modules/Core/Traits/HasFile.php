<?php

namespace App\Modules\Core\Traits;

use App\Modules\Core\Models\File;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Http\File as HttpFile;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Psr\Http\Message\StreamInterface;

/**
 * @property File $files
 */
trait HasFile
{
    /**
     * Get the post's image.
     */
    public function files(): MorphMany
    {
        return $this->morphMany(File::class, 'model');
    }

    private static function getDirectory(): string
    {
        return now()->format('Y/n/j');
    }

    /**
     * @param StreamInterface|HttpFile|UploadedFile $file
     * @param string|null $field
     * @param bool $replace
     * @return string|null
     */
    public function fileStore(StreamInterface|HttpFile|UploadedFile $file, string $field = null, bool $replace = true): ?string
    {
        if ($replace) {
            $this->fileDelete($this->getOriginal($field));
        }

        $id = Str::uuid();
        $name = sprintf("%s.%s", $id, $file->extension());

        if ($path = Storage::putFileAs(static::getDirectory(), $file, $name)) {
            /** @var File $fileInfo */
            $model = File::query()->create([
                'id'         => $id,
                'field'      => $field,
                'path'       => $path,
                'mime'       => $file->getMimeType(),
                'size'       => $file->getSize(),
                'model_id'   => $this->getKey(),
                'model_type' => static::class,
            ]);
            if ($model) {
                return $path;
            }
            Storage::delete($path);
        }
        return null;
    }

    /**
     * @param string $path
     * @return bool
     */
    public function fileDelete(string $path): bool
    {
        $id = pathinfo($path, PATHINFO_FILENAME);

        return (bool)File::query()
            ->where('id', $id)
            ->delete();
    }

    public function fileUrl(string $value): string
    {
        return Storage::url($value);
    }
}
