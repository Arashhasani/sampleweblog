@extends('layouts.master')



@section('content')


   <div class="container mt-4">
       <div class="row">
           <div class="col-md-12">

               @include('errors')
               <div class="card" >
                   <div class="card-body">
                       <h5 class="card-title">create article</h5>
                       <form method="post" action="{{route('articles.store')}}" enctype="multipart/form-data">
                           @csrf
                           <div class="row">
                               <div class="col-md-4">
                                   <div class="mb-3">
                                       <label  class="form-label">Title</label>
                                       <input type="text" name="title" class="form-control" >
                                   </div>

                               </div>
                               <div class="col-md-8">
                                   <div class="mb-3">
                                       <label  class="form-label">category</label>
                                       <select class="js-example-basic-multiple form-control " id="js-example-basic-multiple" name="category[]" multiple="multiple">

                                           @foreach(\App\Models\Category::all() as $category)
                                               <option value="{{$category['id']}}">
                                                   {{$category['name']}}
                                               </option>
                                           @endforeach
                                       </select>
                                   </div>

                               </div>

                               <div class="col-md-4">
                                   <div class="mb-3">
                                       <label  class="form-label">pic</label>
                                       <input type="file" name="pic" class="form-control" >
                                   </div>

                               </div>

                               <div class="col-md-4">
                                   <div class="mb-3">
                                       <label  class="form-label">video</label>
                                       <input type="file" name="video" class="form-control" >
                                   </div>

                               </div>

                               <div class="col-md-12">
                                   <div class="mb-3">
                                       <label  class="form-label">text</label>
                                       <textarea  rows="20" name="text"
                                                 class="form-control description" id="editor1"></textarea>

{{--                                       <input type="text" class="form-control" >--}}
                                   </div>

                               </div>

                           </div>


                           <button type="submit" class="btn btn-primary">Submit</button>

                       </form>
                   </div>




               </div>
           </div>
       </div>
   </div>

@endsection
