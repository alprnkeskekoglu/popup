@extends('Core::layouts.app')

@section('content')
    @include('Core::includes.page_header', ['headerTitle' => __('Popup::general.title.index')])

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="mb-3 text-end">
                        <a href="{{ route('dawnstar.popups.create') }}" class="btn btn-primary">
                            <i class="uil uil-plus me-1"></i>
                            @lang('Core::general.add_new')
                        </a>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-centered mb-0">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>@lang('Popup::general.labels.status')</th>
                                <th>@lang('Core::general.actions')</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($popups as $popup)
                                <tr>
                                    <th scope="row">{{ $popup->id }}</th>
                                    <td>
                                        <span class="badge bg-{{ statusClass($popup->status) }} font-16">{{ statusText($popup->status) }}</span>
                                    </td>
                                    <td class="table-action">
                                        <a href="{{ route('dawnstar.popups.edit', $popup) }}" class="action-icon"> <i class="mdi mdi-pencil"></i></a>
                                        <form action="{{ route('dawnstar.popups.destroy', $popup) }}" method="POST" class="d-inline">
                                            @method('DELETE')
                                            @csrf
                                            <button type="submit" class="btn action-icon">
                                                <i class="mdi mdi-delete"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    @if(session('success'))
        <script>
            showMessage('success', '', '{{ session('success') }}')
        </script>
    @endif
@endpush
