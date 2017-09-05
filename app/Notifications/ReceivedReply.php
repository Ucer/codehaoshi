<?php

namespace App\Notifications;

use App\Models\Commentdd;
use App\Models\Question;
use App\Models\Reply;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;

class ReceivedReply extends Notification implements ShouldQueue
{
    use Queueable;

    protected $reply;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Reply $reply)
    {
        $this->reply = $reply;
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
        $comment = $this->reply;
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        $comment = $this->reply;
        $question = Question::findOrFail($comment->question_id);
        $user = User::findOrFail($comment->user_id);
        return [
            'user_id' => $comment->user_id,
            'user_name' => $user->user_name,
            'question_id' => $comment->question_id,
            'question_title' => $question->title,
            'question_slug' => $question->slug,
            'comment_content' => $comment->body,
        ];
    }
}
