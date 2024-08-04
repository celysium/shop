<?php

namespace App\Modules\Core\Repositories\File;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\File as HttpFile;
use Illuminate\Http\UploadedFile;
use Psr\Http\Message\StreamInterface;

interface FileRepositoryInterface
{
    public static function store(Model $model, StreamInterface|HttpFile|UploadedFile|string $file, string $field = null): ?string;
}
