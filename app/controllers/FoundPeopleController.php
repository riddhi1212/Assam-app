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

        if ( Auth::guest() ) {
            /////// Create User of type Looker

            $finder_first_name = Input::get('finder-first-name');
            $finder_last_name = Input::get('finder-last-name');
            $finder_mobile = Input::get('finder-mobile');

            $finder_obj = User::createFinderAndSave($finder_first_name, $finder_last_name, $finder_mobile);

            // =====[start]================================================
            // Manually logging in user and 'Remember me' = true. 
            // So no need to use Auth::attempt
            Auth::login($finder_obj, true);
            // =====[end]================================================
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
}