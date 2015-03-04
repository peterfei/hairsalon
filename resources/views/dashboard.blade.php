@extends('base')
@section('sidebar')
@include('layout.sidebar')
@endsection
@section('breadcrumbs')
@include('_partials.breadcrumbs', ['breadcrumbs' => Breadcrumbs::generate('home')])
@endsection
@section('content')

<div class="row">
	<div class="space-6"></div>
	<div class="col-sm-7">
		<h3 class="header smaller lighter green">
			<i class="icon-bullhorn"></i>
			今日总览
		</h3>
		<div class="infobox-container">
			
			<div class="infobox infobox-green  ">
				<div class="infobox-icon">
					<i class="icon-user"></i>
				</div>

				<div class="infobox-data">
					<span class="infobox-data-number">{{isset($overview->new_mem_num) ? $overview->new_mem_num : 0}}</span>
					<div class="infobox-content">新增会员</div>
				</div>
				<div class="badge badge-info">
					{{isset($overview->total_mem_num) ? $overview->total_mem_num : 0}}
				</div>
			</div>

			<div class="infobox infobox-blue">
				<div class="infobox-icon">
					<i class="icon-bar-chart"></i>
				</div>

				<div class="infobox-data">
					<span class="infobox-data-number">{{isset($overview->card_cost_num) ? $overview->card_cost_num : 0}}</span>
					<div class="infobox-content">会员消费人次</div>
				</div>
					@if (isset($overview->mem_rate))
						@if ($overview->mem_rate >= 0)
						    <div class="stat stat-success">+{{$overview->mem_rate}}%</div>
						@else
						    <div class="stat stat-important">{{$overview->mem_rate}}%</div>
						@endif
					@else
						<div class="stat stat-success">0%</div>
					@endif

			</div>

			<div class="infobox infobox-pink  ">
				<div class="infobox-icon">
					<i class="icon-bar-chart"></i>
				</div>

				<div class="infobox-data">
					<span class="infobox-data-number">{{isset($overview->non_card_cost_num) ? $overview->non_card_cost_num : 0}}</span>
					<div class="infobox-content">非会员消费人次</div>
				</div>
				@if(isset($overview->non_mem_rate))
					@if ($overview->non_mem_rate >= 0)
					    <div class="stat stat-success">+{{$overview->non_mem_rate}}%</div>
					@else
					    <div class="stat stat-important">{{$overview->non_mem_rate}}%</div>
					@endif
				@else
					<div class="stat stat-success">0%</div>
				@endif
			</div>		

			<div class="space-6"></div>

			<div class="infobox infobox-green infobox-small infobox-dark">
				<div class="infobox-icon">
					<i class="icon-jpy"></i>
				</div>

				<div class="infobox-data">
					<div class="infobox-content">现金收入</div>
					<div class="infobox-content">{{isset($overview->non_card_cost) ? $overview->non_card_cost : 0}}</div>
				</div>
			</div>

			<div class="infobox infobox-blue infobox-small infobox-dark">
				<div class="infobox-icon">
					<i class="icon-jpy"></i>
				</div>
				<div class="infobox-data">
					<div class="infobox-content">刷卡收入</div>
					<div class="infobox-content">{{isset($overview->card_cost) ? $overview->card_cost : 0}}</div>
				</div>
			</div>

			<div class="infobox infobox-grey infobox-small infobox-dark">
				<div class="infobox-icon">
					<i class="icon-jpy"></i>
				</div>

				<div class="infobox-data">
					<div class="infobox-content">会员充值</div>
					<div class="infobox-content">{{isset($overview->card_topup) ? $overview->card_topup : 0}}</div>
				</div>
			</div>		
		</div>
	</div>

	<div class="vspace-sm"></div>

	<div class="col-sm-5">
		<h3 class="header smaller lighter green">
			<i class="icon-bullhorn"></i>
			消费项目分布 
		</h3>
		<div class="widget-box">
			<div class="widget-header widget-header-flat widget-header-small">
				<h5>
					<i class="icon-signal"></i>
					
				</h5>

				<div class="widget-toolbar no-border">
					<button id="piechartid" class="btn btn-minier btn-primary dropdown-toggle" data-toggle="dropdown">
						本周
						<i class="icon-angle-down icon-on-right bigger-110"></i>
					</button>

					<ul class="dropdown-menu pull-right dropdown-125 dropdown-lighter dropdown-caret">
						<li class="active">
							<a href="#" class="blue">
								<i class="icon-caret-right bigger-110 ">&nbsp;</i>
								本周
							</a>
						</li>

						<li>
							<a href="#">
								<i class="icon-caret-right bigger-110 invisible">&nbsp;</i>
								上周
							</a>
						</li>

						<li>
							<a href="#">
								<i class="icon-caret-right bigger-110 invisible">&nbsp;</i>
								本月
							</a>
						</li>

						<li>
							<a href="#">
								<i class="icon-caret-right bigger-110 invisible">&nbsp;</i>
								上月
							</a>
						</li>
					</ul>
				</div>
			</div>

			<div class="widget-body">
				<div class="widget-main">
					<div id="piechart-placeholder"></div>
				</div><!-- /widget-main -->
			</div><!-- /widget-body -->
		</div><!-- /widget-box -->
	</div><!-- /span -->
