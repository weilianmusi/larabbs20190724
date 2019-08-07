<?php

namespace App\Jobs;

use App\Models\Topic;
use App\Handlers\SlugTranslateHandler;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class TranslateSlug implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $topic;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Topic $topic)
    {
        // 队列任务接受了 eloquent 模型，将只会序列化模型的 ID
        $this->topic = $topic;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $slug = app(SlugTranslateHandler::class)->translate($this->topic->title);
        if (trim($slug) === 'edit') {
            $slug = 'edit-slug';
        }

        // 为了避免模型监控器死循环调用，我们使用 DB 类直接对数据库操作
        \DB::table('topics')->where('id', $this->topic->id)->update(['slug' => $slug]);
    }
}
