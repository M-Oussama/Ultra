@extends('layouts.dashboard')

@section('page_meta')
    <title>Create role</title>
    <meta name="keywords" content="Rozaric" />
    <meta name="description" content="Rozaric">
    <meta name="author" content="Rozaric">
@endsection

@section('styles')
    <!-- Page styles -->
@endsection

@section('scripts')
    <!-- Page scripts -->
    <script>
        // init dual listbox
        var dualListBox = new DualListbox('#rolePermissions', {
            addEvent: function (value) {
                console.log(value);
            },
            removeEvent: function (value) {
                console.log(value);
            },
            availableTitle: 'Available permissions',
            selectedTitle: 'Has permissions',
            addButtonText: 'Add',
            removeButtonText: 'Remove',
            addAllButtonText: 'Add All',
            removeAllButtonText: 'Remove All'
        });
    </script>
@endsection

@section('content')
    <div class="container">
        <!--begin::Card-->
        <div class="card card-custom gutter-b example example-compact">
            <div class="card-header">
                <h3 class="card-title">Role</h3>
            </div>
            <!--begin::Form-->
            <form class="form" method="post" action="dash/roles">
                @csrf
                <div class="card-body">
                    <div class="form-group">
                        <label>Name:</label>
                        <input type="text" name="name" class="form-control form-control-solid" placeholder="Enter role name" required/>
                        <span class="form-text text-muted">Please enter the role's name</span>
                    </div>
                    <div class="form-group">
                        <select id="rolePermissions" multiple="multiple" name="rolePermissions[]">
                            @foreach($permissions as $permission)
                                <option value="{{$permission->id}}">{{$permission->name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="card-footer d-flex justify-content-end">
                    <button type="submit" class="btn btn-primary mr-2">Submit</button>
                    <a href="dash/roles" class="btn btn-secondary">Cancel</a>
                </div>
            </form>
            <!--end::Form-->
        </div>
        <!--end::Card-->
    </div>
@endsection
