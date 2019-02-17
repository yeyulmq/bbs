<?php

namespace App\Observers;

use App\Models\Topic;
use App\Handlers\SlugTranslateHandler;

// creating, created, updating, updated, saving,
// saved,  deleting, deleted, restoring, restored

class TopicObserver
{
    public function saving(Topic $topic)
        {
            // XSS 过滤
            $topic->body = clean($topic->body, 'user_topic_body');

            // 生成话题摘要
            $topic->excerpt = make_excerpt($topic->body);

            // slug字段翻译
            if(!$topic->slug) {
                 $topic->slug = app(SlugTranslateHandler::class)->translate($topic->title);
            }
        }
}
