
<table class="table table-striped table-bordered table-hover">
	<thead>
		<tr>
			<th>会员卡号</th>
			<th>会员名称</th>
			<th>会员电话</th>
			<th>会员等级</th>
			<th>会员积分</th>
		</tr>
	</thead>
	<tbody>
		@foreach ($data as $val)
			<tr>
				<td>{!!$val->cid!!}</td>
				<td>{{$val->name}}</td>
				<td>{{$val->phone}}</td>
				<td>{{$val->level}}</td>
				<td>{{$val->integral}}</td>
			</tr>
		@endforeach

	</tbody>
</table>
{!!$data->render()!!}