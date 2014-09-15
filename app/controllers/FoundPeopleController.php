<?php

class FoundPeopleController extends BaseController {   

    // public function add() {
    //     return View::make( 'options/new' );
    // }
    
    public function create() {
        //check if its our form 
        // TODO #7
        // if ( Session::token() !== Input::get( '_token' ) ) {
        //     return Response::json( array(
        //         'msg' => 'Unauthorized attempt to create option'
        //     ) );
        // }
 
        $found_name = Input::get( 'found-name' );
        $found_age = Input::get( 'found-age' );

        Log::info("===========================in FoundPeopleController create [start]");
        Log::info($found_name);

        FoundPeople::create([
            'name' => $found_name,
            'age' => $found_age
        ]);
 
        $response = array(
            'status' => 'success',
            'msg' => 'Person inserted in Found-People Table successfully', // figure out how to use this future-TODO
        );
 
        return Response::json( $response );
    }
}