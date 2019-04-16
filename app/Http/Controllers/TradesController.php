<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Card;
use App\User;
use App\Models\Card_User;
use App\Models\Wishlist;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
class TradesController extends Controller
{
/**
* Display a listing of the resource.
*
* @return \Illuminate\Http\Response
*/
    public function index()
    {
        //current user
        $user_id = auth()->user()->id;

        //get the card_id of every card in the current users inventory
        $users_cards = DB::table("card_user")->where('user_id', "$user_id")->get();

        //get the card_id of every card in the current users wishlist
        $users_wants = DB::table("wishlists")->where('user_id', "$user_id")->get();

        $matches = array();

        if (count($users_wants) > 0){

            //foreach card in the current users wishlist
            foreach ($users_wants as $user_want) {

                //find any other users that have that card in their inventory
                $potential_trade_users = DB::table("card_user")->where('user_id', '!=', "$user_id")->where('card_id', "$user_want->card_id")->get();


                    //foreach of those users
                foreach ($potential_trade_users as $potential_trade_user) {

                    // get the card_id of every card in their wishlist
                    $potential_trade_users_cards  = DB::table('wishlists')->where('user_id', "$potential_trade_user->user_id")->get();

                     //foreach of those cards
                    foreach ($potential_trade_users_cards as $potential_trade_users_card) {

                        //check if the current user has any of those cards in his inventory
                        $matches[] = DB::table('card_user')->where('user_id', "$user_id")->where('card_id', "$potential_trade_users_card->card_id")->get();


                    } 

                    if (count($matches) > 0) {

                    echo "Match Found! User: $potential_trade_user->user_id card: $potential_trade_users_card->card_id <br />";
                }  
                else {
                    echo "no matches found";
                }

                }
                
            } 
        }

        else {
            return "no cards";
        }

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
//
}
/**
* Display the specified resource.
*
* @param  int  $id
* @return \Illuminate\Http\Response
*/
public function show($id)
{
//
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
//
}
/**
* Remove the specified resource from storage.
*
* @param  int  $id
* @return \Illuminate\Http\Response
*/
public function destroy($id)
{
//
}
}