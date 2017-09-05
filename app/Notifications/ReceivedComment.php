<?php

namespace App\Notifications;

use App\Models\Article;
use App\Models\Comment;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;

class ReceivedComment extends Notification implements ShouldQueue
{
    use Queueable;

    protected $comment;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Comment $comment)
    {
        $this->comment = $comment;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        $comment = $this->comment;
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        $comment = $this->comment;
        $article = Article::findOrFail($comment->article_id);
        $user = User::findOrFail($comment->user_id);
        return [
            'user_id' => $comment->user_id,
            'user_name' => $user->user_name,
            'article_id' => $comment->article_id,
            'article_title' => $article->title,
            'article_slug' => $article->slug,
            'comment_content' => $comment->body,
        ];
    }
}
