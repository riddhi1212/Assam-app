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
        // TODO: check for duplicates before creating another record
        FindPeople::create([
            'first-name' => $find_name,
            'age' => $find_age, //str (but works)
            'looker-id' => Auth::user()->id //int
        ]);  

        // If we wanted to print the findPeople per user. 
        // $fp = User::find($looker_id)->findPeople()->get();
        // Log::info($fp);
 
        // Now that 'Looker' has created a new 'Fip', we should try to match it against AU and FOP
        // TODO This code might need to move somewhere else 
        // Doing only AU for now. TODO do FOP 
        $search_results = ArmyUpdates::searchWithNameAndAge($find_name, $find_age);
        Log::info($search_results);
        // If the number of search_results > 0, i.e. matches found, Write to Looker's dashboard, and create alert in Nav-bar
        // User->hasMany(Messages)
        Auth::user()->createNewMessage('New match', 'FindPeople', 'ArmyUpdates', $search_results);


        $response = array(
            'status' => 'success',
            'username' => Auth::user()->fname,
            'notificationCount' => 1, // TODO : should this be num matches instead? as there can be multiple matches per notification
            'msg' => 'Person inserted in Find-People Table successfully', // figure out how to use this future-TODO
        );


        return Response::json( $response );
    }
}