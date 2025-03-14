<?php

namespace App\Http\Controllers;

use App\Models\Pokemon;
use Illuminate\Http\Request;
use App\Http\Requests\StorePokemonRequest;


class ApiPokemonController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pokemons = Pokemon::all();
        return response()->json([
            'status' => true,
            'pokemons' => $pokemons
        ]); //
    }
    public function store(StorePokemonRequest $request)
    {
       $pokemon = Pokemon::create($request->all());
   
       return response()->json([
           'status' => true,
           'message' => "Pokemon Created successfully!",
           'pokemon' => $pokemon
       ], 200);
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }


    /**
     * Display the specified resource.
     */
    public function show(Pokemon $pokemon)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Pokemon $pokemon)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Pokemon $pokemon)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy()
    {
        try{
            // 今日の日付を取得（例: 2025-03-12）
            $today = now()->toDateString();
        
            // 今日登録された最新のポケモンデータを取得
            $latestPokemon = Pokemon::whereDate('created_at', $today)
                                    ->latest('created_at')
                                    ->first();
        
            if (!$latestPokemon) {
            \Log::warning('今日登録されたポケモンデータが見つかりませんでした。');
            return false; // 失敗
            }
            // 削除
            $latestPokemon->delete();
        

            \Log::info('最新のポケモンデータを削除しました');
            return true;
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => '予期しないエラーが発生しました。',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
