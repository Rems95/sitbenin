@extends('admin.layouts.app')

@section('content')

<div class="row">
    <div class="col-lg-12">
        <div class="shadow card">
            <div class="card-header">
                <i class="fa fa-align-justify"></i> Edit User <span class="text-danger"> {{ $event->name }}</span>
            </div>
            <form class="form-horizontal" action="{{ route('event.update',$event->id) }}" method="post" enctype="multipart/form-data">
                 @csrf
                         <div class="card-body">
                    @include('admin.layouts.flash')

                    <div class="form-group row">
                        <label class="col-md-3 col-form-label" for="name">Name</label>
                        <div class="col-md-4">
                            <input class="form-control" name="name" value="{{$event->name}}" required autofocus
                                autocomplete="off">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-md-3 col-form-label" for="email">Author</label>
                        <div class="col-md-4">
                            <input class="form-control" name="author"  value="{{$event->author}}" required
                                autofocus autocomplete="off">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-md-3 col-form-label" for="password">Description</label>
                        <div class="col-md-4">
                            <input class="form-control" name="description" value="{{$event->description}}" required autofocus>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-md-3 col-form-label" for="password_confirmation">Date de l'evenement</label>
                        <div class="col-md-4">
                            <input class="form-control" name="statut"  value="{{$event->statut}}"  required autofocus>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-md-3 col-form-label" for="role">Statut</label>
                        <div class="col-md-4">
                            {{-- <select class="form-control" autofocus required name="role[]" id="select-role">
                                <option value="">Choose Role...</option>
                                @foreach($roles as $role)
                                <option value="{{ $role['id'] }}">{{ $role['name'] }}</option>
                                @endforeach
                            </select> --}}
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Image</label>

                        <input type="file" class="form-control" name="image" id="image"/>

                            <div class="col-md-12 mb-2">
                                <img id="preview-image-before-upload" src="{{asset('uploads/'.$event->image)}}"
                                    alt="preview image" style="max-height: 250px;">
                            </div>

               @error('photo')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>


                </div>


                <div class="card-footer">
                    <button class="btn btn-success" type="submit">
                        <i class="fa fa-paper-plane"></i> Submit
                    </button>
                </div>
            </form>

        </div>

    </div>
</div>
@endsection


@section('script')

{!! JsValidator::formRequest('App\Http\Requests\UserRequest'); !!}
<script type="text/javascript">

$(document).ready(function (e) {


   $('#image').change(function(){

    let reader = new FileReader();

    reader.onload = (e) => {

      $('#preview-image-before-upload').attr('src', e.target.result);
    }

    reader.readAsDataURL(this.files[0]);

   });

});

</script>

@endsection
