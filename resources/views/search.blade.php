<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Search') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="flex flex-col space-y-4">
                        <form class="flex flex-col space-y-2" method="GET">
                            <x-label>Search Post</x-label>
                            <div class="flex-1 flex space-x-2">
                                <x-select name="user_id">
                                    <option value="">Any User</option>
                                    @foreach ($users as $user)
                                        <option value="{{$user->id}}" {{request()->get('user_id') == $user->id ? 'selected': ''}}>{{$user->name}}</option>
                                    @endforeach
                                </x-select>
                                <x-input type="text" name="query" placeholder="Your mom..." value="{{request()->get('query')}}" class="flex-1" />
                            </div>
                            <x-button type="submit" class="w-min">Search</x-button>
                        </form>

                        @if ($results)

                            @if ($results->count())

                            <em>Found {{$results->total()}} results</em>

                                @foreach($results as $p)
                                    <div class="flex flex-col space-y-2 rounded-lg shadow cursor-pointer hover:shadow-2xl px-5 py-3 transition">
                                        <div class="font-bold">{{$p->title}} #{{$p->id}}</div>
                                        <div class="text-sm">{{$p->description}}</div>
                                        <div class="text-xs font-bold">{{'@'.$p->user->name}}</div>
                                    </div>
                                @endforeach

                                <div class="">
                                    {{$results->links()}}
                                </div>
                            @else
                                 <b class="">No results found</b>
                            @endif

                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
