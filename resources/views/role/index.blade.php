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
					
					<a href="#" class="btn btn-primary">
						<i class="icon-pencil"></i>
						新增
					</a>
					<!-- <div class="widget-toolbar">
						<a href="#" data-action="collapse">
							<i class="icon-chevron-up"></i>
						</a>
					</div> -->
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
									权限
								</th>

								<th class="hidden-480">
									<i class="icon-caret-right blue"></i>
									操作
								</th>
							</tr>
						</thead>

						<tbody>
						@foreach ($roles as $role)
							<tr>

								<td>{{$role->display_name}}</td>
								<td>
									@if (count($role->perms)>1)
										@foreach ($role->perms as $perm)
											<span class="label label-sm label-primary arrowed arrowed-right">
												{{$perm->display_name}}
											</span>
										@endforeach
									@else
										暂无
									@endif
									
								</td>
								<td class="hidden-480">
									<button class="btn btn-xs btn-info">
										<i class="icon-edit bigger-120"></i>
									</button>
									<button class="btn btn-xs btn-danger">
										<i class="icon-trash bigger-120"></i>
									</button>
								</td>
								
							</tr>
						@endforeach
						</tbody>
					</table>
				</div><!-- /widget-main -->
			</div>
		</div>
	</div>
	
@endsection