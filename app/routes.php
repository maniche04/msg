<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('/', function()
{
	return View::make('login');
})->before('auth');



/*
|-------------------------------------
|SALES REPORTS
|-------------------------------------
|The section will contain routes to various sales reports / output to excel commands
|
*/

//LOSS REPORT FOR EACH SALES DAY
Route::get('/lossreport', function()
{
	return View::make('scrap');
});

Route::get('/salesreport',function() {
		
		$get = "SELECT salesman, SUM(qty) as qty, SUM(saleamt) as saleamt, SUM(saleamt-amt) as profit FROM sr_invoicewise GROUP BY salesman";
		$data = DB::select($get);
		$get = 'SELECT date(vr_date) as date, SUM(qty) as qty, SUM(saleamt) as saleamt, SUM(saleamt-amt) as profit FROM sr_invoicewise
				WHERE salesman != "MR MAHMOOD" GROUP BY date ORDER BY date desc';
		$data_trend= DB::select($get);
		// //will now write excel file
		// $excel = new COM("Excel.application") or die ("ERROR: Unable to instantaniate   COM!\r\n");
		// //hide or show excel application
		// $excel->Visible = TRUE;
		// $wb = $excel->WorkBooks->Add();
		// $wks = $wb->Sheets->Add();
		// $wks->Name = "Invoice Wise";

		// $excel->Visible = True;
		$salesman = array();
		$qty = array();
		$saleamt = array();
		$profit = array();

		Foreach ($data as $dat) {
			if ($dat->salesman != "MR MAHMOOD" && $dat->salesman != "LASANTHA" && $dat->salesman != "ALI GHASEM NEJAD" && $dat->salesman != "ARDAVAN") {
				$salesman[] = $dat->salesman;
				$qty[] = $dat->qty;
				$saleamt[] = $dat->saleamt;
				$profit[] = $dat->profit;
			}
			
		}

		$salesman_js = '["' . implode('", "', $salesman) . '"]';
		$qty_js = '[' . implode(',', $qty) . ']';
		$saleamt_js = '[' . implode(',', $saleamt) . ']';
		$profit_js = '[' . implode(',', $profit) . ']';

		$data2 = array('data' => $data, 'salesman' => $salesman_js, 'qty' => $qty_js, 'saleamt' => $saleamt_js, 'profit' => $profit_js, 'data_trend'=>$data_trend);
		return View::make('reports/salesreport', $data2);
});

Route::get('/xl/lossreport', 'ExcelController@lossReport');
Route::get('/xl/lossreport/do', 'ExcelController@xllossReport');



Route::get('/jiz/rec', function()
{
	return View::make('jizan/receivables');

});

Route::get('db', function()
{
	return View::make('scrap');

});


Route::get('/jiz/rec/analysis', 'ReceivableController@jiz_recanalysis');

Route::get('/jiz/c/ac/{ac_code}', function($ac_code) {
	
	$get = 'SELECT * FROM jiz_customers WHERE acc_code = "1202' . $ac_code . '" LIMIT 1';
	$basic_data = DB::select($get);


	$get = 'SELECT SUM(curamt) as totamt FROM jiz_customers_os WHERE acc_code = "1202' . $ac_code . '"';
	//$totalos = $get;
	$totalos = DB::select($get);

	$get = 'SELECT Date(os.bill_date) as bill_date, cus.cr_period, curdate() as curdate, cus.acc_code,cus.accname, cus.location, os.bill_no, (DATEDIFF(curdate(),Date(os.bill_date)) - cus.cr_period) as overdue, os.curamt as amount FROM jiz_customers AS cus INNER JOIN jiz_customers_os as os WHERE cus.acc_code = os.acc_code AND cus.cr_period > 0 AND os.curamt > 5 AND (DATEDIFF(curdate(),Date(os.bill_date)) - cus.cr_period) > 0 AND cus.acc_code = "1202' . $ac_code . '";' ;
	$overdue_data = DB::select($get);

	if (isset($basic_data[0])) {
		return View::make('jizan/customer', array('basic' =>$basic_data ,'totalos' => $totalos,'overdue' => $overdue_data));
	} else {
		echo '<p style="font-family:Cambria">||ERR 01 <br>CUSTOMER NOT FOUND!</p>';
		echo '<p style="font-family:Cambria">Please check your url and try again!</p>';
	}

});

