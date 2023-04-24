@if (isset($permissions))
    @foreach ($permissions as $permission)
        <div class="relative flex items-start">
            <div class="flex h-5 items-center">
                <input id="permissions{{ $permission->name }}" aria-describedby="{{ $permission->name }}-description"
                    name="permissions[]" value="{{ $permission->id }}" type="checkbox"
                    class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500"
                    {{ $user->permissions instanceof \Illuminate\Support\Collection && $user->permissions->contains($permission->id) ? 'checked' : '' }}>
            </div>
            <div class="ml-3 text-sm">
                <label for="permissions{{ $permission->name }}"
                    class="font-medium text-gray-700">{{ $permission->display_name }} ->
                    {{ $permission->guard_name }}</label>
                <p id="{{ $permission->name }}-description" class="text-gray-500">
                    {{ $permission->description }}</p>
            </div>
        </div>
    @endforeach
@else
    <label class="font-medium text-gray-700">Aún no existen Permisos</label>
@endif
