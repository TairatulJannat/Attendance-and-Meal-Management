<x-admin-master>
    @section('content')
    <h3>Profile</h3>
    
        @php
            $user = Auth::user();
        @endphp

        <form action="{{route('user.update')}}" method="post">
            @csrf 
            @method('PUT')
            <div class="form-group">
                <label for="name">Name</label>
                    <input type="text" name="name" class="form-control" id="name" aria-describedby="" value="{{$user->name}}">
            </div>

            <div class="form-group"> 
                <label for="email" >Email</label>
                    <input type="email" name="email" class="form-control" id="email" value="{{$user->email}}">
            </div>

            <div class="form-group"> 
                <label for="password" >Password</label>
                    <input type="password" name="password" class="form-control" id="password" value="{{$user->password}}">
            </div>

            <button type="submit" class="btn btn-primary">Update</button> 
        </form>

    @endsection
</x-admin-master>