@extends('layouts/dashboard/app')
@section('content')
    <div class="main-container container-fluid px-0">
        <div class="row">
            <div class="col-xl-12 col-lg-12 col-md-8 col-sm-12">
                <div class="card border-10">
                    <div class="card-header border-bottom-0">
                        <div class="d-flex">
                            <div class="media mt-5">
                                <div class="media-body">
                                    <h6 class="mb-1 mt-1 font-weight-bold h3">Hello {{ Auth::user()->name ?? 'Daniel' }},
                                    </h6>
                                    <small class="h4">My Notes</small>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body pt-5">
                        <div class="row" id="note_div_section">
                            @isset($notes)
                                @if ($notes->count() > 0)
                                    @foreach ($notes as $note)
                                        <div class="col-md-4 col-sm-12">
                                            <div class="card card-note">
                                                <div class="card-header border-bottom-0">
                                                    <h4 class="card-title font-weight-bold h2" style="text-transform:initial;">
                                                    </h4>
                                                    <div class="card-options">
                                                        <a href="javascript:void(0);"
                                                            class="btn btn-sm font-weight-bold">{{ $note->created_at->format('D j, Y') }}</a>
                                                    </div>
                                                </div>
                                                <div class="card-body pt-0">
                                                    <a onclick="shiNew(event)" data-type="dark" data-size="m"
                                                        data-title="{{ $note->title }}"
                                                        href="{{ route('user.note', $note->id) }}">
                                                        <h4 class="font-weight-bold h5">{{ $note->title ?? '' }}</h4>
                                                    </a>
                                                    <p>
                                                    {{ mb_strimwidth($note->content ?? '', 0, 50, '...') }}
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                @else
                                    <div class="text-center pb-2 text-black">
                                        <h4>No notes available yet</h4>
                                    </div>
                                @endif
                            @endisset
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        function updateTextInput(val) {
            document.getElementById('textInput').value = val;
        }
    </script>
@endsection
