<div class="breadcrumbs" id="breadcrumbs">
		<script type="text/javascript">
			try{ace.settings.check('breadcrumbs' , 'fixed')}catch(e){}
		</script>
		@if($breadcrumbs)
			<ul class="breadcrumb">
				@foreach ($breadcrumbs as $breadcrumb)

					@if (!$breadcrumb->last)
						<li>
							<i class="icon-{{{$breadcrumb->icon}}} {{{$breadcrumb->icon}}}-icon"></i>
							<a href="{{{ $breadcrumb->url }}}">{{{ $breadcrumb->title }}}</a>
						</li>
					@else
						  <i class="icon-{{{$breadcrumb->icon}}} {{{$breadcrumb->icon}}}-icon"></i>
						  <li class="active">{{{ $breadcrumb->title }}}</li>
					@endif
					
				@endforeach
				

				
			</ul><!-- .breadcrumb -->
		@endif
		

		<div class="nav-search" id="nav-search">
			<form class="form-search">
				<span class="input-icon">
					<input type="text" placeholder="Search ..." class="nav-search-input" id="nav-search-input" autocomplete="off" />
					<i class="icon-search nav-search-icon"></i>
				</span>
			</form>
		</div><!-- #nav-search -->
	</div>


