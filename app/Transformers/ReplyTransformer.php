<?php

namespace App\Transformers;

use App\Models\Reply;
use League\Fractal\TransformerAbstract;

class ReplyTransformer extends TransformerAbstract
{
    protected $availableIncludes = [ 'user' ];

    public function transform(Reply $reply)
    {

        return [
            'id'            => $reply->id,
            'user_id'       => $reply->user_id,
            'user_name'      => isset($reply->user) ? $reply->user->user_name : 'Null',
            'avatar'        => isset($reply->user) ? $reply->user->avatar : config('codehaoshi.default_avatar'),
            'content_raw'   => $reply->body,
            'created_at'    => $reply->created_at->diffForHumans(),
            'vote_count'    => $reply->vote_count,
        ];
    }

    /**
     * Include User
     *
     * @param Comment $comment
     * @return \League\Fractal\Resource\Collection
     */
    public function includeUser(Reply $reply)
    {
        $user = $reply->user;

        return $this->item($user, new UserTransformer);
    }

}
