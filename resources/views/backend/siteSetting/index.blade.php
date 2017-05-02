@extends('backend.layout.admin')


@section('content')
    <div class="row" style="padding: 25px;">
        <div class="col s12 z-depth-1">
            <h5>Update Site Setting</h5>
        </div>
    </div>
    <div class="row" style="padding: 25px;">
        <div class="col s12  z-depth-1">
            <div class="card-panel teal">
                <span class="white-text">Perfered To MAke The Advantages Part String Length To Be 280 letter</span>
            </div>
        </div>
    </div>
    <div class="row" style="padding: 25px;">
        <div class="col s12 z-depth-3">
            <br>
            <form action="{{ route('setting.update') }}" method="post">
                {{ csrf_field() }}
                {{-- `id`, `slug`, `nameSetting`, `value`, `type`, `created_at`, `updated_at` FROM `site_settings` --}}
                @foreach ($siteSetting as $site)
                     <div class="row">
                         <div class="input-field col s8">
                               @if ($site->type == 0)
                                    <input
                                        type="text"
                                        id="{{ $site->nameSetting }}"
                                        class="validate"
                                        name="{{ $site->nameSetting }}"
                                        value="{{ $site->value }}">
                               @elseif ($site->type == 1)
                                    <textarea class="materialize-textarea" name="{{ $site->nameSetting }}" data-length="280">{{ $site->value }}</textarea>
                               @endif
                             <label for="{{ $site->nameSetting }}">{{ $site->slug }}</label>
                         </div>
                     </div>
                @endforeach


                <div class="row">
                    <div class="input-field col s12">
                        <button class="btn waves-effect waves-light" type="submit">Update Setting
                            <i class="material-icons right">edit</i>
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection


@section('scripts')
    @if (Session::has('message'))
        <script type="text/javascript">
            var $toastContent = $('<span>{{ Session::get('message') }}</span>');
            Materialize.toast($toastContent, 5000);
        </script>
    @endif
    @if (count($errors) > 0)
        @foreach ($errors->all() as $error)
            <script type="text/javascript">
                var $toastContent = $('<span>{{ $error }}</span>');
                Materialize.toast($toastContent, 20000);
            </script>
        @endforeach
    @endif
@endsection
