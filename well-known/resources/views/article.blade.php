@extends('layouts.front')

@section('title') {{$post->meta_title}} @endsection
@section('meta') {{$post->meta_description}} @endsection



@section('content')
  
  


   <div class="breadcrumb-area">
   	<div class="container">
   		 <h1 class="breadcrumb-title">{{$post->meta_title}}</h1>

   		<ul class="page-list">
            <li class="item-home"><a class="bread-link" href="{{ route('home') }}" title="Home">{{clean( trans('niva-backend.home') , array('Attr.EnableID' => true))}}</a></li>
            <li class="separator separator-home"></li>
            <li class="item-home"><a class="bread-link" href="{{ route('blog') }}" title="Home">{{clean( trans('niva-backend.our_news') , array('Attr.EnableID' => true))}}</a></li>
            <li class="separator separator-home"></li>
            <li class="item-current">{{$post->meta_title}}</li>
        </ul>
   	</div>
   </div>

   <div class="post-content blog-page-section">
   		<div class="container">
   			<div class="row">

   				<div class="col-md-8">
   					<article class="single-post blogloop-v2">
	                   <div class="blog_custom">
	                      <div class="post-thumbnail">
	                         <a href="{{URL::to('/')}}/post/{{$post->slug}}">
	                            <img class="blog_post_image img-fluid lazy" width="800" height="550" src="/public/img/loading-blog.gif" data-src="{{$post->photo ? '/public/images/media/' . $post->photo->file : '/public/img/200x200.png'}}" alt="{{$post->title}}">
	                          </a>
	                      </div>
	                      <span class="post-date">{{ date('d - m.Y', strtotime($post->created_at)) }}</span>
	                      <!-- POST DETAILS -->
	                      <div class="post-details">
	                         <div class="post-details-holder">
	                            <div class="post-author-avatar">
	                               <img alt="" src="/public/img/loading-blog.gif" data-src="{{$post->user->photo ? '/public/images/media/' . $post->user->photo->file : '/public/img/200x200.png'}}" class="avatar img-fluid lazy" height="120" width="120">
	                             </div>
	                            
	                            <h2 class="post-name">
	                                  {{$post->title}}                   
	                          
	                            </h2>

	                            <div class="post-category-comment-date">
	                               <span class="post-tags"><i class="fa fa-tag"></i>{{$post->category->name}}</span>
	                            </div>

	                            @include('ads.zone', ['key' => 'post_in_content_top', 'label' => 'Single Post - In Content Top'])

	                            <div class="post-body">
	                               {!! $post->body !!}
	                            </div>

	                            @include('ads.zone', ['key' => 'post_in_content_bottom', 'label' => 'Single Post - In Content Bottom'])
	                         </div>
	                      </div>
	                   </div>
	                </article>

	                <!-- COMMENTS -->
	                <div class="post-comments-section" style="margin-top:40px;">

	                    @if (session('comment_success'))
	                        <div class="alert alert-success" role="alert">
	                            {{ session('comment_success') }}
	                        </div>
	                    @endif

	                    <h3 style="margin-bottom:20px;">{{ $comments->total() }} {{ $comments->total() == 1 ? 'Comment' : 'Comments' }}</h3>

	                    @forelse($comments as $comment)
	                        <div class="single-comment" style="display:flex; gap:15px; margin-bottom:25px; padding-bottom:25px; border-bottom:1px solid #eee;">
	                            <img src="{{ $comment->user && $comment->user->photo ? '/public/images/media/' . $comment->user->photo->file : '/public/img/200x200.png' }}" alt="" width="48" height="48" style="border-radius:50%; object-fit:cover; flex-shrink:0;">
	                            <div>
	                                <strong>{{ $comment->author }}</strong>
	                                <span style="color:#999; font-size:13px; margin-left:8px;">{{ $comment->created_at->format('d M Y, h:i A') }}</span>
	                                <p style="margin-top:6px; margin-bottom:0;">{{ $comment->body }}</p>
	                            </div>
	                        </div>
	                    @empty
	                        <p class="text-muted">No comments yet. Be the first to comment!</p>
	                    @endforelse

	                    @if ($comments->hasPages())
	                        <div class="comments-pagination" style="margin:20px 0;">
	                            {!! $comments->onEachSide(1)->links() !!}
	                        </div>
	                    @endif

	                    <div class="comment-form-wrap" id="comment-form" style="margin-top:30px;">
	                        @auth
	                            <h4>Leave a Comment</h4>
	                            <form method="POST" action="{{ route('comments.store', $post->slug) }}">
	                                @csrf
	                                <div class="form-group">
	                                    <textarea name="body" class="form-control" rows="4" placeholder="Write your comment..." required maxlength="2000">{{ old('body') }}</textarea>
	                                    @error('body')
	                                        <span class="text-danger">{{ $message }}</span>
	                                    @enderror
	                                </div>
	                                <button type="submit" class="btn btn-primary">Post Comment</button>
	                            </form>
	                        @else
	                            <p>
	                                <a href="{{ route('login', ['redirect_to' => url()->current() . '#comment-form']) }}">লগইন করুন</a> অথবা <a href="{{ route('register', ['redirect_to' => url()->current() . '#comment-form']) }}">রেজিস্ট্রেশন করুন</a> কমেন্ট করার জন্য।
	                            </p>
	                        @endauth
	                    </div>

	                </div>
	                <!-- /COMMENTS -->
   				</div>

   				<div class="col-md-4">

	                @include('ads.zone', ['key' => 'post_sidebar_top', 'label' => 'Single Post - Sidebar Top'])

	                <div class="widget_element">
	                   {!!$blogsettings->html_sidebar1!!}
	                </div>

	                <div class="widget_element">
	                   {!!$blogsettings->html_sidebar2!!}
	                </div>

	                @include('ads.zone', ['key' => 'post_sidebar_bottom', 'label' => 'Single Post - Sidebar Bottom'])

	            </div>

			</div>



   		</div>
   		
   	</div>



@endsection

