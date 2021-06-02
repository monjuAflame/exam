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
        <li class="breadcrumb-item active">Edit</li>
    </ol>
</div>

@endsection


@section('content')
<div class="col-md-12">
    <div class="card">
        <div class="card-header">
            <strong>{{ __('Edit Expense') }}</strong> <span class="red"><b>** Required</b></span>
            <a href="{{ route('expense.create') }}" class='btn btn-primary btn-sm float-right'>Expense List</a>            

        </div>
        <form action="{{ route('expense.update', $dailyExpense->id) }}" method="POST">
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
                            <input type="text" id="date" name="date" class="form-control" value="{{ date('d-m-Y' , strtotime($dailyExpense->date)) }}" readonly>
                        </td>
                        <td width="15%">
                            <label for="amount">Amount of Expense</label><span class="red">**</span>
                            <input type="text" id="amount" name="amount" class="form-control"  value="{{ $dailyExpense->amount }}" required>
                        </td>
                        <td width="40%">
                            <label for="description">Description</label>
                            <input type="text" id="description" name="description" class="form-control"  value="{{ $dailyExpense->description }}">
                        </td>
                        <td width="5%">
                            <button type="submit" class="btn btn-primary mt-4">
                                Update
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

@endsection


@section('js')


@endsection