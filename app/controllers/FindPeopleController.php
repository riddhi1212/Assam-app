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
        Log::info("===========================in FindPeopleController create [start]");
        Log::info($find_name);

        FindPeople::create([
            'name' => $find_name,
            'age' => Input::get('find-age')
        ]);



        Log::info("===========================in FindPeopleController create [end]");
        //$option_value = Input::get( 'option_value' );        
 
        $response = array(
            'status' => 'success',
            'msg' => 'Option created successfully', // figure out how to use this future-TODO
        );
 
        return Response::json( $response );
    }
}