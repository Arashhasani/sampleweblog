@extends('layouts.master')

@section('js')

    <script>
        console.log('asasasasas');

        function changeStatus(id) {
            console.log(id);

            $.ajax({
                {{--url: {{route('auth.register.student.add.pre.education')}},--}}
                url: "/statusUpdate",
                type: "POST",
                data: {
                    "_token": "{{ csrf_token() }}",
                    'id': id,
                },
                success: function (response) {
                    if (response.status==1){
                        console.log(response.text)
                        console.log(document.getElementById(`statustext${id}`).innerText)
                        document.getElementById(`statustext${id}`).innerText =response.finalstatus
                        document.getElementById(`changebtn${id}`).innerHTML=response.text
                    }

                

                },
            });




        }

    </script>
@endsection
@section('content')


   <div class="container mt-4">
       <div class="row">
           <div class="col-md-12">
               <div class="card" >
                   <div class="card-body">
                       <h5 class="card-title">article lists</h5>
                       <h6 class="card-subtitle mb-2 text-muted">
                           <a class="btn btn-sm btn-primary" href="{{route('articles.create')}}">add article</a>
                       </h6>
                       <table class="table">
                           <thead>
                           <tr>
                               <th scope="col">#</th>
                               <th scope="col">Title</th>
                               <th scope="col">Status</th>
                               <th scope="col">categories</th>
                               <th scope="col">Actions</th>
                           </tr>
                           </thead>
                           <tbody>
                           @foreach($articles as $article)
                               <tr>
                                   <th scope="row">#</th>
                                   <td>{{$article['title']}}</td>
                                   <td>
                                       <p id="statustext{{$article['id']}}">{{$article['status']}}</p>
                                   </td>
                                   <td>{{implode(',',$article->categories()->pluck('name')->toArray())}}</td>
                                   <td>
                                       @if($article['status']=='saved')
                                           <a class="btn btn-warning" href="#" id="changebtn{{$article['id']}}" onclick="event.preventDefault();changeStatus({{$article['id']}})">published</a>
                                       @else
                                           <a class="btn btn-warning" href="#" id="changebtn{{$article['id']}}" onclick="event.preventDefault();changeStatus({{$article['id']}})">saved</a>

                                       @endif

                                   </td>
                               </tr>
                           @endforeach


                           </tbody>
                       </table>
                   </div>
                   <div class="card-footer">
                       {{$articles->render()}}
                   </div>
               </div>
           </div>
       </div>
   </div>

@endsection
