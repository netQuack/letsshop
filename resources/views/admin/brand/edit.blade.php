<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
           
            Edit Brand <b></b>

           

        </h2>
    </x-slot>


    @if(session('success'))

    <div class="alert alert-success alert-dismissible fade show" role="alert">
  <strong>{{session('success')}}</strong>
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif    




    <div class="py-12">
    <div class="container">
        <div class="row">

  	<div class="col-md-8">
        <div class="card">
        <div class="card-header"> Edit Category</div> 


        <div class="card-body">

        <form action="{{url('brand/update/'.$brands->id) }}" method="POST" enctype="multipart/form-data">

        	@csrf
    

    <input type="hidden" name="old_image" value="{{$brands->brand_image}}">



  <div class="form-group">
    <label for="exampleInputEmail1" class="form-label">Update brand name</label>
    <input type="text" name="brand_name" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" value="{{$brands->brand_name}}">


    @error('brand_name')

    <span class="text-danger">{{$message}}</span>

    @enderror


</div>

 <div class="form-group">
    <label for="exampleInputEmail1" class="form-label">Update brand image</label>
    <input type="file" name="brand_image" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" value="{{$brands->brand_image}}">


    @error('brand_image')

    <span class="text-danger">{{$message}}</span>

    @enderror

</div>


<div class="form-group">
    <img src="{{asset($brands->brand_image)}}" style="width:400px;height:200px;">
    
</div>

  <button type="submit" class="btn btn-primary">Update Brand Data</button>
</form>

	</div>

    </div>

    </div>
    </div>

    </div>



    </div>
</x-app-layout>
