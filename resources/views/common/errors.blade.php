<!-- resources/views/common/errors.blade.php -->
 @if (count($errors) > 0)
 <!-- form error list -->
  <div class="alert alert-danger">
    <div><strong>入力した文字を修正してください</strong></div>
    <div>
        <ul>
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
</div>
@endif
