<?php
namespace App\Repositories\Posts;

use App\Repositories\EloquentRepository;
use App\Interfaces\Post\PostRepositoryInterface;
use Illuminate\Support\Carbon;

class PostRepository extends EloquentRepository implements PostRepositoryInterface
{
    /**
     * get model
     * @return string
     */
    public function getModel()
    {
        return \App\Models\Post::class;
    }

    /**
     * Get 5 posts hot in a month the last
     * @return mixed
     */
    public function getPostHost()
    {
        return $this->_model::where('created_at', '>=', Carbon::now()->subMonth())->orderBy('id', 'desc')->take(5)->get();
    }
    
}