</div><!-- /row -->

@endsection
@section('script')
<script src="/js/flot/jquery.flot.min.js"></script>
<script src="/js/flot/jquery.flot.pie.min.js"></script>
<script src="/js/flot/jquery.flot.resize.min.js"></script>
<script type="text/javascript">
function initPieChart(data) {
	var placeholder = $('#piechart-placeholder').css({'width':'90%' , 'min-height':'150px'});
	{{-- var data = [];
	@foreach ($chartdatas as $chartdata) 
	 	data.push({ label: "{{$chartdata['label']}}", data: {{$chartdata['data']}}, color: "{{$chartdata['color']}}"});
	@endforeach--}}

	function drawPieChart(placeholder, data, position) {
		$.plot(placeholder, data, {
		series: {
			pie: {
				show: true,
				tilt:0.8,
				highlight: {
					opacity: 0.25
				},
				stroke: {
					color: '#fff',
					width: 2
				},
				startAngle: 2
			}
		},
		legend: {
			show: true,
			position: position || "ne", 
			labelBoxBorderColor: null,
			margin:[-30,15]
		},
		grid: {
			hoverable: true,
			clickable: true
		}
	 })
	}
	drawPieChart(placeholder, data);

	/**
	we saved the drawing function and the data to redraw with different position later when switching to RTL mode dynamically
	so that's not needed actually.
	*/
	placeholder.data('chart', data);
	placeholder.data('draw', drawPieChart);

	var $tooltip = $("<div class='tooltip top in'><div class='tooltip-inner'></div></div>").hide().appendTo('body');
	var previousPoint = null;

	placeholder.on('plothover', function (event, pos, item) {
		if(item) {
			if (previousPoint != item.seriesIndex) {
				previousPoint = item.seriesIndex;
				var tip = item.series['label'] + " : " + item.series['percent']+'%';
				$tooltip.show().children(0).text(tip);
			}
			$tooltip.css({top:pos.pageY + 10, left:pos.pageX + 10});
		} else {
			$tooltip.hide();
			previousPoint = null;
		}

	});	
}
var data = [];
@if($chartdatas != '')
	@foreach ($chartdatas as $chartdata) 
	 	data.push({ label: "{{$chartdata['label']}}", data: {{$chartdata['data']}}, color: "{{$chartdata['color']}}"});
	@endforeach
@endif
initPieChart(data);

$(document).ready(function(){
	$("ul.dropdown-menu a").click(function(){
		console.log($(this).text());
		$('#piechartid').html($(this).text()+'<i class="icon-angle-down icon-on-right bigger-110"></i>');
		console.log('jdflkjsfls');
		$(this).parent('li').children('i').hasClass("invisible").toggleClass('invisible');
		$(this).children('i').toggleClass('invisible');
	})
});

</script>
@endsection