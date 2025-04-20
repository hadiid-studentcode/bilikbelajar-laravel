@extends('layouts.main')

@push('css')
    <script src="https://cdn.ckeditor.com/ckeditor5/39.0.1/classic/ckeditor.js"></script>
@endpush

@section('content')
    <div class="container">
        <form method="POST" action="{{ route('text-editor') }}">
            @csrf
            <input type="hidden" name="content" id="content" value="{{ $content }}" />
            <div id="editor"></div>
            <button type="submit" class="btn btn-primary mt-3">Submit</button>
        </form>
    </div>
@endsection

@push('js')
    <script>
        ClassicEditor.create(document.querySelector("#editor"), {
                toolbar: [
                    "undo",
                    "redo",
                    "|",
                    "heading",
                    "|",
                    "bold",
                    "italic",
                    "|",
                    "link",
                    "bulletedList",
                    "numberedList",
                    "|",
                    "indent",
                    "outdent",
                    "|",
                    "blockQuote",
                    "insertTable",
                    "|",
                ],
            })
            .then((editor) => {
                // Set editor height using CSS
                editor.editing.view.change((writer) => {
                    writer.setStyle(
                        "height",
                        "300px",
                        editor.editing.view.document.getRoot()
                    );
                    writer.setStyle(
                        "width",
                        "100%",
                        editor.editing.view.document.getRoot()
                    );
                });

                // Set initial content from hidden input
                const initialContent = document.querySelector("#content").value;
                editor.setData(initialContent);

                editor.model.document.on("change:data", () => {
                    document.querySelector("#content").value = editor.getData();
                });
            })
            .catch((error) => {
                console.error(error);
            });
    </script>
@endpush
