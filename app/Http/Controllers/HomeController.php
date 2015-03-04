<?php namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Clockwork;

class HomeController extends Controller {

	/*
	|--------------------------------------------------------------------------
	| Home Controller
	|--------------------------------------------------------------------------
	|
	| This controller renders your application's "dashboard" for users that
	| are authenticated. Of course, you are free to change or remove the
	| controller as you wish. It is just here to get your app started!
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

	/**
	 * Show the application dashboard to the user.
	 *
	 * @return Response
	 */
	public function index()
	{
		$records = DB::table('overview_daily')->where('created_date', '>=', date('Y-m-d',strtotime('-1 day')))->orderBy('created_date', 'desc')->get();
		Clockwork::debug($records);
		if (count($records) > 0) {
			$today = $records[0];
			//会员总数
			$overview['total_mem_num'] = $today->total_mem_num;
			//当日新增会员数量
			$overview['new_mem_num'] = $today->new_mem_num;
			//当日会员消费人次
			$overview['card_cost_num'] = $today->card_cost_num;
			//当日非会员消费人次
			$overview['non_card_cost_num']= $today->non_card_cost_num;
			//当日现金收入
			$overview['non_card_cost'] = $today->non_card_cost;
			//当日会员刷卡收入
			$overview['card_cost'] = $today->card_cost;
			//当日会员充值总额
			$overview['card_topup'] = $today->card_topup;
		}else {
			return view('dashboard', ['overview' => '', 'chartdatas' => '']);
		}
		
		if (count($records) > 1) {
			$yesterday = $records[1];
			//非会员消费人次增长率
			if ($yesterday->non_card_cost_num != 0) {
				$overview['non_mem_rate'] = intval(($today->non_card_cost_num - $yesterday->non_card_cost_num) / $yesterday->non_card_cost_num * 100);
			} else {
				$overview['non_mem_rate'] = 100;
			}
			//会员消费人次增长率
			if ($yesterday->card_cost_num != 0) {
				$overview['mem_rate'] = intval(($today->card_cost_num - $yesterday->card_cost_num) / $yesterday->card_cost_num * 100);
			} else {
				$overview['non_mem_rate'] = 100;
			}
		}
		//dump($overview);
		//$items = DB::table('item_data')->where('group', '美发项目')->lists('item');
		//Clockwork::debug($items);
		//消费类型分布数据
		$actions = DB::table('cost')->lists('action');
		$items_num = array();
		// foreach ($items as $item) {
		// 	$items_num[$item] = 0;
		// }

		foreach ($actions as $action) {
			$sub_items = explode(",", $action);
			foreach ($sub_items as $sub_item) {
				if ($sub_item != "充值") {
					isset($items_num[$sub_item]) ? $items_num[$sub_item]++ : $items_num[$sub_item] = 1;
				}
			}
		}
		$chartdatas = array();
		foreach ($items_num as $key => $value) {
			array_push($chartdatas, ['label' => $key,  'data' => $value, 'color' => "#".$this->randColor()]);
		}

		Clockwork::debug($overview);
		Clockwork::debug($chartdatas);
		return view('dashboard', ['overview' => (object)$overview, 'chartdatas' => $chartdatas]);
		
	}
	private function randColor(){
	    $colors = array();
	    for($i = 0; $i<6; $i++){
	        $colors[] = dechex(rand(0,15));
	    }
	    return implode('',$colors);
	}

}
