<?php

namespace App\Domain;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;

trait SortableTrait
{
    /**
     * Sort model results.
     *
     * @param  Builder    $query
     * @param  Collection $sort  collection of $request->all()
     * @return Bulder
     */
    public function scopeSort(Builder $query, Collection $sort)
    {
        if ($sort->has('sort')) {
            if ($sort->get('sort') == 'price_desc' && $this->isSortable('price')) {
                return $query->orderBy('price', 'desc');
            }

            if ($sort->get('sort') == 'price_asc' && $this->isSortable('price')) {
                return $query->orderBy('price', 'asc');
            }

            if ($sort->get('sort') == 'newest' && $this->isSortable('created_at')) {
                return $query->orderBy('created_at', 'desc');
            }
            if ($sort->get('sort') == 'oldest' && $this->isSortable('created_at')) {
                return $query->orderBy('created_at', 'asc');
            }
        }

        return $query;
    }

    /**
     * Check if given attribute can be sorted.
     *
     * @param  [type]  $key [description]
     * @return boolean      [description]
     */
    private function isSortable($key)
    {
        return (bool) in_array($key, $this->getSortable());
    }

    /**
     * Get sortabke attributes for the model.
     *
     * @return array
     */
    private function getSortable()
    {
        return property_exists($this, 'sortable') ? $this->sortable : array();
    }
}
