@extends('layouts.my_profile')

@section('styles')
<meta property="og:url"           content="{{ Request::url() }}" />
<meta property="og:type"          content="website" />
<meta property="og:title"         content="{{ $user->company }}" />
<meta property="og:description"   content="{{ $user->address }}" />
<meta property="og:image"         content="{{ asset($user->logo) }}" />
<style type="text/css">
	.cover-container {
		position: relative;
		height: 300px;
		@if(!$user->profileThemes->where('selected', 1)->isEmpty())
		background-image: url("{{ asset($user->profileThemes->where('selected', 1)->first()->bg_image) }}");
		@endif
		background-color: #f5f5f5;
		background-size: cover;
		background-position: center;
		background-repeat: no-repeat;
		margin-top: 30px;
		margin-bottom: 30px;
		background: linear-gradient(180deg,#f5f8fa 0,rgba(23,23,23,.2));
	}
	.name-image-container {
		position: absolute;
		bottom: 15px;
		left: 15px;
		z-index: 1;
		width: 100%;
		height: 100px;
	}

	.fb-share-container {
		position: absolute;
		right: 15px;
		bottom: 15px;
		z-index: 2;
	}

	.logo {
		position: absolute;
		bottom: 0px;
		left: 20%;
		height: 150px;
	}

	@media (max-width: 768px) { 
		.logo {
			position: absolute;
			bottom: 35px;
			left: 20%;
			height: 50px;
		}
	}

	.company {
		color: #f5f5f5;
		text-shadow: 2px 2px 5px #000;
		font-weight: 900;
	}

	.panel.with-nav-tabs .panel-heading{
	    padding: 0;
	}
	.panel.with-nav-tabs .nav-tabs{
		border-bottom: none;
	}
	.panel.with-nav-tabs .nav-justified{
		margin-bottom: -1px;
	}
	/********************************************************************/
	/*** PANEL DEFAULT ***/
	.with-nav-tabs.panel-default .nav-tabs > li > a,
	.with-nav-tabs.panel-default .nav-tabs > li > a:hover,
	.with-nav-tabs.panel-default .nav-tabs > li > a:focus {
	    color: #333;
	}
	.with-nav-tabs.panel-default .nav-tabs > .open > a,
	.with-nav-tabs.panel-default .nav-tabs > .open > a:hover,
	.with-nav-tabs.panel-default .nav-tabs > .open > a:focus,
	.with-nav-tabs.panel-default .nav-tabs > li > a:hover,
	.with-nav-tabs.panel-default .nav-tabs > li > a:focus {
	    color: #333;
		background-color: #ddd;
		border-color: transparent;
	}
	.with-nav-tabs.panel-default .nav-tabs > li.active > a,
	.with-nav-tabs.panel-default .nav-tabs > li.active > a:hover,
	.with-nav-tabs.panel-default .nav-tabs > li.active > a:focus {
		color: #555;
		background-color: #fff;
		border-color: #ddd;
		border-bottom-color: transparent;
	}
	.with-nav-tabs.panel-default .nav-tabs > li.dropdown .dropdown-menu {
	    background-color: #f5f5f5;
	    border-color: #ddd;
	}
	.with-nav-tabs.panel-default .nav-tabs > li.dropdown .dropdown-menu > li > a {
	    color: #333;   
	}
	.with-nav-tabs.panel-default .nav-tabs > li.dropdown .dropdown-menu > li > a:hover,
	.with-nav-tabs.panel-default .nav-tabs > li.dropdown .dropdown-menu > li > a:focus {
	    background-color: #ddd;
	}
	.with-nav-tabs.panel-default .nav-tabs > li.dropdown .dropdown-menu > .active > a,
	.with-nav-tabs.panel-default .nav-tabs > li.dropdown .dropdown-menu > .active > a:hover,
	.with-nav-tabs.panel-default .nav-tabs > li.dropdown .dropdown-menu > .active > a:focus {
	    color: #fff;
	    background-color: #555;
	}

	.nav-tabs > li > a, .nav-tabs > li > a:hover {
		border-radius: 0;
	}

	.panel {
		border-radius: 0;
	}
</style>
@stop

@section('content')
<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = 'https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.12';
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>

<div class="cover-container">
	<div class="name-image-container">
		<div class="row">
			<div class="col-xs-2" style="height: 100px;">
				<img src="{{ asset($user->logo) }}" class="img-circle img-thumbnail logo">
			</div>
			<div class="col-xs-10">
				<h3 class="company">{{ $user->company }}</h3>
			</div>
		</div>
	</div>
	<div class="fb-share-container">
		<div class="fb-share-button" data-href="{{ Request::url() }}" data-layout="button_count" data-size="small" data-mobile-iframe="true"><a target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=https%3A%2F%2Fdevelopers.facebook.com%2Fdocs%2Fplugins%2F&amp;src=sdkpreparse" class="fb-xfbml-parse-ignore">Share</a></div>
	</div>
</div>

<div class="row">
	<div class="col-md-3">
		<div class="panel panel-default">
			<div class="panel-heading text-center">
				Our Ratings
			</div>
			<div class="panel-body text-center">
				@if($user->profileRatings->isEmpty())
				<p class="text-center">No Ratings Yet.</p>
				@else
				<div class="mgb5">
					@for ($i = 0; $i < floor($user->profileRatings->avg('score')); $i++)
					    <i class="fa fa-star" style="color: orange;"></i>
					@endfor
				</div>
				<label>Score: {{ number_format($user->profileRatings->avg('score'), 2, '.', '') }}</label>
				@endif
			</div>
		</div>
		<div class="panel panel-default">
			<div class="panel-heading text-center">
				Recent Feedbacks
			</div>
			<div class="panel-body">
				@if($user->profileFeedbacks->where('accept', 1)->isEmpty())
				<div class="text-center">
					No Feedbacks yet.
				</div>
				@else
				@foreach($user->profileFeedbacks->where('accept', 1)->take(3) as $feedback)
				<div class="row mgb5">
					<div class="col-md-12">
						<p class="mgb5">"{{ $feedback->feedback }}"</p>
						<div class="mgb5 text-center">
							@isset($user->profileRatings->where('cart_id', $feedback->cart_id)->first()->score)
							@for ($i = 0; $i < $user->profileRatings->where('cart_id', $feedback->cart_id)->first()->score; $i++)
							    <i class="fa fa-star" style="color: orange;"></i>
							@endfor
							@endisset
						</div>
						<div class="text-muted text-center">
							{{ $feedback->cx }}, {{ date_format($feedback->created_at, 'M-d-Y g:i A') }}
						</div>
					</div>
				</div>
				<hr>
				@endforeach
				@endif
			</div>
		</div>
	</div>
	<div class="col-md-9">
		<div class="panel with-nav-tabs panel-default">
            <div class="panel-heading">
                    <ul class="nav nav-tabs">
                        <li class="active"><a href="#tab1default" data-toggle="tab">Menu</a></li>
                        <li><a href="#tab3default" data-toggle="tab">Add-Ons</a></li>
                        <li><a href="#tab2default" data-toggle="tab">About</a></li>
                    </ul>
            </div>
            <div class="panel-body">
                <div class="tab-content">
                    <div class="tab-pane fade in active" id="tab1default">
                    	@if($user->profileCategoryMenus->isEmpty())
                    	<p>No Menus yet.</p>
                    	@else
                    	@foreach($user->profileCategoryMenus as $category)
                    		<label>{{ $category->name }}</label>
                    		<hr>
	                    	<div class="row">
	                    		@foreach($category->categoryMenus as $menu)
					        	<div class="col-md-4">
						        	<div class="panel panel-default">
						        		<div class="panel-heading text-center">
						        			{{ $menu->name }}
						        		</div>
						        		<div class="panel-body">
						        			<div class="form-group text-center">
							        			<img src="{{ asset($menu->image) }}" class="img-rounded img-thumbnail" style="height: 150px;">	
						        			</div>
						        			<div class="form-group text-center">
							        			<label>Price:</label> <span id="menuPrice{{ $menu->id }}">{{ $menu->price }}</span>
						        			</div>
						        			<div class="form-group text-center">
						        				<p>
						        					{{ $menu->description }}
						        				</p>
						        			</div>
						        		</div>
						        	</div>
					        	</div>
					        	@endforeach
	                    	</div>                    		
                    	@endforeach
                    	@endif
	                </div>
	                <div class="tab-pane fade" id="tab3default">
	                	@if($user->profileCategoryAddons->isEmpty())
                    	<p>No Add-ons yet.</p>
                    	@else
                    	@foreach($user->profileCategoryAddons as $categori)
                    		<label>{{ $categori->name }}</label>
                    		<hr>
	                    	<div class="row">
	                    		@foreach($categori->categoryAddons as $addon)
					        	<div class="col-md-4">
						        	<div class="panel panel-default">
						        		<div class="panel-heading text-center">
						        			{{ $addon->name }}
						        		</div>
						        		<div class="panel-body">
						        			<div class="form-group text-center">
							        			<img src="{{ asset($addon->image) }}" class="img-rounded img-thumbnail" style="height: 150px;">	
						        			</div>
						        			<div class="form-group text-center">
							        			<label>Price:</label> <span id="addonPrice{{ $addon->id }}">{{ $addon->price }}</span>
						        			</div>
						        			<div class="form-group text-center">
						        				<p>
						        					{{ $addon->description }}
						        				</p>
						        			</div>
						        		</div>
						        	</div>
					        	</div>
					        	@endforeach
	                    	</div>                    		
                    	@endforeach
                    	@endif
	                </div>
                    <div class="tab-pane fade" id="tab2default">
                    	<div class="row">
                    		<div class="col-md-12">
                    			<div class="form-group">
                    				<label>Address:</label> <p>{{ $user->address }}</p>
                    			</div>
                    			<div class="form-group">
                    				<label>E-mail Address:</label> <p>{{ $user->email }}</p>
                    			</div>
                    			<div class="form-group">
                    				<label>Contact Number:</label> <p>{{ $user->contact_number }}</p>
                    			</div>
                    		</div>
                    	</div>
                    </div>
                </div>
            </div>
        </div>
	</div>
</div>
@stop