<?php

class DonationCausesTableSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
    public function run()
    {
        DB::table(DonationCause::TABLE_NAME)->delete();

        $dc_adder_user = User::find(1); // finding Riddhi
        $dc_adder_user->makeDonationCauseAdder();
        
        DonationCause::createNewForPoster("HDFC Bank",
                                          "Direct link for Online Donation option to Prime Minister Modi's National Relief Fund.",
                                          "images/hdfcbanklogo.jpg",
                                          "http://www.hdfcbank.com/personal/donate-online/donate-to-charity-inner/1332166924",
                                          $dc_adder_user->id
                                        );
        // http://freshersplane.com/wp-content/uploads/2011/08/HDFC-Bank.jpg


        DonationCause::createNewForPoster("Yes Bank",
                                          "Direct link for Online Donation option to Prime Minister Modi's National Relief Fund.",
                                          "images/yesbanklogo.jpg",
                                          "http://www.yesbank.in/branch-banking/yes-touch/prime-minister-national-relief-fund.html",
                                          $dc_adder_user->id
                                        );

        DonationCause::createNewForPoster("ICICI Bank",
                                          "Direct link for Online Donation option to Prime Minister Modi's National Relief Fund.",
                                          "images/icicibanklogo.jpg",
                                          "https://www.billdesk.com/pgidsk/pgmerc/ICICI_QuickPay/PMNRFICI_quickpay_details.jsp",
                                          $dc_adder_user->id
                                        );

        DonationCause::createNewForPoster("Axis Bank",
                                          "Direct link for Online Donation option to Prime Minister Modi's National Relief Fund.",
                                          "images/axisbanklogo.jpg",
                                          "http://www.axisbank.com/personal/make-donations/online_donations/online.aspx",
                                          $dc_adder_user->id
                                        );
        // https://accountopening.yesbank.in/Images/UploadLogo/OrganisationLogo.jpg
    }   

}
