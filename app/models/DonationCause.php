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

	// Called from DC Seeder
	// To be used when the img URL file is already uploaded 
	// Uploaded Image URL does not begin with /.  just images/whatsapp.jpg
	// DC->img_url does begin with /. So the img can be viewed.
	// return created $donationcause obj
	public static function createNewForPosterFromUploadedImgURL($name, $desc, $img_uploaded_url, $donation_url, $donation_instructions, $poster_id) {
		$dc = new DonationCause;
		$dc->poster_id = $poster_id;
		$dc->save();

		$public = app_path().'/../public';
		$extn = explode('.', $img_uploaded_url)[1];
		$image_file_name = 'DC_id_' . $dc->id . '.' . $extn;
        $dc_images_file_location = 'images/DC_photos/';
		$img_url = '/' . $dc_images_file_location . $image_file_name;

		copy($public . '/' . $img_uploaded_url, $public . $img_url);


		return DonationCause::updateWithID($dc->id, $name, $desc, $img_url, $donation_url, $donation_instructions);
	}

	// return created $donationcause obj
	public static function createNewForPosterFromImgFile($name, $desc, $img_file, $donation_url, $donation_instructions, $poster_id) {
		$dc = new DonationCause;
		$dc->poster_id = $poster_id;
		$dc->save();

		$img_url = Helper::moveImgFileAndGetURL($img_file, $dc->id);

		return DonationCause::updateWithID($dc->id, $name, $desc, $img_url, $donation_url, $donation_instructions);
	}

	// return created $donationcause obj
	public static function createNewForPosterWithImgURL($name, $desc, $img_url, $donation_url, $donation_instructions, $poster_id) {
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
