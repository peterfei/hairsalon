@extends('_partials.modal')
@section('modal-title')
	用户角色
@endsection
@section('modal-body')
	<div class="message"></div>
	<ul id="ztree" class="ztree"></ul>
@endsection
@section('modal-footer')
	<button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
    <button type="submit" class="btn btn-primary" id="submit">确认</button>
@endsection
@section('script')
<script type="text/javascript">
	window.jQuery || document.write("<script src='/js/jquery-2.0.3.min.js'>"+"<"+"/script>");
</script>
<link rel="stylesheet" href="/css/zTreeStyle.css" type="text/css">
<script type="text/javascript" src="/js/jquery.ztree.core-3.5.min.js"></script>
<script type="text/javascript" src="/js/jquery.ztree.excheck-3.5.min.js"></script>
<script type="text/javascript">
	var setting = {
			check: {
				enable: true
			}
		};
			
	var zNodes =
		[
			@foreach ($data as $item)
			{
				id:"{{$item['id']}}",
				name:"{{$item['name']}}",
				checked: @if (in_array($item['id'],array_fetch($role->perms->toArray(),'id'))) true @else false @endif,
				children:[
					@if (count($item['children'])>1)
						@foreach ($item['children'] as $child)
							{
								id:"{{$child['id']}}",
								checked: @if (in_array($child['id'],array_fetch($role->perms->toArray(),'id'))) true @else false @endif,
								name:"{{$child['name']}}"
							@if (last($child))
							}
							@else
							},
							@endif
						@endforeach
					@endif 
				]
				@if (last($item))
				}
				@else
				},
				@endif

			
			@endforeach
		];	
	$(function(){
		
		$.fn.zTree.init($("#ztree"), setting, zNodes);
		// 取得选中Ztree 组
		$perms = '{{$role->perms}}';
		// console.log($perms);
		var treeObj = $.fn.zTree.getZTreeObj("ztree");
		// treeObj.checkNode('18',true,true);
		$('#submit').click(function(){
			 
		     var nodes = treeObj.getCheckedNodes(true);
		     var cancelnodes = treeObj.getCheckedNodes(false);
			 console.log(nodes);
			 //发 Ajax 请求， 为角色赋予权限
			var classpurview = "";
		    for(var i=0;i<nodes.length;i++) {
			   classpurview += "," + nodes[i].id
		    }
		    // alert(classpurview);
			 $.ajax({
			 	url:'/role_permissions',
			 	type:'get',
			 	data:{nodes:classpurview,cancelnodes:cancelnodes,modal_id:'{{$modal_id}}'},
			 	success:function(data){
			 		// if (data) {
			 			$('.message').append('{!!HTML::alert("'+data+'", "权限定义成功", "恭喜")!!}');
			 			setTimeout(function() {$("#modal-table").modal('hide');}, 3000);
			 			window.location.href= '/roles';
			 		// };
			 		
			 	}
			 });

		});

	})
</script>
@endsection