Route::get('/jiz/rec/get/custinfo', 'ReceivableController@get_jizcustdata');
Route::get('/jiz/rec/get/custbalance', 'ReceivableController@get_jizcustbal');

Route::get('/jiz/rec/showcust', function() {
	$get = "SELECT accname, location FROM jiz_customers LIMIT 20";
	$data = DB::select($get);

	return View::make('jizan/customers', array('customers' => $data));
});

Route::get('/jiz/c/loc/{location}', function($location) {
	$get = 'SELECT accname, location FROM jiz_customers WHERE location = "'. $location . '" LIMIT 20';
	$data = DB::select($get);

	return View::make('jizan/customers', array('customers' => $data));
});

Route::get('/home', function() {
	return View::make('home')->with('flash', 'Logged in...');
})->before('auth');

Route::get('soap',function(){
	$url = 'http://192.168.1.5:8095/caniasWS603/services/iasWebService?wsdl';
	$client = new SoapClient($url);
	$sessioncan = $client->login('00','E','JZNTST','CANIAS','192.168.1.5','MANISH','aboudiaby');
	//echo var_dump($client->__getFunctions());
	//echo var_dump ($sessioncan);
	$listofservice = $client->listIASServices($sessioncan);
	echo $listofservice[0];
	$result = $client->callIASService($sessioncan,'JZN_SALESSUMMARY',1,'STRING',1);
	//echo var_dump($result);
	//$dataset = (simplexml_load_string($result));
	echo $logout = $client->Logout($sessioncan);

	//done loading data go to a view now..
	//return View::make('salestrend',array('data'=>$dataset));

})->before('auth');

Route::get('msg/get', 'MsgController@getoneMessage')->before('auth');

Route::post('msg/send', 'MsgController@sendoneMessage')->before('auth');

Route::get('msg', 'MsgController@messageCenter')->before('auth');

Route::get('msg/adduser','MsgController@addUser');

Route::get('login', array('as' => 'login', function () { 
	return View::make('login');
}))->before('guest');

Route::get('logout', array('as' => 'logout', function () { 
	Auth::logout();

}));

Route::post('login', function () {
	$user = array(
            'username' => Input::get('username'),
            'password' => Input::get('password')
        );
        
        if (Auth::attempt($user)) {
            $get = "SELECT * FROM user_notifications WHERE username='" . $user['username'] . "' AND notification_type = 'rent'"; 
            $data = DB::select($get);
            Log::info("Testing if user is eligible for the notification " . $get);
            if ($data) {
            	$rent_expired = "Call rent_expired_contracts";
            	$rents = DB::select($rent_expired);

            	if ($rents) {
            		foreach ($rents as $rent) {
            			$flat = $rent->flatname;
            			$expirydate = $rent->max_end;
            			$expiredby = $rent->days;

            			if ($expiredby < 0) {
            				$notification = "The tenancy contract for flat " . $flat . " has expired " . ($expiredby * -1) . " days ago. (" . $expirydate . ")";
            			} else {
            				$notification = "The tenancy contract for flat " . $flat . " will expire in " . $expiredby . " days. (" . $expirydate . ")";
            			}
            			
            			DB::statement("INSERT INTO ic_notifications (`from_user`,`to_user`,`msg`,`read_status`) VALUES ('system','" . $user['username'] . "','" . $notification . "',0)");
            		}
            	}
            }
            return Redirect::to('home')
                ->with('flash_notice', 'You are successfully logged in.');
        }
        
        // authentication failure! lets go back to the login page
        return Redirect::to('login')
            ->with('flash_error', 'Your username/password combination was incorrect.')
            ->withInput();
});