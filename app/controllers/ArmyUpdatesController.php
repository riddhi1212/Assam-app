<?php

class ArmyUpdatesController extends BaseController {   

    // public function add() {
    //     return View::make( 'options/new' );
    // }
    
    public function search() {
        //check if its our form 
        // TODO #7
        // if ( Session::token() !== Input::get( '_token' ) ) {
        //     return Response::json( array(
        //         'msg' => 'Unauthorized attempt to create option'
        //     ) );
        // }
 
        $updates_name = Input::get( 'updates-name' );
        $updates_age = Input::get( 'updates-age' );

        $results = ArmyUpdates::where('first-name', '=', $updates_name)->get();


        Log::info("===>> in search");        
        Log::info($updates_name);
        Log::info(json_encode($results));

        // Log::info("===>> manual search");        
        // $result = ArmyUpdates::find(2);
        // $n = $result->getAttribute('first-name');
        // Log::info($n);
        // $mr = ArmyUpdates::where('first-name', '=', $n)->first();
        // Log::info(json_encode($mr));

        $response = array(
            'status' => 'success',
            'results' => json_encode($results)
        );
 
        return Response::json( $response );
    }
}