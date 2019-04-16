<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Card;
use App\User;
use App\Models\Wishlist;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class WishlistsController extends Controller
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
        return view('wishlists.index')->with('cards', $user->cards)->with('wishlists', $user->wishlists);
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
        $wishlist = new Wishlist;
        $wishlist->card_id = $request->input('CardID');
        $wishlist->quantity = $request->input('quantity');
        $wishlist->user_id = auth()->user()->id;
        if($wishlist->quantity > 0){
            if (DB::table('wishlists')->where('card_id', $wishlist->card_id)->where('user_id', Auth::id())->exists()) {
                return redirect('/cards')->with('error', 'This Card is Already on your wishlist!');
            }
            else {
              $wishlist->save();
              return redirect('/cards')->with('success', 'Added to your wishlist');  
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
        $wishlist = DB::table('wishlists')->where('card_id', $id)->where('user_id', Auth::id())->first();
        $data = [
            'card' => $card,
            'wishlist' => $wishlist
        ];
        return view('wishlists.show')->with($data);
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
        $wishlist = Wishlist::find($id);
        $wishlist->quantity = $request->input('quantity');
         if($wishlist->quantity > 0){
            $wishlist->save();
        return redirect('/wishlists')->with('success', 'Quantity Updated');
        }
        else{
            return redirect('/wishlists')->with('error', 'Quantity must be greater than 0');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($card_id)
    {
        $card = DB::table('wishlists')->where('card_id', $card_id)->where('user_id', Auth::id());
        $card->delete();
         return redirect('/wishlists')->with('success', 'Card Removed');
    }
}
