<?php

class DonationCauseController extends BaseController {   

	public function create() {
		$dc_name = Input::get( 'dc-name' );
        $dc_desc = Input::get( 'dc-desc' );
        $dc_donation_url = Input::get( 'dc-donation-url' );
        $dc_img_url = Input::get( 'dc-img-url' );

        DonationCause::createNewForPoster($dc_name, $dc_desc, $dc_img_url, $dc_donation_url, Auth::user()->id);

        return Redirect::route('donate');
	}

}