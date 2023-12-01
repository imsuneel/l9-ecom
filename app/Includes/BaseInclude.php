<?php

namespace App\Includes;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;

abstract class BaseInclude
{
    /**
     * Constructor method.
     *
     * @param  Builder  $builder
     * @param  array|null  $attributes
     * @return void
     */
    public function __construct(
        protected Builder $builder,
        protected ?array $attributes
    ) {
    }

    /**
     * Apply the includes.
     *
     * @return Builder
     */
    public function apply(): Builder
    {
        $this->getIncludes()->map(function ($fields, $include) {
            $this->builder = $this->{$this->getIncludeMethodName($include)}($fields);
        });

        return $this->builder;
    }

    /**
     * Prepare relationships & columns mapping collection based on 'include' & 'fields' parameters.
     *
     * @return Collection
     */
    private function getIncludes(): Collection
    {
        $includes = [];

        if (isset($this->attributes['include'])) {
            $relations = Str::snap($this->attributes['include']);

            foreach ($relations as $include) {
                if ($this->hasSuitableIncludeMethod($include)) {
                    if (! isset($includes[$include])) {
                        $includes[$include] = [];
                    }

                    if (isset($this->attributes['fields'][$include])) {
                        $includes[$include] = Str::snap($this->attributes['fields'][$include]);
                    }
                }
            }
        }

        return collect($includes);
    }

    /**
     * Check if the include method exists in the include class.
     *
     * @param  string  $include
     * @return bool
     */
    private function hasSuitableIncludeMethod(string $include): bool
    {
        return method_exists($this, $this->getIncludeMethodName($include));
    }

    /**
     * Get include method name.
     *
     * @param  string  $include
     * @return string
     */
    private function getIncludeMethodName(string $include): string
    {
        return Str::camel($include);
    }
}
