<div>
    <div class="overflow-x-auto">
        <table class="w-full divide-y divide-gray-300">
            <thead class="bg-gray-50 dark:bg-gray-800">
                <tr>
                    @foreach($columns as $column)
                        <th scope="col" @class(["px-3 py-3.5 text-left text-sm font-semibold text-gray-900  dark:text-white"]) >{{ $column['label'] }}</th>
                    @endforeach

                    @if (!@session()->has('company_id'))
                        <th scope="col" class="relative py-3.5 pr-4 pl-3 sm:pr-6">
                            <span class="sr-only">Impersonate</span>
                        </th>
                    @endif

                    @if($edit)
                        <th scope="col" class="relative py-3.5 pr-4 pl-3 sm:pr-6">
                            <span class="sr-only">Edit</span>
                        </th>
                    @endif

                    @if($delete)
                        <th scope="col" class="relative py-3.5 pr-4 pl-3 sm:pr-6">
                            <span class="sr-only">Delete</span>
                        </th>
                    @endif
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
            @foreach($items as $item)
                <tr class="bg-white dark:bg-gray-700">
                    @foreach($columns as $column)
                        <td class="px-3 py-4 text-sm text-gray-500 whitespace-nowrap dark:text-white">{{ data_get($item, $column['column']) }}</td>
                    @endforeach

                    @if (!@session()->has('company_id'))
                        <td class="px-3 py-4 text-sm text-gray-500 whitespace-nowrap dark:text-white">
                            <a href="{{ route('impersonate.login', $item->user->id) }}" class="text-indigo-600 hover:text-indigo-900 dark:text-white dark:hover:text-gray-400">{{ __('Impersonate') }}</a>
                        </td>
                    @endif

                    @if($edit)
                        <td class="px-3 py-4 text-sm text-gray-500 whitespace-nowrap dark:text-white">
                            <a href="{{ route($edit, $item->id) }}" class="text-indigo-600 hover:text-indigo-900 dark:text-white dark:hover:text-gray-400">{{ __('Edit') }}</a>
                        </td>
                    @endif

                    @if($delete)
                        <td class="px-3 py-4 text-sm text-gray-500 whitespace-nowrap dark:text-white">
                            <a href="#" wire:click="$parent.destroy({{ $item }})">
                            {{ __('Delete') }}
                            </a>
                        </td>
                    @endif
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    <div class="py-4">
        {{ $items->links() }}
    </div>
</div>