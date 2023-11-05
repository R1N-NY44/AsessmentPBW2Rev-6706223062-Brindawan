<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800 leading-tight">
            {{ __('Daftar Kendaraan') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{-- {{ __("You're logged in!") }} --}}

                    <table class="border-collapse table-auto w-full text-sm">
                        <thead>
                            <tr>
                                <th class="border-b border-slate-100 dark:border-slate-700 font-medium p-4 pl-8 pt-0 pb-3 text-black text-left">No</th>
                                <th class="border-b border-slate-100 dark:border-slate-700 font-medium p-4 pt-0 pb-3 text-black text-left">Kendaraan</th>
                                <th class="border-b border-slate-100 dark:border-slate-700 font-medium p-4 pr-8 pt-0 pb-3 text-black text-left">Type</th>
                                <th class="border-b border-slate-100 dark:border-slate-700 font-medium p-4 pt-0 pb-3 text-black text-left">License</th>
                                <th class="border-b border-slate-100 dark:border-slate-700 font-medium p-4 pt-0 pb-3 text-black text-left">Daily Price</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($vehicles as $item)
                                <tr>
                                    <td class="border-b border-slate-100 dark:border-slate-700 p-4 pl-8 text-black">{{ $loop->iteration }}</td>
                                    <td class="border-b border-slate-100 dark:border-slate-700 p-4 pl-8 text-black">{{ $item->name }}</td>
                                    <td class="border-b border-slate-100 dark:border-slate-700 p-4 pl-8 text-black">{{ $item->type }}</td>
                                    <td class="border-b border-slate-100 dark:border-slate-700 p-4 pl-8 text-black">{{ $item->license }}</td>
                                    <td class="border-b border-slate-100 dark:border-slate-700 p-4 pl-8 text-black">{{ $item->dailyprice }}</td>
                                </tr>
                            @empty
                            <tr>
                                <td class="border-b border-slate-100 dark:border-slate-700 p-4 pl-8 text-black">-</td>
                                <td class="border-b border-slate-100 dark:border-slate-700 p-4 pl-8 text-black">-</td>
                                <td class="border-b border-slate-100 dark:border-slate-700 p-4 pl-8 text-black">-</td>
                                <td class="border-b border-slate-100 dark:border-slate-700 p-4 pl-8 text-black">-</td>
                                <td class="border-b border-slate-100 dark:border-slate-700 p-4 pl-8 text-black">-</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
