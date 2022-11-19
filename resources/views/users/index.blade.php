<x-app-layout>
  <h1>
    Uzytkownicy
  </h1>
  <ul>
    @foreach ($users as $user)
    <li>
        {{ $user->name }}
        @if ($user->roles->count() > 0)
        [
        @foreach ($user->roles as $role)
            {{ $role->name }}
        @endforeach
        ]
        @endif
    </li>
    @endforeach
  </ul>

</x-app-layout>