<?php

namespace App\Modules\Core\Traits;

use App\Modules\Core\Models\File;
use App\Modules\Core\Repositories\File\FileRepository;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Http\File as HttpFile;
use Illuminate\Http\UploadedFile;
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

    /**
     * @param StreamInterface|HttpFile|UploadedFile|string $file
     * @param string|null $field
     * @return string|null
     */
    public function fileStore(StreamInterface|HttpFile|UploadedFile|string $file, string $field = null): ?string
    {
        return FileRepository::store($this, $file, $field);
    }
}
