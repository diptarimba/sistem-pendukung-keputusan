<div class="mb-2">
    <div class="col-form-label">{{ $label }}</div>
    <textarea name="{{ $name }}" id="{{ $name }}" class="editor" cols="30" rows="10">{!! $value !!}</textarea>
    @push('footer-carrier')
        <script>
            tinymce.init({
                selector: '#' + '{{ $name }}',
                convert_urls: false,
                plugins: [
                    'a11ychecker', 'advlist', 'advcode', 'advtable', 'autolink', 'checklist', 'export',
                    'lists', 'link', 'charmap', 'preview', 'anchor', 'searchreplace', 'visualblocks',
                    'powerpaste', 'fullscreen', 'formatpainter', 'insertdatetime', 'table', 'help', 'wordcount', 'image'
                ],
                toolbar: 'undo redo | formatpainter casechange blocks | bold italic backcolor | ' +
                    'alignleft aligncenter alignright alignjustify | ' +
                    'bullist numlist checklist outdent indent | removeformat | a11ycheck code table help | link image'
            });
        </script>
    @endpush
</div>
