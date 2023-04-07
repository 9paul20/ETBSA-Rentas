<div class="mt-10 sm:mt-0">
    <div class="md:grid md:grid-cols-3 md:gap-6">
        <div class="md:col-span-1">
            <div class="px-4 sm:px-0">
                <h3 class="text-lg font-medium leading-6 text-gray-900">List Of Permissions</h3>
                <p class="mt-1 text-sm text-gray-600">Use a checkbox for formulate the permission.</p>
            </div>
        </div>
        <div class="mt-5 md:col-span-2 md:mt-0">
            <div class="overflow-hidden shadow sm:rounded-md">
                <div class="bg-white px-4 py-5 sm:p-6">
                    <form>
                        @csrf
                        <fieldset class="space-y-5">
                            <legend class="sr-only">Notifications</legend>
                            @if (isset($permissions))
                                @foreach ($permissions as $permission)
                                    <div class="relative flex items-start">
                                        <div class="flex h-5 items-center">
                                            <input id="{{ $permission['name'] }}"
                                                aria-describedby="{{ $permission['name'] }}-description"
                                                name="{{ $permission['name'] }}" type="checkbox"
                                                class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500">
                                        </div>
                                        <div class="ml-3 text-sm">
                                            <label for="{{ $permission['name'] }}"
                                                class="font-medium text-gray-700">{{ $permission['display_name'] }} ->
                                                {{ $permission['guard_name'] }}</label>
                                            <p id="{{ $permission['name'] }}-description" class="text-gray-500">
                                                {{ $permission['description'] }}</p>
                                        </div>
                                    </div>
                                @endforeach
                            @else
                            @endif
                        </fieldset>
                    </form>
                </div>
                <div class="bg-gray-50 px-4 py-3 text-right sm:px-6">
                </div>
            </div>
        </div>
    </div>
</div>
