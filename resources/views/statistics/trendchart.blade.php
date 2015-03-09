@extends('base')
@section('sidebar')
@include('layout.sidebar')
@endsection
@section('breadcrumbs')
@include('_partials.breadcrumbs', ['breadcrumbs' => Breadcrumbs::generate('showchart')])
@endsection
@section('content')

<div class="col-sm-10">
	<div class="widget-box transparent">
		<div class="widget-header widget-header-flat">
			<h4 class="lighter">
				<i class="icon-signal"></i>
				最近30天收入趋势
			</h4>

			<div class="widget-toolbar">
				<a href="#" data-action="collapse">
					<i class="icon-chevron-up"></i>
				</a>
			</div>
		</div>

		<div class="widget-body">
			<div class="widget-main padding-4">
				<div id="trend-charts"></div>
			</div><!-- /widget-main -->
		</div><!-- /widget-body -->
	</div><!-- /widget-box -->
</div>

@endsection
@section('script')
<script src="/js/flot/jquery.flot.min.js"></script>
<script src="/js/flot/jquery.flot.pie.min.js"></script>
<script src="/js/flot/jquery.flot.resize.min.js"></script>
<script src="/js/flot/jquery.flot.time.js"></script>
<script src="/js/accounting.min.js"></script>

<script type="text/javascript">
var options = {
	lines: {
		show: true,
		fill: true
	},
	points: {
		show: true
	},
	grid: { 
        hoverable: true 
    },
    yaxis: {
        ticks: 10,
        min: 0,
        autoscaleMargin: 0.2,
        tickFormatter: function(v, axis) {
            return accounting.formatMoney(v, "￥", 0);
        }
    },
    xaxis: {
    	ticks: 10,
	    mode: "time",
	    timeformat: "%m-%d"
	}
};
var placeholder = $('#trend-charts').css({'width':'100%' , 'min-height':'300px'});
$.ajax({
    type: 'get',
    dataType: "json",
    url: '/getchartdata',
    success: function(data){
		chartObj = $.plot("#trend-charts", data, options);
    }
});
function showTooltip(x, y, contents) {
    $('<div id="tooltip">' + contents + '</div>').css( {
            position: 'absolute',
            display: 'none',
            top: y - 30,
            left: x + 5,
            border: '1px solid #fdd',
            padding: '2px',
            'background-color': '#fee',
            opacity: 0.80
        }).appendTo("body").fadeIn(200);
}

var previousPoint = null;
$("#trend-charts").bind("plothover", function (event, pos, item) {
    $("#x").text(pos.x.toFixed(2));
    $("#y").text(pos.y.toFixed(2));


    if (item) {
        if (previousPoint != item.dataIndex) {
            previousPoint = item.dataIndex;
            
            $("#tooltip").remove();
            var x = item.datapoint[0],
                y = item.datapoint[1];
            var d = new Date(x);
            var contents = d.getFullYear() + "年" + (d.getMonth() + 1) + "月" + d.getDate() + "日 " + item.series.label + ": " + accounting.formatMoney(y, "￥", 0);
            showTooltip(item.pageX, item.pageY, contents);
        }
    }
    else {
        $("#tooltip").remove();
        previousPoint = null;            
    }

});

</script>
@endsection