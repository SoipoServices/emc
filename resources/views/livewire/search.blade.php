<div>
    <div class="mx-auto mt-4 mb-4 max-w-7xl sm:px-6 lg:px-8">
        <div class="col-span-6 sm:col-span-4">
            <x-input id="search" name="search" type="text" class="block w-full mt-1" wire:model.live="search"
                placeholder="{{ __('Please enter a search key') }}" />
        </div>
    </div>
    <div class="mx-auto mt-4 mb-4 max-w-7xl sm:px-6 lg:px-8">
        <div class="lg:grid lg:grid-cols-4 lg:gap-1 place-items-start">
                @foreach ($members as $member)
                        <x-user-card :member=$member>
                            {{-- <tr>
                                <td class="px-2 py-2 font-semibold text-gray-500">{{ __('Details') }}  </td>
                                <td class="px-2 py-2"> <a class="text-xs italic font-medium " href="{{ route('member.show',$member) }}"><x-fas-edit  class="w-5 h-5" /> </a></td> --}}
                        </x-user-card>

                @endforeach
        </div>

    </div>

    <div class="mx-auto mt-4 mb-4 max-w-7xl sm:px-6 lg:px-8">
        {{ $members->links() }}
    </div>
</div>
