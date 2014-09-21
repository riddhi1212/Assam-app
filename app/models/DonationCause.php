<?php


class DonationCause extends Eloquent {

    const TABLE_NAME = 'DonationCauses';

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = DonationCause::TABLE_NAME;

	public function addedByCurrentUser() {
		if ($this->poster_id == Auth::user()->id)
			return true;
		else
			return false;
	}


	// return created $donationcause obj
	public static function createNewForPoster($name, $desc, $img_url, $donation_url, $donation_instructions, $poster_id) {
		$dc = new DonationCause;
		$dc->poster_id = $poster_id;
		$dc->save();

		return DonationCause::updateWithID($dc->id, $name, $desc, $img_url, $donation_url, $donation_instructions);
	}

	public static function updateWithID($id, $name, $desc, $img_url, $donation_url, $instructions) {
		$dc = DonationCause::find($id);
		$dc->name = $name;
		$dc->description = $desc;
		$dc->img_url = $img_url;

		if ($instructions === '') {
			$dc->donation_url = $donation_url;
			$dc->instructions = NULL;
		} else {
			$dc->donation_url = '/donation/show/' . $dc->id;   // Cannot reference id before dc is made
			$dc->instructions = $instructions;
		}

		$dc->save();

		return $dc;
	}


}
