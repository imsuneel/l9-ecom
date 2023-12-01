<?php

namespace App\Filters;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;

abstract class BaseFilter
{
    /**
     * Constructor method.
     *
     * @param  Builder  $builder
     * @param  array|null  $filters
     * @return void
     */
    public function __construct(
        protected Builder $builder,
        protected ?array $filters
    ) {
    }

    /**
     * Apply the filters.
     *
     * @return Builder
     */
    public function apply(): Builder
    {
        $this->getFilters()->map(function ($value, $filter) {
            $this->builder = $this->{$this->getFilterMethodName($filter)}($value);
        });

        return $this->builder;
    }

    /**
     * Create list of all valid filters.
     *
     * @return Collection
     */
    private function getFilters(): Collection
    {
        return collect($this->filters)->filter(function ($value, $filter) {
            return ! is_array($filter) && $this->isFilterNotEmpty($value) && $this->hasSuitableFilterMethod($filter);
        });
    }

    /**
     * Check if the filter value is not empty.
     *
     * @param  mixed  $value
     * @return bool
     */
    private function isFilterNotEmpty(mixed $value): bool
    {
        return ! empty($value) || $value == '0';
    }

    /**
     * Check if the filter method exists in the filter class.
     *
     * @param  string  $filter
     * @return bool
     */
    private function hasSuitableFilterMethod(string $filter): bool
    {
        return method_exists($this, $this->getFilterMethodName($filter));
    }

    /**
     * Get filter method name.
     *
     * @param  string  $filter
     * @return string
     */
    private function getFilterMethodName(string $filter): string
    {
        return Str::camel($filter);
    }
}
