<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Http\Controllers\ApiPokemonController;  // ← これがあるか確認！

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
       // ApiPokemonController のインスタンスを作成
       $pokemonController = app()->make(ApiPokemonController::class);

       // destroy() メソッドを呼び出す
       $response = $pokemonController->destroy();
   
       // 成功時のレスポンスを表示
       $this->info("Destroy function executed.");
   
       return Command::SUCCESS;
    }
}
