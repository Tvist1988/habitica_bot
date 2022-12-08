<?php
use App\Http\Controllers\BotManController;
use App\TelegramUser;
use Illuminate\Database\Eloquent\ModelNotFoundException;

$botman = resolve('botman');
$botman->group([
    'driver' => [BotMan\Drivers\Telegram\TelegramDriver::class]],
    function ($bot) {

        $bot->hears('/start', function ($bot) {
            $bot->startConversation(new \App\Conversations\Tsks);
        });
            $bot->hears('/help', function ($bot) {
                $bot->reply('Это команда поддержки');

    });
        $bot->fallback(function($bot) {
            $bot->startConversation(new \App\Conversations\Tasks);
        });

        $bot->hears('/stop', function ($bot) {
            try {
                $user = TelegramUser::where(['telegram_id' => $bot->getUser()->getId()])->firstOrFail();
                $user->delete();
                $bot->reply('Данные удалены, бот остановлен');
            } catch (ModelNotFoundException $e) {
                $bot->reply('Данные не найдены.');
            }
        });
});
