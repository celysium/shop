<?php

namespace App\Modules\Core\Traits;

use App\Modules\Core\Models\Enumeration;
use Exception;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

/**
 * @property Enumeration $enums
 */
trait HasEnumeration
{
    const ENUM_CASE = 'case';

    const ENUM_CAST = 'cast';


    /**
     * @param string $field
     * @param mixed $case
     * @param mixed|null $cast
     * @return Enumeration
     * @throws Exception
     */
    public static function storeEnum(string $field, mixed $case, mixed $cast = null): Enumeration
    {
        $status = static::checkEnumField($field);
        if ($status == self::ENUM_CASE && $cast !== null) {
            throw new Exception("The '$field' field can't set cast.");
        }
        if ($status === self::ENUM_CAST && $cast === null) {
            throw new Exception("The '$field' field should set cast.");
        }
        /** @var Enumeration $enum */
        $enum = Enumeration::query()->create([
            'model' => static::class,
            'field' => $field,
            'case'  => $case,
            'cast'  => $cast,
        ]);

        return $enum;
    }

    /**
     * @param array $enums
     * @return Collection
     * @throws Exception
     */
    public static function storeEnums(array $enums): Collection
    {
        $enumerations = [];
        DB::beginTransaction();
        foreach ($enums as $enum) {
            if (!isset($enum['field'])) {
                throw new Exception("Field name not defined");
            }
            if (!isset($enum['case'])) {
                throw new Exception("Case field not defined");
            }
            $enumerations[] = static::storeEnum($enum['field'], $enum['case'], $enum['cast'] ?? null);
        }
        DB::commit();
        return collect($enumerations);
    }

    public static function cases(string $field): array
    {
        return Enumeration::query()
            ->where('model', static::class)
            ->where('field', $field)
            ->get(['case'])
            ->pluck('case')
            ->toArray();
    }

    public static function enums(string $field): array
    {
        return Enumeration::query()
            ->where('model', static::class)
            ->where('field', $field)
            ->get(['case', 'cast'])
            ->toArray();
    }

    public static function validationField(string $field, string $value): bool
    {
        $column = static::checkEnumField($field);
        if($column == null) {
            return false;
        }
        return Enumeration::query()
            ->where('model', static::class)
            ->where('field', $field)
            ->where($column, $value)
            ->exists();
    }

    private static function checkEnumField(string $field): ?string
    {
        $enum = Enumeration::query()
            ->where('model', static::class)
            ->where('field', $field)
            ->first();

        return $enum ? ($enum->cast === null ? self::ENUM_CASE : self::ENUM_CAST) : null;
    }
}
