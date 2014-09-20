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
	public static function createNewForPoster($name, $desc, $img_url, $donation_url, $poster_id) {
		$dc = new DonationCause;
		$dc->name = $name;
		$dc->description = $desc;
		$dc->img_url = $img_url;
		$dc->donation_url = $donation_url;
		$dc->poster_id = $poster_id;
		$dc->save();
		return $dc;
	}




}
