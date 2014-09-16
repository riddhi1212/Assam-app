<?php

class FindPeopleController extends BaseController {   

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
 
        $find_name = Input::get( 'find-name' );
        $find_age = Input::get( 'find-age' );

        Log::info("===========================in FindPeopleController create [start]");
        Log::info($find_name);

        // TODO: change to adding to first-name and last-name

        FindPeople::create([
            'first-name' => $find_name,
            'age' => $find_age
        ]);    
 
        $response = array(
            'status' => 'success',
            'msg' => 'Person inserted in Find-People Table successfully', // figure out how to use this future-TODO
        );
 
        return Response::json( $response );
    }
}