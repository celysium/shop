<?php

namespace App\Modules\Core\Repositories\File;

use App\Modules\Core\Models\File;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\File as HttpFile;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Psr\Http\Message\StreamInterface;

class FileRepository implements FileRepositoryInterface
{
    protected static string $entity = File::class;

    private static function getDirectory(): string
    {
        return now()->format('Y/n/j');
    }

    /**
     * @param Model $model
     * @param StreamInterface|HttpFile|UploadedFile|string $file
     * @param string|null $field
     * @return string|null
     */
    public static function store(Model $model, StreamInterface|HttpFile|UploadedFile|string $file, string $field = null): ?string
    {
        $id = Str::uuid();
        $name = sprintf("%s.%s", $id, $file->extension());

        if ($path = Storage::putFileAs(static::getDirectory(), $file, $name)) {
            /** @var File $fileInfo */
            File::query()->create([
                'id'         => $id,
                'field'      => $field,
                'path'       => $path,
                'mime'       => $file->getMimeType(),
                'size'       => $file->getSize(),
                'model_id'   => $model->getKey(),
                'model_type' => get_class($model),
            ]);
            return $path;
        }
        return null;
    }
}
