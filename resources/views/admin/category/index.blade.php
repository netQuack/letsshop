<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
           
            All Categories <b></b>

           

        </h2>
    </x-slot>

    <div class="py-12">
    <div class="container">
        <div class="row">
        	<div class="col-md-8">
        		<div class="card">



        			@if(session('success'))

        			<div class="alert alert-success alert-dismissible fade show" role="alert">
  <strong>{{session('success')}}</strong>
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
					</div>
					@endif



        			<div class="card-header"> All Categories</div>        		

			            <table class="table">
			  <thead>
			    <tr>
			      <th scope="col">SL No</th>
			      <th scope="col">Category Name</th>
			      <th scope="col">User</th>
			      <th scope="col">Created At</th>			      			      <th scope="col">Action</th>

			    </tr>
			  </thead>
			  <tbody>


			  	@foreach($categories as $category)
	<tr>
		<th scope="row">{{$categories->firstItem()+$loop->index}} </th>
		<td>{{$category->category_name}}</td>
		<td>{{$category->user->name}}</td>
		
<td>
		@if($category->created_at == NULL)
		<span class="text-danger"> No date </span>

		@else

<!-- 		{{-- this is the style of commenting in blade --}}
		{{-- $category->created_at->diffForHumans() --}} -->

		{{Carbon\Carbon::parse($category->created_at)->diffForHumans()}}

		@endif</td>


		<td>
			
			<a href="{{url('category/edit/'.$category->id)}}" class="btn btn-info">Edit</a>
			<a href="{{url('softdelete/category/'.$category->id)}}" class="btn btn-danger">Delete</a>

		</td>



	</tr>
				@endforeach






  </tbody>
</table>

		<!-- {{-- paginate --}} -->

		{{ $categories->links()}}

</div>

        		
   </div>


  	<div class="col-md-4">
        <div class="card">
        <div class="card-header"> Add Categories</div> 


        <div class="card-body">

        <form action="{{route('store.category')}}" method="POST">

        	@csrf

  <div class="mb-3">
    <label for="exampleInputEmail1" class="form-label">Category Name</label>
    <input type="text" name="category_name" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">


    @error('category_name')

    <span class="text-danger">{{$message}}</span>

    @enderror


</div>
  <button type="submit" class="btn btn-primary">Add Category</button>
</form>

	</div>







    </div>

    </div>
    </div>

    </div>



 <!-- Trash part -->


<div class="container">
        <div class="row">
        	<div class="col-md-8">
        		<div class="card">

        			<div class="card-header">Trash </div>        		

			            <table class="table">
			  <thead>
			    <tr>
			      <th scope="col">SL No</th>
			      <th scope="col">Category Name</th>
			      <th scope="col">User</th>
			      <th scope="col">Created At</th>			      			      <th scope="col">Action</th>

			    </tr>
			  </thead>
			  <tbody>


			  	@foreach($trashCat as $trash)
	<tr>
		<th scope="row">{{$trashCat->firstItem()+$loop->index}} </th>
		<td>{{$trash->category_name}}</td>
		<td>{{$trash->user->name}}</td>
		
<td>
		@if($trash->created_at == NULL)
		<span class="text-danger"> No date </span>

		@else

<!-- 		{{Carbon\Carbon::parse($trash->created_at)->diffForHumans()}}
 -->

		{{$trash->created_at->diffForHumans()}}



		@endif</td>


		<td>
			
			<a href="{{url('category/restore/'.$trash->id)}}" class="btn btn-info">Restore</a>
			<a href="{{url('permdelete/category/'.$trash->id)}}" class="btn btn-danger">Delete</a>

		</td>



	</tr>
				@endforeach






  </tbody>
</table>

<!-- {{-- paginate --}} -->

{{ $trashCat->links()}}

</div>

        		
   </div>


  	<div class="col-md-4">
       

    </div>
    </div>

    </div>

<!-- End of trash -->


    </div>
</x-app-layout>










<!--     public function Restore($id){
        //eloquent style
        $delete = Category::withTrashed()->find($id);
        $delete->deleted_at = null;
        $delete->save();
        return Redirect()->back()->with('success','Category was restored successfully.');

 -->

