@if (isset($roles))
    @foreach ($roles as $role)
        <div class="relative flex items-start">
            <div class="flex h-5 items-center">
                <input id="roles{{ $role->name }}" aria-describedby="{{ $role->name }}-description" name="roles[]"
                    value="{{ $role->id }}" type="checkbox"
                    class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500"
                    {{ $model->roles->contains($role->id) ? 'checked' : '' }}>
            </div>
            <div class="ml-3 text-sm">
                <label for="roles{{ $role->name }}" class="font-medium text-gray-700">{{ $role->display_name }} ->
                    {{ $role->guard_name }}</label>
                <p id="{{ $role->name }}-description" class="text-gray-500">
                    {{ $role->description }}</p>
            </div>
        </div>
    @endforeach
@else
    <label class="font-medium text-gray-700">Aún no existen Roles</label>
@endif
