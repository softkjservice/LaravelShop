@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('shop.product.show_title') }}</div>
               {{-- ID produktCategory {{$productCategory->id}}--}}
                <div class="card-body">
                    <div class="form-group row">
                        <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('shop.product.fields.name') }}</label>

                        <div class="col-md-6">
                            <input id="name" type="text" maxlength="500" class="form-control" name="name" value="{{ $productCategory->name }}" disabled>
                        </div>
                    </div>



                </div>
            </div>
        </div>
    </div>
</div>
@endsection
