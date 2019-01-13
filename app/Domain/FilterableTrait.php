<?php

namespace App\Domain;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;

trait FilterableTrait
{
    /**
     * Apply filters to products index.
     *
     * @param  Builder    $query
     * @param  Collection $filters collection of $request->all()
     * @return Builder
     */
    public function scopeFilter(Builder $query, Collection $filters)
    {
        if ($filters->has('type') && $filters->get('type') !== null && $this->isFilterable('type')) {
            $query->where('type', '=', $filters->get('type'));
        }

        if ($filters->has('status') && $filters->get('status') !== null && $this->isFilterable('status')) {
            $query->where('status', '=', $filters->get('status'));
        }

        if ($filters->has('pricemin') && $filters->get('pricemin') !== null && $this->isFilterable('price')) {
            $query->where('price', '>=', $filters->get('pricemin'));
        }

        if ($filters->has('pricemax') && $filters->get('pricemax') !== null && $this->isFilterable('price')) {
            $query->where('price', '<=', $filters->get('pricemax'));
        }

        if ($filters->has('areamin') && $filters->get('areamin') !== null && $this->isFilterable('area')) {
            $query->where('area', '>=', $filters->get('areamin'));
        }

        if ($filters->has('areamax') && $filters->get('areamax') !== null && $this->isFilterable('area')) {
            $query->where('area', '<=', $filters->get('areamax'));
        }

        if ($filters->has('address') && $filters->get('address') !== null && $this->isFilterable('address')) {
            $query->where('address', 'like', '%' . $filters->get('address') . '%');
        }

        return $query;
    }

    /**
     * Check If the given attribute can be filtered.
     *
     * @param  [type]  $key [description]
     * @return boolean
     */
    private function isFilterable($key)
    {
        return (bool) in_array($key, $this->getFilterable());
    }

    /**
     * Get the filterable attributes for the model.
     *
     * @return array
     */
    private function getFilterable()
    {
        return property_exists($this, 'filterable') ? $this->filterable : [];
    }
}
