<?php

namespace App\Services\Version_1\Create_Campus;

use Illuminate\Http\Request;
use App\Models\Social;

class Create_Social_Section
{
    public function handle(int $id)
    {
        $social = new Social();
        $social->campusID = $id;
        $social->facebookLink = '<Your Facebook Link>';
        $social->telegramLink = '<Your Telegram Link>';
        $social->instagramLink = '<Your Instagram Link>';
        $social->youtubeLink = '<Your Youtube Link>';
        $social->tiktokLink = '<Your Tiktok Link>';
        $social->save();
    }
}