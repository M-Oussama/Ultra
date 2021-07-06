@extends('layouts.dashboard')

@section('page_meta')
    <title>Create menu-item for menu: {{$menu->name}}</title>
    <meta name="keywords" content="Rozaric" />
    <meta name="description" content="Rozaric">
    <meta name="author" content="Rozaric">
@endsection

@section('styles')
    <!-- Page styles -->

@endsection

@section('scripts')
    <!-- Page scripts -->

@endsection

@section('content')
    <div class="container">
        <!--begin::Card-->
        <div class="card card-custom gutter-b example example-compact">
            <div class="card-header">
                <h3 class="card-title">Menu-item for {{$menu->name}}</h3>
            </div>
            <!--begin::Form-->
            <form class="form" method="post" action="dash/menus/menu-items/{{$menu->id}}/update/{{$menu_item->id}}">
                @csrf
                <input type='hidden' value='0' name='isSection'>
                <input type='hidden' value='0' name='isHidden'>
                <div class="card-body">
                    <div class="form-group">
                        <label>Name:</label>
                        <input type="text" name="name" class="form-control form-control-solid" value="{{$menu_item->name}}" placeholder="Enter menu name" required/>
                        <span class="form-text text-muted">Please enter the menu's name</span>
                    </div>
                    <div class="form-group">
                        <label>Url:</label>
                        <input type="text" name="url" class="form-control form-control-solid" value="{{$menu_item->url}}" placeholder="Enter menu url" required/>
                        <span class="form-text text-muted">Please enter the menu's url</span>
                    </div>
                    <div class="form-group">
                        <label>Permissions:</label>
                        <input type="text" name="permissions" class="form-control form-control-solid" value="{{$menu_item->permissions}}" placeholder="Enter menu permissions" required/>
                        <span class="form-text text-muted">Please enter the menu's permissions</span>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-6 col-sm-12">
                            <label>Icon:</label>
                            <input type="text" name="icon" class="form-control form-control-solid" value="{{$menu_item->icon}}" placeholder="Enter menu icon" required/>
                            <span class="form-text text-muted">Please enter the menu's icon</span>
                        </div>
                        <div class="form-group col-md-6 col-sm-12">
                            <label>Order:</label>
                            <input type="number" name="order" class="form-control form-control-solid" value="{{$menu_item->order}}" placeholder="Enter menu order" required/>
                            <span class="form-text text-muted">Please enter the menu's order</span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-3 col-form-label">Section</label>
                        <div class="col-3">
                            <span class="switch switch-primary">
                                <label>
                                    <input type="checkbox" name="isSection" {{$menu_item->isSection ? "checked='checked'" : ""}} value="1" />
                                    <span></span>
                                </label>
                            </span>
                        </div>
                        <label class="col-3 col-form-label">Hidden</label>
                        <div class="col-3">
                            <span class="switch switch-dark">
                                <label>
                                    <input type="checkbox" name="isHidden" {{$menu_item->isHidden ? "checked='checked'" : ""}} value="1" />
                                    <span></span>
                                </label>
                            </span>
                        </div>
                    </div>
                </div>
                <div class="card-footer d-flex justify-content-end">
                    <button type="submit" class="btn btn-primary mr-2">Submit</button>
                    <a href="dash/menus/{{$menu->id}}/edit" class="btn btn-secondary">Cancel</a>
                </div>
            </form>
            <!--end::Form-->
        </div>
        <!--end::Card-->
    </div>
@endsection
