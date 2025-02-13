<x-layouts.app>
    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="px-4 sm:px-6 lg:px-8">

                <x-heading
                    title="Client"
                    description="A list of all the clients."
                    btn-label="Add Client"
                    :route="route('clients.create')" />

                <div class="overflow-hidden w-full md:rounded-lg">
                    <livewire:table
                        resource="Client"
                        :columns="[
                            ['label' => 'Client', 'column' => 'user.name'],
                            ['label' => 'Company','column' => 'company.name'],
                            ['label' => 'Email','column' => 'user.email'],
                            ['label' => 'City', 'column' => 'address.city'],
                            ['label' => 'State', 'column' => 'address.state'],
                        ]
                        "
                        :eager-loading="['user', 'address', 'company']"
                        edit="clients.edit"
                        delete="clients.destroy"
                    ></livewire:table>
                </div>

        </div>
    </div>
</x-layouts.app>