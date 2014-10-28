<?php

class DonationCausesTableSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
    public function run()
    {
        // Calling appropriate migration directly
        $dc_mig_1 = new CreateDonationCausesTable;
        $dc_mig_1->down(); // ONLY call down() for the first migration which Creates the table.
        $dc_mig_1->up();
        $dc_mig_2 = new AddDonationInstructionsTextToDcTable;
        $dc_mig_2->up();

        $dc_adder_user = User::find(1); // finding Riddhi
        $dc_adder_user->makeDonationCauseAdder();
        
        DonationCause::createNewForPosterFromUploadedImgURL("HDFC Bank",
                                          "Direct link for Online Donation option to Prime Minister Modi's National Relief Fund.",
                                          "images/hdfcbanklogo.jpg",
                                          "http://www.hdfcbank.com/personal/donate-online/donate-to-charity-inner/1332166924",
                                          '',
                                          $dc_adder_user->id
                                        );
        // http://freshersplane.com/wp-content/uploads/2011/08/HDFC-Bank.jpg


        DonationCause::createNewForPosterFromUploadedImgURL("Yes Bank",
                                          "Direct link for Online Donation option to Prime Minister Modi's National Relief Fund.",
                                          "images/yesbanklogo.jpg",
                                          "http://www.yesbank.in/branch-banking/yes-touch/prime-minister-national-relief-fund.html",
                                          '',
                                          $dc_adder_user->id
                                        );

        DonationCause::createNewForPosterFromUploadedImgURL("ICICI Bank",
                                          "Direct link for Online Donation option to Prime Minister Modi's National Relief Fund.",
                                          "images/icicibanklogo.jpg",
                                          "https://www.billdesk.com/pgidsk/pgmerc/ICICI_QuickPay/PMNRFICI_quickpay_details.jsp",
                                          '',
                                          $dc_adder_user->id
                                        );

        DonationCause::createNewForPosterFromUploadedImgURL("Axis Bank",
                                          "Direct link for Online Donation option to Prime Minister Modi's National Relief Fund.",
                                          "images/axisbanklogo.jpg",
                                          "http://www.axisbank.com/personal/make-donations/online_donations/online.aspx",
                                          '',
                                          $dc_adder_user->id
                                        );
        // https://accountopening.yesbank.in/Images/UploadLogo/OrganisationLogo.jpg
    }   

}
