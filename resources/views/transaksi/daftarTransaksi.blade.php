<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800 leading-tight">
            {{ __('Dasboard Transaksi') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="ml-6 mt-4">
                    <label class="font-semibold text-2xl">Aksi : </label>
                    <a href="{{ route('transaksi.peminjaman') }}">
                        <button class="px-2 py-1 font-semibold text-xl bg-blue-500 text-white rounded-full shadow-sm">+ Transaksi Baru &nbsp;</button>
                    </a>
                </div>
                <div class="p-6 text-gray-900">
                    {{-- {{ __("You're logged in!") }} --}}

                    <table class="border-collapse table-auto w-full text-sm">
                        <h1 class="mb-5 mt-2 text-3xl font-extrabold text-slate-900 tracking-tight">Daftar Transaksi</h1>
                        <thead>
                            <tr>
                                <th class="border-b border-slate-100 dark:border-slate-700 font-medium p-4 pl-8 pt-0 pb-3 text-black text-left">No</th>
                                <th class="border-b border-slate-100 dark:border-slate-700 font-medium p-4 pt-0 pb-3 text-black text-left">Peminjam</th>
                                <th class="border-b border-slate-100 dark:border-slate-700 font-medium p-4 pr-8 pt-0 pb-3 text-black text-left">Kendaraan</th>
                                <th class="border-b border-slate-100 dark:border-slate-700 font-medium p-4 pt-0 pb-3 text-black text-left">Tanggal Pinjam</th>
                                <th class="border-b border-slate-100 dark:border-slate-700 font-medium p-4 pt-0 pb-3 text-black text-left">Tanggal Selesai</th>
                                <th class="border-b border-slate-100 dark:border-slate-700 font-medium p-4 pt-0 pb-3 text-black text-left">Harga</th>
                                <th class="border-b border-slate-100 dark:border-slate-700 font-medium p-4 pt-0 pb-3 text-black text-left">Status</th>
                                <th class="border-b border-slate-100 dark:border-slate-700 font-medium p-4 pt-0 pb-3 text-black text-left">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($transactions as $item)
                            <tr>
                                <td class="border-b border-slate-100 dark:border-slate-700 p-4 text-black">{{ $loop->iteration }}</td>
                                <td class="border-b border-slate-100 dark:border-slate-700 p-4 text-black">{{ $item->peminjam }}</td>
                                <td class="border-b border-slate-100 dark:border-slate-700 p-4 text-black">{{ $item->kendaraan }}</td>
                                <td class="border-b border-slate-100 dark:border-slate-700 p-4 text-black">{{ \Carbon\Carbon::parse($item->start)->format('Y-m-d') }}</td>
                                <td class="border-b border-slate-100 dark:border-slate-700 p-4 text-black">{{ \Carbon\Carbon::parse($item->end)->format('Y-m-d') }}</td>
                                <td class="border-b border-slate-100 dark:border-slate-700 p-4 text-black">{{ $item->price }}</td>
                                <td class="border-b border-slate-100 dark:border-slate-700 p-4 text-black">{{ $item->status }}</td>
                                <td class="border-b border-slate-100 dark:border-slate-700 p-4 text-black">
                                    <a href="{{ route('transaksi.pengembalian', $item->id) }}">
                                        <button type="button" class="px-3 py-2 text-xs font-medium text-center text-white bg-green-700 rounded-xl hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">Edit Transaksi</button>
                                    </a>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td class="border-b border-slate-100 dark:border-slate-700 p-4 text-black">-</td>
                                <td class="border-b border-slate-100 dark:border-slate-700 p-4 text-black">-</td>
                                <td class="border-b border-slate-100 dark:border-slate-700 p-4 text-black">-</td>
                                <td class="border-b border-slate-100 dark:border-slate-700 p-4 text-black">-</td>
                                <td class="border-b border-slate-100 dark:border-slate-700 p-4 text-black">-</td>
                                <td class="border-b border-slate-100 dark:border-slate-700 p-4 text-black">-</td>
                                <td class="border-b border-slate-100 dark:border-slate-700 p-4 text-black">-</td>
                                <td class="border-b border-slate-100 dark:border-slate-700 p-4 text-black">-</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
