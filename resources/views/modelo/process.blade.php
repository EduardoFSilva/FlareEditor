@extends('layouts.master')
@php
//Desabilita A Sombra Da Sidebar
$noSidebarElevation = true;
@endphp
@section('pageTitle')
    Gerar Modelo
@endsection
@section('headerLinks')
    <link href="{{ asset('summernote/summernote-bs4.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('codemirror/lib/codemirror.css') }}">
    <link rel="stylesheet" href="{{ asset('codemirror/theme/monokai.css') }}">
@endsection
@section('bodyContentWrapped')
    <div class="container p-4">
        <div>
            <ul class="nav nav-pills">
                <li class="nav-item"><a class="nav-link active" href="#guiaResultado" data-toggle="tab">Resultado</a>
                </li>
                <li class="nav-item"><a class="nav-link" href="#guiaHTML" data-toggle="tab">Código HTML</a>
                </li>
            </ul>
        </div>
        <br>
        <div class="tab-content">
            <div class="active tab-pane" id="guiaResultado">
                <div id="editorResultado">
                    @php
                        echo $parsedHtml;
                    @endphp
                </div>
            </div>
            <div class="tab-pane" id="guiaHTML">
                <div id="editorHTML">
                    @php
                        echo "<meta charset='UTF-8'>\n\n";
                        echo $parsedHtml."\n\n\n";
                    @endphp
                </div>
            </div>
        </div>
    @endsection
    @section('footerLinks')
        <script src="{{ asset('summernote/summernote-bs4.min.js') }}"></script>
        <script src="{{ asset('summernote/lang/summernote-pt-BR.min.js') }}"></script>
        <script src="{{ asset('codemirror/lib/codemirror.js') }}"></script>
        <script src="{{ asset('codemirror/mode/xml/xml.js') }}"></script>
        <script type="text/javascript">
            $(document).ready(function() {
                //Resultado
                $('#editorResultado').on('summernote.init', function() {
                    $('#editorResultado').summernote('disable');
                });
                $('#editorResultado').summernote({
                    toolbar: [

                    ],

                    lang: 'pt-BR',
                    fontSizes: ['8', '9', '10', '11', '12', '14', '16', '18', '20', '22', '24', '26', '28',
                        '36', '48', '72'
                    ],
                    lineHeights: ['0.2', '0.3', '0.4', '0.5', '0.6', '0.8', '1.0', '1.2', '1.4', '1.5',
                        '2.0',
                        '3.0'
                    ],
                    spellCheck: true,
                    height: 800,
                    disableResizeEditor: true
                });
                $('#editorHTML').summernote({
                    toolbar: [

                    ],
                    prettifyHtml: false,
                    codemirror: {
                        theme: 'monokai',
                    },
                    lang: 'pt-BR',
                    fontSizes: ['8', '9', '10', '11', '12', '14', '16', '18', '20', '22', '24', '26', '28',
                        '36', '48', '72'
                    ],
                    lineHeights: ['0.2', '0.3', '0.4', '0.5', '0.6', '0.8', '1.0', '1.2', '1.4', '1.5',
                        '2.0',
                        '3.0'
                    ],
                    height: 200,
                    width: 1000,
                    disableResizeEditor: true
                });
                $('#editorHTML').summernote('codeview.toggle');
            });
        </script>
    @endsection
