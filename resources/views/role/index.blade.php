@extends('base')
@section('sidebar')
	@include('layout.sidebar')
@endsection
@section('breadcrumbs')
	@include('_partials.breadcrumbs', ['breadcrumbs' => Breadcrumbs::generate('roles')])
@endsection
@section('content')
	<div class="row">
		<div class="col-sm-12">
			<div class="widget-box transparent">
				<div class="widget-header widget-header-flat">
					<h4 class="light">
						<i class="icon-star orange"></i>
					</h4>
					<div class="widget-toolbar">
						<a href="#" data-action="collapse">
							<i class="icon-chevron-up"></i>
						</a>
					</div>
				</div>
			</div>
			<div class="widget-body">
				<div class="widget-main no-padding">
					<table class="table table-bordered table-striped">
						<thead class="thin-border-bottom">
							<tr>
								<th>
									<i class="icon-caret-right blue"></i>
									名称
								</th>

								<th>
									<i class="icon-caret-right blue"></i>
									价格
								</th>

								<th class="hidden-480">
									<i class="icon-caret-right blue"></i>
									状态
								</th>
							</tr>
						</thead>

						<tbody>
							<tr>
								<td>internet.com</td>

								<td>
									<small>
										<s class="red">$29.99</s>
									</small>
									<b class="green">$19.99</b>
								</td>

								<td class="hidden-480">
									<span class="label label-info arrowed-right arrowed-in">销售中</span>
								</td>
							</tr>
						</tbody>
					</table>
				</div><!-- /widget-main -->
			</div>
		</div>
	</div>
	
@endsection