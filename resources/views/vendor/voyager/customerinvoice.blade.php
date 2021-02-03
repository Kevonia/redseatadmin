@extends('voyager::master')


 

@section('content')



   <h1 class="page-title">
      <i class=""></i>
      Customer Invoice
   </h1>
   <div id="voyager-notifications"></div>
   <div class="page-content edit-add container-fluid">
      <div class="row">
         <div class="col-md-12">
            <div class="panel panel-bordered">
               <!-- form start -->
               <form role="form" class="form-edit-add" action="/add/customerinvoice" method="POST" enctype="multipart/form-data">
                  <!-- PUT Method if we are editing -->
                  <!-- CSRF TOKEN -->
                  <input type="hidden" name="_token" value="{{ csrf_token() }}">
                  <div class="panel-body">
                     <!-- Adding / Editing -->
                     <!-- GET THE DISPLAY OPTIONS -->
                     <div class="form-group  col-md-12 " data-children-count="1">
                        <label class="control-label" for="name"> Customer </label>
                        <select class="form-control select2 select2-hidden-accessible"   id="user" name="user" data-select2-id="1" tabindex="-1" aria-hidden="true">
                                             
                        @foreach($user as $id)
                                            <option  value='{{ $id->id }}' > {{$id->name}}  </option>
                                            @endforeach
                        
                        </select>
                     </div>
                     <!-- GET THE DISPLAY OPTIONS -->
                     <div class="form-group  col-md-12 " data-children-count="1">
                        <label class="control-label" for="name"> Package </label>
                        <select class="form-control select2 select2-hidden-accessible" disabled id="package"  name="package" data-select2-id="1" tabindex="-1" aria-hidden="true">
                                             

                                       
                                      
                        
                        </select>
                     </div>

                     <div class="form-group  col-md-12 " data-children-count="1">
                        <label class="control-label" for="name"> custom free </label>
                        <input required="" type="text" class="form-control" name="custom fees" placeholder="custom fees" value="0">
                     </div>

                    

                     <div class="form-group  col-md-12 " data-children-count="1">
                        <label class="control-label" for="name"> purchasing fees </label>
                        <input required="" type="text" class="form-control" name="purchasing fees" placeholder="custom fees" value="0">
                     </div>

                     
                     <div class="panel-footer">
                     <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                                                        <button type="submit" class="btn btn-primary save">Save</button>
                                                    </div>
               </form>
            
               @if (count($errors) > 0)
   <div class = "alert alert-danger">
      <ul>
         @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
         @endforeach
      </ul>
   </div>
@endif
            </div>
         </div>
     
 
      </div>
   </div>

   <!-- End Delete File Modal -->
</div>

<script
  src="https://code.jquery.com/jquery-3.5.1.min.js"
  integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0="
  crossorigin="anonymous"></script>

<script type="text/javascript" >

$("#user").change(function(){

   $( "#package" ).prop( "disabled", true );

   $('#package').html('');

   $.get( "../api/vi/getPackageby/"+ $( "#user option:selected" ).val(), function( data ) {

     $.each(data,function(index,value){
          
          $("#package").append("<option  value='"+ value.id +"' > "+ value.description +"  </option>")

          $( "#package" ).prop( "disabled", false );

     })
   });

});

</script>

@stop