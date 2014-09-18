<?php

class ArmyUpdatesController extends BaseController {   

    // public function add() {
    //     return View::make( 'options/new' );
    // }
    
    // This is the function a form button will POST to
    public function search() {
        //check if its our form  (prevents cross site injections)
        // TODO #7
        // if ( Session::token() !== Input::get( '_token' ) ) {
        //     return Response::json( array(
        //         'msg' => 'Unauthorized attempt to create option'
        //     ) );
        // }

        $updates_sno = Input::get('updates-sno');
        $updates_name = Input::get( 'updates-name' );
        $updates_age = Input::get( 'updates-age' );

        Log::info("===[AU Search]===");
        Log::info($updates_sno);
        Log::info($updates_name);
        Log::info($updates_age);

        $results = ArmyUpdates::searchWithParam($updates_sno, $updates_name, $updates_age);

        $explanation = "This has to be replaced. TODO TODO . Just checking refactoring for now !!! ";

        Log::info("===[AU Search Results]===");
        Log::info(json_encode($results));

        $response = array(
            'status' => 'success',
            'explanation' => $explanation,
            'results' => json_encode($results)
        );
 
        return Response::json( $response );
    }


}