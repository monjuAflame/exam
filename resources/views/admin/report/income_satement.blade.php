@extends('admin.layouts.master')

@section('css')
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<style>
    label {
        font-size: 12px;
    }
</style>
@endsection

@section('page-title')
<div class="col-sm-5">
    <h1 class="dark">Income Statement</h1>
</div>
<div class="col-sm-7">
    <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item"><a href="/">Home</a></li>
        <li class="breadcrumb-item active">Income Statement</li>
    </ol>
</div>

@endsection


@section('content')
<div class="col-md-8">
    <div class="card">
        <div class="card-header">
            <table class="table table-striped" style="margin-bottom:none;">
                <tr>
                    <td><strong>From</strong></td>
                    <td>
                        <input type="text" name="form" id="form" value="{{ date('Y-m-d') }}" class="form-control" >
                    </td>
                    <td><strong>To</strong></td>
                    <td>
                        <input type="text" name="to" id="to" value="{{ date('Y-m-d') }}" class="form-control" >
                    </td>
                </tr>
            </table>
        </div>
    </div>
</div>
<div class="col-md-12">
    <div id="print">
        <p style="overflow: hidden; margin-bottom:0;">
        <input type="button" id="print" class="btn btn-sm btn-default float-left" value="print" />
        </p>
        <div id="show-statement"></div>
    </div>
</div>
@endsection


@section('js')
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script>
    $(document).ready(function(){
       
        $('#form').datepicker({
                dateFormat:'yy-mm-dd',
                changeMonth: true,
                changeYear: true,
                onSelect: function(form){
                   showFee(form,$('#to').val())
                }
        }); 
         $('#to').datepicker({
                dateFormat:'yy-mm-dd',
                changeMonth: true,
                changeYear: true,
                onSelect: function(to){
                    showFee($('#form').val(),to)
                }
        });
        $("input#print").hide();
        function showFee(form,to){
            $.get("{{ route('report.incomeStatement.show') }}",{form:form,to:to},function(data){
                $("input#print").show();
                $('#show-statement').html(data);
            })
        }
        function printDiv(el) {
            var restorepage = document.body.innerHTML;
            var printcontent = document.getElementById(el).innerHTML;
            document.body.innerHTML = printcontent;
            window.print();
            document.body.innerHTML = restorepage;
            window.close();
        }
        $("input#print").click(function(value) {
            printDiv(this.value);
        });
    
    });
</script>

@endsection