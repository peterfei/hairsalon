@extends('_partials.modal')
@section('modal-title')
	{{$data}}
@endsection
@section('modal-body')
	{{$data}}
@endsection
@section('modal-footer')
	<button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
    <button type="submit" class="btn btn-primary">确认</button>
@endsection