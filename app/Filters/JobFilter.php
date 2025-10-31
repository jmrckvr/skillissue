<?php

namespace App\Filters;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class JobFilter
{
    protected $request;
    protected $builder;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function apply(Builder $builder): Builder
    {
        $this->builder = $builder;

        if ($this->request->filled('search')) {
            $this->search();
        }

        if ($this->request->filled('type')) {
            $this->type();
        }

        if ($this->request->filled('salary_min')) {
            $this->salaryMin();
        }

        if ($this->request->filled('salary_max')) {
            $this->salaryMax();
        }

        return $this->builder;
    }

    protected function search(): void
    {
        $search = $this->request->input('search');
        $this->builder->where(function ($query) use ($search) {
            $query->where('title', 'like', "%{$search}%")
                ->orWhere('description', 'like', "%{$search}%")
                ->orWhereHas('company', function ($q) use ($search) {
                    $q->where('name', 'like', "%{$search}%");
                });
        });
    }

    protected function type(): void
    {
        $this->builder->where('type', $this->request->input('type'));
    }

    protected function salaryMin(): void
    {
        $this->builder->where('salary_min', '>=', $this->request->input('salary_min'));
    }

    protected function salaryMax(): void
    {
        $this->builder->where('salary_max', '<=', $this->request->input('salary_max'));
    }
}
