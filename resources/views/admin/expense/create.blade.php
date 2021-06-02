@extends('admin.layouts.master')

@section('css')
<style>
    label {
        font-size: 12px;
    }
</style>
@endsection

@section('page-title')
<div class="col-sm-5">
    <h1 class="dark">Expense</h1>
</div>
<div class="col-sm-7">
    <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item"><a href="/">Home</a></li>
        <li class="breadcrumb-item active">Expense</li>
    </ol>
</div>

@endsection


@section('content')
<div class="col-md-12">
    <div class="card">
        <div class="card-header">
            <strong>{{ __('Create Expense') }}</strong> <span class="red"><b>** Required</b></span>
        </div>
        <form action="{{ route('expense.store') }}" method="POST">
            @csrf
            <div class="card-body">

                @if (session()->has('message'))
                <div class="alert alert-success alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <i class="icon fas fa-check"></i> {{ session('message') }}
                </div>
                @endif

                <table class="table table-hover">
                 
                    <thead>
                      <tr>
                        <td width="25%">
                            <label for="date">Date</label>
                            <input type="text" id="date" name="date" class="form-control" value="{{ date('d-M-Y')}}" readonly>
                        </td>
                        <td width="15%">
                            <label for="amount">Amount of Expense</label><span class="red">**</span>
                            <input type="text" id="amount" name="amount" class="form-control"  placeholder="Amount" required>
                        </td>
                        <td width="40%">
                            <label for="description">Description</label>
                            <input type="text" id="description" name="description" class="form-control"  placeholder="Description">
                        </td>
                        <td width="5%">
                            <button type="submit" class="btn btn-primary mt-4">
                                Save
                            </button>
                        </td>
                      </tr>
                    </thead>
                   </table>

                

            </div>
            <div class="card-footer">
                
            </div>

        </form>

    </div>

</div>
<div class="col-md-12">
    @include('admin.expense.card_list')
</div>

@endsection


@section('js')


@endsection