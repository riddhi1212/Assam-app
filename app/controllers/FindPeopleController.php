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
        Log::info($find_age); // find_age is str


        if ( Auth::guest() ) {
            /////// Create User of type Looker

            $looker_first_name = Input::get('looker-first-name');
            $looker_last_name = Input::get('looker-last-name');
            $looker_mobile = Input::get('looker-mobile');

            $looker_obj = User::createLookerAndSave($looker_first_name, $looker_last_name, $looker_mobile);
            // Log::info("===back in FindPeopleController =====");
            // $looker_id_str = (string) $looker_id;
            // Log::info("== The id of created looker ==" . $looker_id_str);

            // =====[start]================================================
            // Manually logging in user and 'Remember me' = true. 
            // So no need to use Auth::attempt
            Auth::login($looker_obj, true);
            // =====[end]================================================
        } 
 
        if ( Auth::guest() ) {
            dd('why is there no Authenticated User here');
        }

        if ( !Auth::user()->looker ) {
            Auth::user()->makeLooker();
        }

        // TODO: change to adding to first-name and last-name
        FindPeople::create([
            'first-name' => $find_name,
            'age' => $find_age, //str (but works)
            'looker-id' => Auth::user()->id //int
        ]);  

        // If we wanted to print the findPeople per user. 
        // $fp = User::find($looker_id)->findPeople()->get();
        // Log::info($fp);
 
        $response = array(
            'status' => 'success',
            'username' => Auth::user()->fname,
            'msg' => 'Person inserted in Find-People Table successfully', // figure out how to use this future-TODO
        );


        return Response::json( $response );
    }
}