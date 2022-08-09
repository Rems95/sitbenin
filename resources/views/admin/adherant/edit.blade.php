@extends('admin.layouts.app')

@section('content')

<div class="row">
    <div class="col-lg-12">
        <div class="shadow card">
            <div class="card-header">
                <i class="fa fa-align-justify"></i> Edit User <span class="text-danger"> {{ $adherant->name }}</span>
            </div>
              <form class="form-horizontal" action="{{ route('adherant.update',$adherant->id) }}" method="POST" >
                 @csrf
                         <div class="card-body">
                    @include('admin.layouts.flash')

                    <div class="form-group row">
                        <label class="col-md-3 col-form-label" for="name">Name</label>
                        <div class="col-md-4">
                            <input class="form-control" name="name" value="{{$adherant->name}}"  autofocus
                                autocomplete="off">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-md-3 col-form-label" for="email">Author</label>
                        <div class="col-md-4">
                            <input class="form-control" name="firstname"  value="{{$adherant->lastname}}"
                                autofocus autocomplete="off">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-md-3 col-form-label" for="password">Email</label>
                        <div class="col-md-4">
                            <input class="form-control" name="email" value="{{$adherant->email}}"  autofocus>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-md-3 col-form-label" for="password">Description</label>
                        <div class="col-md-4">
                            <input class="form-control" name="firm_name" value="{{$adherant->firm_name}}"  autofocus>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-md-3 col-form-label" for="password_confirmation">Date de l'evenement</label>
                        <div class="col-md-4">
                            <input class="form-control" name="firm_create_date"  value="{{$adherant->firm_create_date}}"   autofocus>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-md-3 col-form-label" for="password_confirmation">Numéro IFU Société</label>
                        <div class="col-md-4">
                            <input class="form-control" name="firm_ifu"  value="{{$adherant->firm_ifu}}"   autofocus>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-md-3 col-form-label" for="password_confirmation">Date de l'evenement</label>
                        <div class="col-md-4">
                            <input class="form-control" name="personnal_ifu"  value="{{$adherant->personnal_ifu}}"   autofocus>
                        </div>
                    </div>

                     <div class="form-group row">
                        <label class="col-md-3 col-form-label" for="password_confirmation">Date de l'evenement</label>
                        <div class="col-md-4">
                            <input class="form-control" name="trade_register_number"  value="{{$adherant->trade_register_number}}"   autofocus>
                        </div>
                    </div>

                     <div class="form-group row">
                        <label class="col-md-3 col-form-label" for="password_confirmation">Date de l'evenement</label>
                        <div class="col-md-4">
                            <select class="form-select" id="floatingSelect"  name="subsector_id"  autofocus>
                                <option selected>Sous-secteur d'activité</option>
                                @foreach ( $subsectors as $subsector )
                                <option value="{{$subsector->id}}" @if($adherant->subsector_id=== $subsector->id) selected='selected' @endif>{{$subsector->name}}</option>
                                @endforeach
                            </select>
                        </div>


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

@endsection
