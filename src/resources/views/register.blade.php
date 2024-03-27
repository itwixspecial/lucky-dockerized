<form method="POST" action="{{ route('register') }}">
    @csrf

    <div class="mb-3">
        <label for="username" class="form-label">Username</label>
        <input type="text" class="form-control" id="username" name="username" required>
    </div>

    <div class="mb-3">
        <label for="phonenumber" class="form-label">Phonenumber</label>
        <input type="text" class="form-control" id="phonenumber" name="phonenumber" required>
    </div>

    <button type="submit" class="btn btn-primary">Register</button>
</form>

@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif