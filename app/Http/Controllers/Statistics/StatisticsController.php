<?php namespace App\Http\Controllers\Statistics;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Clockwork;
class StatisticsController extends Controller {

	/*
	|--------------------------------------------------------------------------
	| Statistics Controller
	|--------------------------------------------------------------------------
	|
	|
	*/

	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		$this->middleware('auth');
	}

	public function showChart() {
		return view('statistics.trendchart');
	}

	/**
	 * Show the application statistics overview screen to the user.
	 *
	 * @return Response
	 */
	public function getChartData() {
		Clockwork::debug("get chart data.");
		//开始时间，30天前
		$start_time = date("Y-m-d", strtotime('-30 day'));
		//结束时间，查询当天
		$end_time = date("Y-m-d");
		$records = DB::table('overview_daily')->select('card_cost', 'non_card_cost', 'created_date as date', 'created_time as unixtime')->whereBetween('created_date', array($start_time, $end_time))->get();
		Clockwork::debug($records);
		// var_dump($records);
		$card_costs = array();
		$non_card_costs = array();
		for ($i = 0; $i <= 30; $i++) {
			$series_time = strtotime("-$i day");
			$card_costs[$i] = [1000 * $series_time, 0];
			$non_card_costs[$i] = [1000 * $series_time, 0];	
			foreach ($records as $record) {
				if (date("Y-m-d", $series_time) == $record->date) {
					$card_costs[$i] = [1000 * $record->unixtime, $record->card_cost];
					$non_card_costs[$i] = [1000 * $record->unixtime, $record->non_card_cost];
					break;
				}
			}
		}
		// foreach ($records as $index => $record) {
		// 	$card_costs[$index] = [1000*$record->day, $record->card_cost];
		// 	$non_card_costs[$index] = [1000*$record->day, $record->non_card_cost];
		// }

        $datasets = array(
        	array(
        		'label' => '会员刷卡收入',
        		'data'  => $card_costs,
        	),
	       	array(
        		'label' => '现金收入',
        		'data'  => $non_card_costs,
        	),
        );
        Clockwork::debug($datasets);
        return response()->json($datasets);
	}
}
