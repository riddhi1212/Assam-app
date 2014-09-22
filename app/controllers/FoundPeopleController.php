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

        // If not logged in, it could be New User or Returning User
        if ( Auth::guest() ) {
            $finder_first_name = Input::get('finder-first-name');
            $finder_last_name = Input::get('finder-last-name');
            $finder_mobile = Input::get('finder-mobile');

            $returning_user = User::where('mobile', '=', $finder_mobile)->get()->first();
            if ( $returning_user ) {
                Auth::login($returning_user, true);
            } else {
                // New user
                $finder_obj = User::createFinderAndSave($finder_first_name, $finder_last_name, $finder_mobile);

                // Manually logging in user and 'Remember me' = true. 
                // So no need to use Auth::attempt
                Auth::login($finder_obj, true);
            }
        } 
 
        if ( Auth::guest() ) {
            dd('why is there no Authenticated User here');
        }

        if ( !Auth::user()->finder ) {
            Auth::user()->makeFinder();
        }

        // TODO: check for duplicates before creating another record
        $fop = FoundPeople::createNewForFinder($found_name, $found_age, Auth::user()->id);


        Log::info("========[in FouldPeopleController -> fop is]==========");
        Log::info($fop);

        $fip_search_results = FindPeople::searchWithNameAndAge($found_name, $found_age);
        Log::info("============[got back fip_search_results]==============");
        Log::info($fip_search_results);
        foreach ($fip_search_results as $fip_result) {
            Log::info($fip_result);
            FindPeople::find($fip_result['id'])->createNewMatch(FoundPeople::TABLE_NAME, $fop);
        }
        Log::info("============[created matches]==============");

        // TODO : maybe add AU also

        // TODO : create Message on Auth::user (Finder) saying Thank you for posting Found Record ?
 
        $response = array(
            'status' => 'success',
            'username' => Auth::user()->fname,
            'fname' => Helper::getFirstNameFrom($found_name),
            'lname' => Helper::getLastNameFrom($found_name),
            'age'   => $found_age,
            'msgCount' => Auth::user()->messages()->count(),
            'msg' => 'Person inserted in Found-People Table successfully', // figure out how to use this future-TODO
        );
 
        Log::info("===========================in FoundPeopleController create [end]");
        
        return Response::json( $response );
    }

    // POST to /deletefop
    public function delete() {
        $fop_id = Input::get( 'fop-id' );

        Log::info("===========================in FoundPeopleController delete [fop_id] is =>");
        Log::info($fop_id);

        $fop = FoundPeople::find($fop_id);

        $deleted = false;
        if ( $fop->claimed ) {
            // I will not currently allow the deletion of a claimed FOP
            $deleted = false;
        } else {
            // This FOP is unclaimed
            Log::info($fop->fips() == null); // please print true

            Match::deleteMatchesForFop($fop_id);
            FoundPeople::find($fop_id)->delete();
            $deleted = true;
        }

        $response = array(
            'status' => 'success',
            'deleted' => $deleted
        );

        return Response::json( $response );
    }

}