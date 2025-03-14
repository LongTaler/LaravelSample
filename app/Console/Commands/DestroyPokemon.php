<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Http\Controllers\ApiPokemonController; 
use App\Events\BatchStarted;
use App\Events\BatchFinished;

class DestroyPokemon extends Command
{
    /**
     * The name and signature of the console command.
     * コンソール等での呼び出し方を設定する
     * @var string
     */
    protected $signature = 'app:destroy-pokemon';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        event(new BatchStarted()); // バッチ開始イベントを発火
    
        try {
            // ApiPokemonController のインスタンスを作成
            $pokemonController = app()->make(ApiPokemonController::class);
    
            // destroy() メソッドを呼び出す
            $response = $pokemonController->destroy();
    
            // destroy() が false や null を返した場合は失敗とみなす
            if (!$response) {
                throw new \Exception("Destroy function failed or no today's pokemon data.");
            }
            // 成功時のみ BatchFinished を発火
            event(new BatchFinished());
            return Command::SUCCESS;
        } catch (\Exception $e) {
            // エラーログを記録
            \Log::error("バッチ実行中にエラーが発生: " . $e->getMessage());
    
            // 失敗時は BatchFinished を発火しない
            return Command::FAILURE;
        }
    

    
        return Command::SUCCESS;
    }
}
