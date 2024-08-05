<?php

namespace App\Modules\Core\Traits;

use App\Modules\Core\Models\File;
use App\Modules\Core\Repositories\File\FileRepository;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Http\File as HttpFile;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Psr\Http\Message\StreamInterface;

/**
 * @property File $file
 */
trait HasFile
{
    /**
     * Get the post's image.
     */
    public function file(): MorphMany
    {
        return $this->morphMany(File::class, 'model');
    }
    private static function getDirectory(): string
    {
        return now()->format('Y/n/j');
    }

    /**
     * @param StreamInterface|HttpFile|UploadedFile|string $file
     * @param string|null $field
     * @return string|null
     */
    public function fileStore(StreamInterface|HttpFile|UploadedFile|string $file, string $field = null): ?string
    {
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
                'model_type' => get_class($this),
            ]);
            if (!$model) {
                Storage::delete($path);
                return null;
            }
            return $path;
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
}
