@props(['member'])

<!-- component -->
<div class="justify-center items-top">

    <div class="w-64 pb-6">
        <div class="py-3 bg-white rounded-lg shadow-xl">

            @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
            <div class="p-2 photo-wrapper">
                <img src="{{ $member->profile_photo_url }}"
                        alt="{{ $member->first_name . ' ' . $member->last_name }}"
                        class="object-cover w-20 h-20 mx-auto rounded-ful" />
                    </div>
            @endif


            <div class="p-2">
                <h3 class="text-xl font-medium leading-8 text-center text-gray-900">{{ $member->name }}</h3>
                {{-- <div class="text-xs font-semibold text-center text-gray-400">
                    <p>Web Developer</p>
                </div> --}}
                <table class="my-3 text-xs">
                    <tbody><tr>
                        <td class="px-2 py-2 font-semibold text-gray-500">{{ __('Mobile') }} </td>
                        <td class="px-2 py-2">{{ $member->mobile }}</td>
                    </tr>
                    <tr>
                        <td class="px-2 py-2 font-semibold text-gray-500">{{ __('Email') }} </td>
                        <td class="px-2 py-2">{{ $member->email }}</td>
                    </tr>
                    <tr>
                        <td class="px-2 py-2 font-semibold text-gray-500">{{ __('Bio') }} </td>
                        <td class="px-2 py-2">{{ $member->bio }}</td>
                    </tr>
                    @if($member->linkedin_profile)
                    <tr>
                        <td class="px-2 py-2 font-semibold text-gray-500">{{ __('LinkedIn') }} </td>
                        <td class="px-2 py-2"> <a class="text-xs italic font-medium" href="{{ $member->linkedin_profile }}" target="_blank"><x-bi-linkedin /> </a></td>
                    </tr>
                    @endif
                    @if($member->site)
                    <tr>
                        <td class="px-2 py-2 font-semibold text-gray-500">{{ __('Site') }} </td>
                        <td class="px-2 py-2"> <a class="text-xs italic font-medium" href="{{ $member->site }}" target="_blank"><x-bi-link /> </a></td>
                    </tr>
                    @endif
                    @if(auth()->user()?->is_admin)
                        @if($member->is_active )
                            <tr>
                                <td class="px-2 py-2 font-semibold text-gray-500">{{ __('Lock') }} </td>
                                <td class="px-2 py-2"> <a class="text-xs italic font-medium" href="{{ route('member.activate',['id'=>$member->id,'is_active'=>false]) }}" ><x-bi-lock /> </a></td>
                            </tr>
                        @else
                            <tr>
                                <td class="px-2 py-2 font-semibold text-gray-500">{{ __('Unlock') }} </td>
                                <td class="px-2 py-2"> <a class="text-xs italic font-medium" href="{{ route('member.activate',['id'=>$member->id,'is_active'=>true]) }}" ><x-bi-unlock /> </a></td>
                            </tr>
                        @endif
                        @if($member->is_admin)
                            <tr>
                                <td class="px-2 py-2 font-semibold text-gray-500">{{ __('Remove admin') }} </td>
                                <td class="px-2 py-2"> <a class="text-xs italic font-medium" href="{{ route('member.makeAdmin',['id'=>$member->id,'is_admin'=>false]) }}" ><x-bi-arrow-down-circle-fill /> </a></td>
                            </tr>
                        @else
                            <tr>
                                <td class="px-2 py-2 font-semibold text-gray-500">{{ __('Make admin') }} </td>
                                <td class="px-2 py-2"> <a class="text-xs italic font-medium" href="{{ route('member.makeAdmin',['id'=>$member->id,'is_admin'=>true]) }}" ><x-bi-arrow-up-circle-fill /> </a></td>
                            </tr>
                        @endif
                        <tr>
                            <td class="px-2 py-2 font-semibold text-red-500">{{ __('Delete') }} </td>
                            <td class="px-2 py-2">
                                <form id="delete-form" method="POST" action="{{ route('member.destroy',$member) }}">
                                    {{ csrf_field() }}
                                    {{ method_field('DELETE') }}

                                    <button type="submit" title="{{ __('Delete') }}" >
                                        <x-mdi-delete class="w-4 h-4" />
                                    </button>
                                </form>
                        </tr>
                    @endif
                    {{ $slot }}
                </tbody></table>
            </div>
        </div>
    </div>

    </div>
