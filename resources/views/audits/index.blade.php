@extends('adminlte::page')

@section('title')

@section('content_header')

@stop
@section('content')
    <div class="container">
        <h2>Audits</h2>

        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>User Type</th>
                    <th>User ID</th>
                    <th>Event</th>
                    <th>Auditable Type</th>
                    <th>Old Values</th>
                    <th>New Values</th>
                    {{-- <th>URL</th>
                    <th>IP Address</th>
                    <th>User Agent</th>
                    <th>Created At</th>
                    <th>Updated At</th> --}}
                </tr>
            </thead>
            <tbody>
                @foreach ($audits as $audit)
                    <tr>
                        <td>{{ $audit->id }}</td>
                        <td>{{ $audit->user_type }}</td>
                        <td>{{ $audit->user_id }}</td>

                        <td>{{ $audit->event }}</td>
                        <td>{{ $audit->auditable_type }}</td>
                        <td>{{ json_encode($audit->old_values) }}</td>
                        <td>{{ json_encode($audit->new_values) }}</td>
                        {{-- <td><a href="{{ $audit->url }}" target="_blank">{{ $audit->url }}</a></td>
                        <td>{{ $audit->ip_address }}</td>
                        <td>{{ $audit->user_agent }}</td>
                        <td>{{ $audit->created_at }}</td>
                        <td>{{ $audit->updated_at }}</td> --}}
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
