<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Reply;

class ReplyPolicy extends Policy
{
    public function destroy(User $user, Reply $reply)
    {
        // 允许回帖人和发帖人删除回复
         return $user->isAuthorOf($reply) || $user->isAuthorOf($reply->topic);
    }
}
