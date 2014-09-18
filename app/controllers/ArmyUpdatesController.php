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
 
        $updates_sno = Input::get('updates-sno');
        $updates_name = Input::get( 'updates-name' );
        $updates_age = Input::get( 'updates-age' );

        Log::info("===[AU Search]===");
        Log::info($updates_sno);
        Log::info($updates_name);
        Log::info($updates_age);

        $name = false;
        $age = false;
        $sno = false;
        if ($updates_name) {
            Log::info("ya name");
            $name = true;
        } 
        if ($updates_age) {
            Log::info("ya age");
            $age = true;
        }
        if ($updates_sno) {
            Log::info("ya sno");
            $sno = true;
        }

        $results =  array();
        $explanation = "";
        if ($sno) {
            // This can only return one row (I think . TODO: check assumption)
            $results = ArmyUpdates::where('s-no', '=', $updates_sno)->get();
            $explanation = "Do not search on 'S.no.' and Another field together. 'S.no.' is unique for every update, so it will never match 2 records. This search is returning results for 'S.no.' = ".$updates_sno.".";
        } elseif ($name && !$age) {
            // Only Name Specified
           // $results = ArmyUpdates::where('first-name', '=', $updates_name)->get();
            // search over last name too
            // $results = DB::table('ARMY-Updates')
            //                     ->where('first-name', '=', $updates_name)
            //                     ->orWhere('last-name', '=', $updates_name)
            //                     ->get();

                $results = ArmyUpdates::whereRaw('`first-name` LIKE ? or `last-name` LIKE ?', array(
                                                    '%'.$updates_name.'%', '%'.$updates_name.'%'
                                                ))->get();

                // TODO : separate out exact matches and substr matches and disp them separately


        } elseif ($age && !$name) {
            // Only Age Specified
            $results = ArmyUpdates::where('age', '=', $updates_age)->get();
        } elseif ($name && $age) {
            // Name, Age Specified
            // $results = ArmyUpdates::where('age', '=', $updates_age)
            //                         ->where('first-name', '=', $updates_name)
            //                         ->get();
            //                         //TODO : last name search!


            $results = ArmyUpdates::whereRaw('( `first-name` LIKE ? or `last-name` LIKE ? ) and age = ?', array(
                                        '%'.$updates_name.'%', '%'.$updates_name.'%', $updates_age
                                    ))->get();

                // TODO : separate out exact matches and substr matches and disp them separately
        }



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
            'explanation' => $explanation,
            'results' => json_encode($results)
        );
 
        return Response::json( $response );
    }
}