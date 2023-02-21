<div>
    <div class="col-md-2">
        <input type="text" class="form-control" placeholder="Search...." wire:model="searchName"/>
    </div>
    <table class="table table-striped">
        <thead>
            <tr>
                <th scope="col">Badge Number</th>
                <th scope="col">Name</th>
                <th scope="col">Postion</th>

            </tr>
        </thead>
        <tbody>
            
            @foreach ($name as $names)
            
                <tr>
                    <td>{{ $names->badge_number }}</td>
                    <td>{{ $names->name }}</td>
                    <td> 
                        <form method="POST" action="{{ route('updateUser', $names->id) }}">
                            @csrf
                            @method('PUT')
                        <select name="position" id="position">
                            <option value="1" {{ $names->position == '1' ? 'selected' : '' }}>1</option>
                            <option value="2" {{ $names->position == '2' ? 'selected' : '' }}>2</option>
                            <option value="3" {{ $names->position == '3' ? 'selected' : '' }}>3</option>
                        </select>
                        <button type="submit" class="btn btn-primary float-end">Update</button>
                        </form>
                    </td>
                    
                    
                </tr>
             
            @endforeach
        </tbody>
    </table>
</div>
