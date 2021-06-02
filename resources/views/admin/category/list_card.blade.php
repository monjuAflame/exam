<div class="card">
    <div class="card-header">
        <strong>{{ __('Category List') }}</strong>
    </div>

    <div class="card-body">
        {{--@if (session()->has('message'))
        <div class="alert alert-success alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <i class="icon fas fa-check"></i> {{ session('message') }}
        </div>
        @endif--}}
        <table id="course-category-list" class="table table-striped table-bordered dt-responsive nowrap"
            style="width:100%">
            <thead>
                <tr>
                    <th>Category Name</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($courseCategories as $cat)
                <tr>
                    <td>{{ $cat->name }}</td>
                    <td class='text-center'>
                        <a href="{{ route('category.edit', $cat->id) }}" class='btn btn-default btn-sm'><i
                                class="fa fa-edit fa-xs blue"></i></a>
                        @if ($cat->isDeletable)
                            
                            <form style="display: none;" id="delete{{$cat->id}}" method="POST"
                            action="{{ route('category.destroy', $cat->id) }}">@csrf</form>
                            <a href=""
                            onclick="event.preventDefault();document.querySelector('#delete{{ $cat->id }}').submit();"
                            class='btn btn-default btn-sm'><i class="fa fa-trash fa-xs red"></i></a>
                        @endif
                    </td>
                </tr>
                @endforeach


            </tbody>
        </table>

    </div>
    <div class="card-footer">

    </div>
</div>
