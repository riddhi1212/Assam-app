<?php


class DonationCause extends Eloquent {

    const TABLE_NAME = 'DonationCauses';

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = DonationCause::TABLE_NAME;


	// return created $donationcause obj
	public static function createNewForPoster($name, $desc, $img_url, $donation_url, $donation_instructions, $poster_id) {
		$dc = new DonationCause;
		$dc->name = $name;
		$dc->description = $desc;
		$dc->img_url = $img_url;
		$dc->poster_id = $poster_id;
		$dc->save();

		if ($donation_instructions === '') {
			$dc->donation_url = $donation_url;
			$dc->instructions = NULL;
		} else {
			$dc->donation_url = '/DonationCause/' . $dc->id;   // Cannot reference id before dc is made
			Log::info("*************Making Donate URL => ");
			Log::info($dc->donation_url);
			$dc->instructions = $donation_instructions;
		}

		$dc->save();


		
		return $dc;
	}




}
