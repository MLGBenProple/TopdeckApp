<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Card_User;
use App\Models\Card;
use App\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;


class InventoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user_id = auth()->user()->id;
        $user = User::find($user_id);
        return view('inventories.index')->with('inventorys', $user->inventorys);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $inventory = new Card_User;
        $inventory->card_id = $request->input('CardID');
        $inventory->quantity = $request->input('quantity');
        $inventory->user_id = auth()->user()->id;
        if($inventory->quantity > 0){
            if (DB::table('card_user')->where('card_id', $inventory->card_id)->where('user_id', Auth::id())->exists()) {
                return redirect('/cards')->with('error', 'This Card is Already in Your Inventory!');
            }
            else {
              $inventory->save();
              return redirect('/cards')->with('success', 'Added to Inventory');  
            }
        }
        else{
            return redirect('/cards')->with('error', 'Quantity must be greater than 0');
        }
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $card = Card::find($id);
        $card_user = DB::table('card_user')->where('card_id', $id)->where('user_id', Auth::id())->first();
        $data = [
            'card' => $card,
            'card_user' => $card_user
        ];
        return view('inventories.show')->with($data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $card_user = Card_User::find($id);
        $card_user->quantity = $request->input('quantity');
         if($card_user->quantity > 0){
            $card_user->save();
        return redirect('/inventories')->with('success', 'Quantity Updated');
        }
        else{
            return redirect('/inventories')->with('error', 'Quantity must be greater than 0');
        }
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // public function destroy($id)
    // {
    //      $card_user = Card_User::find($id);
    //      if(auth()->user()->id !== $card_user->user_id){
    //         return redirect('/inventory')->with('error', 'Unauthorized page');
    //     }

    //      $card_user->delete();
    //      return redirect('/inventory')->with('success', 'Card Removed');
    // }

      public function destroy($card_id)
    {
        $card = DB::table('card_user')->where('card_id', $card_id)->where('user_id', Auth::id());
        $card->delete();
         return redirect('/inventories')->with('success', 'Card Removed');
        

    }


}
