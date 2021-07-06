@if(count($parent->childrenAll) == 0)
    <li id="{{$parent->id}}" data-section="{{$parent->isSection ? "true" : "false"}}">
        <div class="d-flex justify-content-between">
            <div>
                <i class="{{$parent->icon}}"></i> {{$parent->name}} {{$parent->isSection ? "(section)" : ""}} {{$parent->isHidden ? "(hidden)" : "" }}
            </div>
            <div>
                <a href="dash/menus/menu-items/{{$grand_parent->id}}/edit/{{$parent->id}}" class="btn btn-primary clickable"><i class="far fa-edit clickable"></i></a>
                <a href="#" data-toggle="modal"  data-target="#deleteModal" data-grand_menu_id="{{$grand_parent->id}}" data-menu_id="{{$parent->id}}" data-menu_name="{{$parent->name}}" class="btn btn-danger clickable"><i class="far fa-trash-alt clickable"></i></a>
            </div>
        </div>
    </li>
@else
    <li id="{{$parent->id}}" data-section="{{$parent->isSection ? "true" : "false"}}">
        <div class="d-flex justify-content-between">
            <div class="">
                <i class="{{$parent->icon}}"></i> {{$parent->name}} {{$parent->isHidden ? "(hidden)" : "" }}
            </div>
            <div>
                <a href="dash/menus/menu-items/{{$grand_parent->id}}/edit/{{$parent->id}}" class="btn btn-primary clickable"><i class="far fa-edit clickable"></i></a>
                <a href="#" data-toggle="modal"  data-target="#deleteModal" data-grand_menu_id="{{$grand_parent->id}}" data-menu_id="{{$parent->id}}" data-menu_name="{{$parent->name}}" class="btn btn-danger clickable"><i class="far fa-trash-alt clickable"></i></a>
            </div>
        </div>
        <ul class="">
            @foreach($parent->childrenAll as $sub_menu)
                @include('dashboard.settings.menus.multilevel',['parent'=>$sub_menu,'grand_parent'=>$parent])
            @endforeach
        </ul>
    </li>
@endif
