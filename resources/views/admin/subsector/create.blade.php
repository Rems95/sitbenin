@extends('admin.layouts.app')

@section('content')

<div class="row">
    <div class="col-lg-12">
        <div class="shadow card">
            <div class="card-header">
                <i class="fa fa-align-justify"></i> Create New event
            </div>
            <form class="form-horizontal" action="{{ route('subsector.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="card-body">
                    @include('admin.layouts.flash')

                    <div class="form-group row">
                        <label class="col-md-3 col-form-label" for="name">Name</label>
                        <div class="col-md-4">
                            <input class="form-control" name="name" value="{{ old('name') }}" required autofocus
                                autocomplete="off">
                        </div>
                    </div>
                </div>

                <div class="card-footer">
                    <button class="btn btn-success" type="submit">
                        <i class="fas fa-paper-plane"></i> Submit
                    </button>
                </div>
            </form>

        </div>
    </div>
</div>
@endsection


@section('script')
{!! JsValidator::formRequest('App\Http\Requests\UserRequest'); !!}
<script>
    $('#select-role').selectize({
          maxItems: 10,
        });
</script>
@endsection
