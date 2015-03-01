@extends('_partials.modal')
@section('modal-title')
	{{$data}}
@endsection
@section('modal-body')
	<ul id="ztree" class="ztree"></ul>
	{{$data}}
@endsection
@section('modal-footer')
	<button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
    <button type="submit" class="btn btn-primary">确认</button>
@endsection
@section('script')
@include('layout.basescript')
<link rel="stylesheet" href="/css/zTreeStyle.css" type="text/css">
<script type="text/javascript" src="/js/jquery.ztree.core-3.5.min.js"></script>
<script type="text/javascript" src="/js/jquery.ztree.excheck-3.5.min.js"></script>
<script type="text/javascript">
	var setting = {
			check: {
				enable: true
			},
			data: {
				simpleData: {
					enable: true
				}
			}
		};

		var zNodes =[
			{ id:1, pId:0, name:"随意勾选 1", open:true},
			{ id:11, pId:1, name:"随意勾选 1-1", open:true},
			{ id:111, pId:11, name:"随意勾选 1-1-1"},
			{ id:112, pId:11, name:"随意勾选 1-1-2"},
			{ id:12, pId:1, name:"随意勾选 1-2", open:true},
			{ id:121, pId:12, name:"随意勾选 1-2-1"},
			{ id:122, pId:12, name:"随意勾选 1-2-2"},
			{ id:2, pId:0, name:"随意勾选 2", checked:true, open:true},
			{ id:21, pId:2, name:"随意勾选 2-1"},
			{ id:22, pId:2, name:"随意勾选 2-2", open:true},
			{ id:221, pId:22, name:"随意勾选 2-2-1", checked:true},
			{ id:222, pId:22, name:"随意勾选 2-2-2"},
			{ id:23, pId:2, name:"随意勾选 2-3"}
		];
	$(function(){
		$.fn.zTree.init($("#ztree"), setting, zNodes);

	})
</script>
@endsection