<?php

namespace App\Models\Traits;

trait ArticleFilterable
{

    public function getArticlesWithFilter($filter, $limit = 5, $category_id = 0)
    {

        $filter = $this->getArticleFilter($filter);

        return $this->applyFilter($filter, $category_id)
            ->with('user', 'category')
            ->paginate($limit);
    }

    public function getArticlesWithWhoFilter($filter, $limit = 5, $user_id = 0)
    {

        $filter = $this->getArticleFilter($filter);

        return $this->applyFilter($filter,0)
            ->where('user_id', '=', $user_id)
            ->paginate($limit);
    }

    protected function getArticleFilter($request_filter)
    {
        $filters = ['hot', 'recent', 'excellent', 'category'];
        if (in_array($request_filter, $filters)) {
            return $request_filter;
        }
        return 'default';
    }

    public function applyFilter($filter, $category_id)
    {
        $query = $this->withoutDraft()->WithoutPrivate();

        switch ($filter) {
            case 'hot' :
                return $query->weightAsc()->hot();
                break;
            case 'recent':
                return $query->recent()->weightAsc();
                break;
            case 'excellent':
                return $query->excellent()->weightAsc();
                break;
            case 'category':
                return $query->category($category_id)->weightAsc()->recent();
                break;
            case 'default':
                return $query->weightAsc()->recent();
                break;
        }
    }

    public function scopeVote($query, $sort="asc")
    {
        return $query->orderBy('vote_count', $sort);
    }
    public function scopeRecent($query)
    {
        return $query->orderBy('created_at', 'desc');
    }

    public function scopeWeightAsc($query)
    {
        return $query->orderBy('weight', 'asc');
    }

    public function scopeHot($query)
    {
        return $query->where('is_hot', 'yes');
    }

    public function scopeExcellent($query)
    {
        return $query->where('is_excellent', '=', 'yes');
    }

    public function scopeWithoutDraft($query)
    {
        return $query->where('is_draft', '=', 'no');
    }

    public function scopeWithoutPrivate($query)
    {
        return $query->where('only_owner_can_see', '=', 'no');
    }

    public function scopeCategory($query, $category_id)
    {
        return $query->where('category_id', '=', $category_id);
    }
}