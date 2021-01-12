<x-app-layout>

    <x-slot name="header">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <script src="https://kit.fontawesome.com/40fd0fe410.js" crossorigin="anonymous"></script>


        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            <?php $id = Auth::user()->id;?>
            @if(Auth()->user()->hasAnyRole(['Administrator']))
                Witaj {{\App\Models\Users::find($id)->name}}!
            @elseif(Auth()->user()->hasAnyRole(['Sekretariat']))
                    Witaj {{\App\Models\Users::find($id)->name}}!
            @elseif(Auth()->user()->hasAnyRole(['Wychowawca']))
                Witaj {{\App\Models\Teachers::where('users_id',$id)->first()->name}} {{\App\Models\Teachers::where('users_id',$id)->first()->second_name}} {{\App\Models\Teachers::where('users_id',$id)->first()->last_name}}

            @elseif(Auth()->user()->hasAnyRole(['Nauczyciel']))
                    Witaj {{\App\Models\Teachers::where('users_id',$id)->first()->name}} {{\App\Models\Teachers::where('users_id',$id)->first()->second_name}} {{\App\Models\Teachers::where('users_id',$id)->first()->last_name}}

            @elseif(Auth()->user()->hasAnyRole(['Rodzic']))
                Witaj {{\App\Models\Parents::where('users_id',$id)->first()->name}} {{\App\Models\Parents::where('users_id',$id)->first()->second_name}} {{\App\Models\Parents::where('users_id',$id)->first()->last_name}}

            @elseif(Auth()->user()->hasAnyRole(['Uczen']))
                Witaj {{\App\Models\Students::where('users_id', $id)->first()->name}} {{\App\Models\Students::where('users_id', $id)->first()->second_name}} {{\App\Models\Students::where('users_id', $id)->first()->last_name}}

            @else
                    Witaj {{\App\Models\Users::find($id)->name}}!
            @endif
        </h2>
    </x-slot>

    <style>
        #parent {
            display: flex;
        }
        #text {
            padding: 7%;
            text-align: center
        }
        #box {
            width: 33%;
            background: #F2ECA7;

            -webkit-box-shadow: inset 0 0 20px 10px white;
            box-shadow: inset 0 0 20px 10px white;
        }

        #guest {
            width: 100%;
            background: #F2ECA7;

            -webkit-box-shadow: inset 0 0 20px 10px white;
            box-shadow: inset 0 0 20px 10px white;
        }
        .borderless td, .borderless th {
            border: none;
        }



    </style>

    <div class="py-12">
        <div class="max-w-8xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <?php
                $new_message = DB::table('messages')->where([
                    'recipient' => Auth::user()->id,
                    'status' => 'new'
                ])->count();
                ?>

                    @if(Auth()->user()->hasAnyRole(['Administrator']))
                        @include('user_panel.admin')
                    @endif

                    @if(Auth()->user()->hasAnyRole(['Sekretariat']))
                        @include('user_panel.secretariat')
                    @endif

                    @if(Auth()->user()->hasAnyRole(['Wychowawca']))
                        @include('user_panel.educator')
                    @endif

                    @if(Auth()->user()->hasAnyRole(['Nauczyciel']))
                        @include('user_panel.teacher')
                    @endif

                    @if(Auth()->user()->hasAnyRole(['Rodzic']))
                        @include('user_panel.parent')
                    @endif

                    @if(Auth()->user()->hasAnyRole(['Uczen']))
                        @include('user_panel.student')

                    @endif

                @if(\App\Models\RolesHasUsers::where('users_id',$id)->count() == 0)
                        @include('user_panel.guest')
                    @endif


            </div>
        </div>
    </div>
</x-app-layout>
