<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<form method="POST" action="{{ route('users.store') }}">
    @csrf
    <label for="name">Name</label>
    <input id="name" type="text" name="name" required>

    <label for="email">Email</label>
    <input id="email" type="email" name="email" required>

    <label for="password">Password</label>
    <input id="password" type="password" name="password" required>

    <label for="password_confirmation">Confirm Password</label>
    <input id="password_confirmation" type="password" name="password_confirmation" required>

    <button type="submit">Create</button>
</form>
