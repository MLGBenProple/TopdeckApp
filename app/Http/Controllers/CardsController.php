<?php

namespace App\Http\Controllers;

use Request;
use App\Models\Card;

class CardsController extends Controller
{
    public function index(){
    	 $cards = Card::orderBy('Name')->paginate(10);
        return view('cards.index')->with('cards', $cards);
    }
    public function show($id)
    {
            $card = Card::find($id);
            return view('cards.show')->with('card', $card);
    }

    public function search(Request $request){
    $filter = Request::get ( 'card' );
    $cards = Card::where('Name','LIKE','%'.$filter.'%')->orderBy('Name')->paginate(10);
    $pagination = $cards->appends ( array (
    'card' => Request::get ( 'card' ) 
  ) );
    if(count($cards) > 0){
        return view('cards.index')->with('cards', $cards)->withQuery( $filter );}
        else
        {
       return redirect('/cards')->with('cards', $cards)->with('error', 'No Cards Found');
        }
    }
}
