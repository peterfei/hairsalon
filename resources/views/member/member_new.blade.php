@extends('_partials.modal')
@section('modal-title')
	新增会员
@endsection
@section('modal-body')
<div class="message"></div>
<form action="/members/store"  name="member_new">
<input type="hidden" name="_token" value="{{ csrf_token() }}">
	<table class="table table-condensed table-bordered">
		<tr>
			<td>
				<label for="">会员卡号:</label>
			</td>
			<td colspan=4><input type="text" name="cid" value=""/></td>
		</tr>

		<tr>
			<td>
				<label for="">会员姓名:</label>
			</td>
			<td><input type="text" name="name" value=""></td>
			<td><label for="">手机号:</label></td>
			<td><input type="text" name="phone" value=""></td>
		</tr>

		<tr>
			<td><label for="">会员姓别:</label></td>
			<td>
				<input type="radio"  value="男" name="gender" checked/>男
				<input type="radio"  value="女" name="gender"/>女
			</td>
			
			<td><label for="">会员等级:</label></td>
			<td>
				<select name="level" >
					<option value="1">等级1</option>
				</select>
			</td>
		
		</tr>

		<tr>
			<td><label for="">过期时间:</label></td>
			<td colspan=4><input type="text" name="expiration" value="" id="datetimepicker" readonly/></td>
		</tr>
		<tr>
			<td><label for="">状态:</label></td>
			<td colspan=4>
				<select name="status" id="">
					<option value="1">正常</option>
				</select>
			</td>
		</tr>
		<tr>
			<td><label for="">账户积分:</label></td>
			<td colspan=4><input type="text" name="integral" value="0"/></td>
		</tr>
	</table>
</form>


@endsection
@section('modal-footer')
	<button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
    <button type="submit" class="btn btn-primary" id="submit">确认</button>
@endsection
@section('script')
	<script type="text/javascript">
		window.jQuery || document.write("<script src='/js/jquery-2.0.3.min.js'>"+"<"+"/script>");
	</script>
	<link rel="stylesheet" href="/css/bootstrap-datetimepicker.min.css">
	<script src="/js/jquery.gritter.min.js"></script>
	<script src="/js/date-time/bootstrap-datetimepicker.min.js"></script>
	<script>
		$(function(){
			$('#submit').on('click',function(e){
				var form = $('form[name="member_new"]');
				console.log(form.serialize());
				var action = form.attr('action');
				console.log(action);
				$.ajax({
					url:action,
					datatype:"html",
					type:"POST",
					data:form.serialize(),
					success:function(data){
						$('.message').append('{!!HTML::alert("'+data.success+'", "会员生成成功", "恭喜")!!}');
						setTimeout(function() {$("#modal-table").modal('hide');}, 1000);
						$('#member_list').empty().html(data.data);
					},
					error:function(data){
						 var errors = $.parseJSON(data.responseText);

						 errorsHtml = '<div class="alert alert-danger"><ul>';

				         $.each( errors, function( key, value ) {
				             errorsHtml += '<li>' + value[0] + '</li>'; //showing only the first error.
				         });
				         errorsHtml += '</ul></di>';
				            
				         $( '.message' ).html( errorsHtml ).fadeIn('slow').fadeOut(3000);
					}
				});
			});
			$('#datetimepicker').datetimepicker({
			    format: 'yyyy-mm-dd hh:ii'
			});

		})
	</script>
@endsection