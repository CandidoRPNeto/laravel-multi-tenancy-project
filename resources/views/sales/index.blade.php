<x-layouts.app>
    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="px-4 sm:px-6 lg:px-8">

                <x-heading
                    title="Sales"
                    description="A list of all sales."
                />

                <div class="overflow-hidden w-full md:rounded-lg">
                    <livewire:table
                        resource="Sale"
                        :columns="[
                        ['label' => 'Seller', 'column' => 'seller.user.name'],
                        ['label' => 'Client','column' => 'client.user.name'],
                        ['label' => 'Solod at', 'column' => 'sold_at'],
                        ['label' => 'Status', 'column' => 'status'],
                        ['label' => 'Total Amount', 'column' => 'total_amount']
                    ]
                    "
                        :eager-loading="['client.user', 'seller.user']"
                        edit="clients.edit"
                        delete="clients.destroy"
                    ></livewire:table>
                </div>

            </div>
        </div>
</x-layouts.app>