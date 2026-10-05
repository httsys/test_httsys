@extends('layouts.front')

@section('title') {{$page->meta_title}} @endsection
@section('meta') {{$page->meta_description}} @endsection



@section('content')
  
  


   <div class="breadcrumb-area">
        <div class="container">

               <h1 class="breadcrumb-title">{!!$page->meta_title!!}</h1>

               <ul class="shape-group-code">
                    <li class="shape shape-1">
                        <img src="img/bubble-9.png" alt="circle">
                    </li>
                    <li class="shape shape-2" >
                        <img src="img/bubble-17.png" alt="circle">
                    </li>
                    <li class="shape shape-3" >
                        <img src="img/line-4.png" alt="circle">
                    </li>
                </ul>
        </div>
   </div>

   <div class="page-content">
   		<div class="container">

   			@include('ads.zone', ['key' => 'page_top', 'label' => 'Generic Page - Top'])

   			{!!$page->body!!}

   			@include('ads.zone', ['key' => 'page_bottom', 'label' => 'Generic Page - Bottom'])

   		</div>
   		
   </div>





@endsection

