@extends('base')
@section('sidebar')
	@include('layout.sidebar')
@endsection
@section('breadcrumbs')
	@include('_partials.breadcrumbs', ['breadcrumbs' => Breadcrumbs::generate('members')])
@endsection
@section('content')
	
	<button class="btn btn-primary">新增会员</button>
	
		
	<div class="col-xs-12">
		<div class="header smaller lighter blue">
			<form action="/members" name="member_search" id="member_search" class="form-inline">
				<label for="" class="inline input-group">会员卡号/手机号:
					<input type="text" class="input" name="name" />
					<button class="btn btn-purple btn-sm" id="search-btn"><i class="icon-search icon-on-right bigger-110"></i>查询</button>
				</label>
					
			</form>
		</div>
		<div id="ajax-loading" class="alert alert-success" style="display: none;">
			<strong>载入中...</strong>
		</div>
		<div id="member_list">@include('member._index')</div>
		
		
	</div>
	
	
	



@endsection
@section('script')
<script>
	$(function(){
		$('#search-btn').bind('click',function(e){
			e.preventDefault();
			$.ajax({
				datatype: "html",
				url: $('#member_search').attr('action'),
				data: $('#member_search').serialize(),
				beforeSend: function()
		        {
		            $('#ajax-loading').show();
		            $('#member_list').empty();
		        },
				success: function(data){
					// console.log(data);
					$('#ajax-loading').hide();
					$('#member_list').empty().html(data);
				}
			});
		})
	});
</script>
@endsection