@extends('layouts.app')

@section('content')
<div class="container">
   @include('helpers.flash-messages')
    <div class="row">
        <div class="col-6">
            <h1>{{ __('shop.category.index_title') }}</h1>
        </div>
        <div class="col-6">
            <a class="float-right" href="{{ route('categories.create') }}">
                <button type="button" class="btn btn-primary"><i class="fas fa-plus"></i>&nbsp&nbsp&nbsp {{ __('shop.button.add') }}</button>
            </a>
        </div>
    </div>
    <div class="row">
        <table class="table table-hover">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">{{ __('shop.product.fields.name') }}</th>
                <th scope="col">{{ __('shop.columns.actions') }}</th>
            </tr>
            </thead>
            <tbody>
            @foreach($productCategories as $productCategory)
                <tr>
                    <th scope="row">{{ $productCategory->id }}</th>
                    <td>{{ $productCategory->name }}</td>

                    <td>
                        <a href="{{ route('categories.show', $productCategory->id) }}">
                            <button class="btn btn-primary btn-sm"><i class="fas fa-search"></i></button>
                        </a>
                        <a href="{{ route('categories.edit', $productCategory->id) }}">
                            <button class="btn btn-success btn-sm"><i class="fas fa-pencil-alt"></i></button>
                        </a>
                        <button class="btn btn-danger btn-sm delete" data-id="{{ $productCategory->id }}">
                            <i class="far fa-trash-alt"></i>
                        </button>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        {{ $productCategories->links() }}
    </div>
</div>
@endsection
@section('javascript')
    const deleteUrl = "{{ url('products') }}/";
    const confirmDelete = "{{ __('shop.messages.delete_confirm') }}";
@endsection
@section('js-files')
    <script src="{{ asset('js/delete.js') }}"></script>
@endsection
