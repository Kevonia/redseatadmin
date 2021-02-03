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
                        <select class="form-control select2 select2-hidden-accessible" name="user" data-select2-id="1" tabindex="-1" aria-hidden="true">
                                             
                        @foreach($user as $id)
                                            <option  value='{{ $id->id }}' > {{$id->name}}  </option>
                                            @endforeach
                        
                        </select>
                     </div>
                     <!-- GET THE DISPLAY OPTIONS -->
                     <div class="form-group  col-md-12 " data-children-count="1">
                        <label class="control-label" for="name"> Package </label>
                        <select class="form-control select2 select2-hidden-accessible" name="package" data-select2-id="1" tabindex="-1" aria-hidden="true">
                                             
                        @foreach($package as $id)
                                            <option  value='{{ $id->id }}' > {{$id->description}}  </option>
                                            @endforeach
                        
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
            
            </div>
         </div>
     
 
      </div>
   </div>

   <!-- End Delete File Modal -->
</div>
@stop