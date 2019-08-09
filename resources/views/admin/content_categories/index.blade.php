@inject('request', 'Illuminate\Http\Request')
@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('global.content-categories.title')</h3>
    @can('content_category_create')
    <p>
        <a href="{{ route('admin.content_categories.create') }}" class="btn btn-success">@lang('global.app_add_new')</a>
        
    </p>
    @endcan

    

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app_list')
        </div>

        <div class="panel-body table-responsive">
            <table class="table table-bordered table-striped ajaxTable @can('content_category_delete') dt-select @endcan">
                <thead>
                    <tr>
                        @can('content_category_delete')
                            <th style="text-align:center;"><input type="checkbox" id="select-all" /></th>
                        @endcan

                        <th>@lang('global.content-categories.fields.title')</th>
                        <th>@lang('global.content-categories.fields.slug')</th>
                                                <th>&nbsp;</th>

                    </tr>
                </thead>
            </table>
        </div>
    </div>
@stop

@section('javascript') 
    <script>
        @can('content_category_delete')
            window.route_mass_crud_entries_destroy = '{{ route('admin.content_categories.mass_destroy') }}';
        @endcan
        $(document).ready(function () {
            window.dtDefaultOptions.ajax = '{!! route('admin.content_categories.index') !!}';
            window.dtDefaultOptions.columns = [@can('content_category_delete')
                    {data: 'massDelete', name: 'id', searchable: false, sortable: false},
                @endcan{data: 'title', name: 'title'},
                {data: 'slug', name: 'slug'},
                
                {data: 'actions', name: 'actions', searchable: false, sortable: false}
            ];
            processAjaxTables();
        });
    </script>
@endsection