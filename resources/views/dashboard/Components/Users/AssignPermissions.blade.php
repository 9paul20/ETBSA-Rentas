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
                <form method="POST" action="{{ route('Dashboard.Admin.Users.UpdatePermissions', $permission->id) }}">
                    @csrf
                    @method('PUT')
                    <div class="bg-white px-4 py-5 sm:p-6">
                        <fieldset class="space-y-5">
                            <legend class="sr-only">Notifications</legend>
                            @include('Dashboard.Components.PermissionsCheckboxes', [
                                'model' => $permission,
                            ])
                        </fieldset>
                    </div>
                    <x-Dashboard.Save-Button name="Guardar Permisos" />
                </form>
            </div>
        </div>
    </div>
</div>
