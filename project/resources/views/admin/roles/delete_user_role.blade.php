<x-admin-master>
    @section('content')
    @if(auth()->user()->userHasRole('Admin'))
    <div class="card mb-4">
    <div class="card-body">

        <form action="{{ Route('user_role_deleted', $user->id)}}" method="post"> 
            @csrf
            
            <select name="role_id" id="">
            @foreach($roles as $role)
                <option value="{{$role->id}}">{{$role->name}}</option>
                @endforeach
            </select>
           
            <input type="submit" class="btn btn-primary" value="Delete">
        </form>
    </div>
    </div>
    @endif
    @endsection
</x-admin-master>