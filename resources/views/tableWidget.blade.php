@extends('adminPanel')
@section('tableWidget')
    <div style="text-align: center; padding-top: 1em">
        <span class="head-title">MANAGING TABLE: {{strtoupper($tableName)}}</span>
        <hr/>
    </div>
    <div class="table-widget-main-container">
        <div class="table-container">
            <table class="table table-success table-striped-columns">
                <thead>
                <tr>

                    @for($i = 0; $i < count(array_keys((array)$table->first())); $i++)
                        @php
                            $columnNames = array_keys((array)$table->first());
                        @endphp
                        <th scope="col">{{ $columnNames[$i] }}</th>
                    @endfor
                </tr>
                </thead>
                <tbody>

                @foreach($table->all() as $row)
                    <tr>
                        @for($i = 0; $i < count($columnNames); $i++)
                            <td class="truncate-text col-6">{{ $row->{$columnNames[$i]} }}</td>
                        @endfor
                    </tr>
                @endforeach
                </tbody>
            </table>

        </div>
        <div class="crud-container">
            <nav>
                <div class="nav nav-tabs" id="nav-tab" role="tablist">
                    <button class="nav-link active" id="nav-home-tab" data-bs-toggle="tab" data-bs-target="#nav-home" type="button" role="tab" aria-controls="nav-home" aria-selected="true">Create</button>
                    <button class="nav-link" id="nav-profile-tab" data-bs-toggle="tab" data-bs-target="#nav-profile" type="button" role="tab" aria-controls="nav-profile" aria-selected="false">Update</button>
                    <button class="nav-link" id="nav-contact-tab" data-bs-toggle="tab" data-bs-target="#nav-contact" type="button" role="tab" aria-controls="nav-contact" aria-selected="false">Delete</button>

                </div>
            </nav>
            <div class="tab-content" id="nav-tabContent">
                <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab" tabindex="0">
                    @if(request()->has('posts'))
                        @yield('post__create__form')
                    @endif
                </div>
                <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab" tabindex="0">
                    @if(request()->has('posts'))
                        @yield('post__update__form')
                    @endif
                </div>
                <div class="tab-pane fade" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab" tabindex="0">
                    @if(request()->has('posts'))
                        @yield('post__delete__form')
                    @endif
                </div>
            </div>
        </div>
    </div>

@endsection
