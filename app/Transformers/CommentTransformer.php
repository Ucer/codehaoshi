<?php

namespace App\Transformers;

use App\Models\Comment;
use League\Fractal\TransformerAbstract;

class CommentTransformer extends TransformerAbstract
{
    protected $availableIncludes = [ 'user' ];

    public function transform(Comment $comment)
    {

        return [
            'id'            => $comment->id,
            'user_id'       => $comment->user_id,
            'user_name'      => isset($comment->user) ? $comment->user->user_name : 'Null',
            'avatar'        => isset($comment->user) ? $comment->user->avatar : config('codehaoshi.default_avatar'),
            'content_raw'   => $comment->body,
            'created_at'    => $comment->created_at->diffForHumans(),
            'vote_count'    => $comment->vote_count,
        ];
    }

    /**
     * Include User
     *
     * @param Comment $comment
     * @return \League\Fractal\Resource\Collection
     */
    public function includeUser(Comment $comment)
    {
        $user = $comment->user;

        return $this->item($user, new UserTransformer);
    }

}
