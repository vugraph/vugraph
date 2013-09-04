@extends('layouts.email')
@section('content')
<p>Sayın <?= $name ?>,
<p>Türkiye Briç Federasyonu Masterpoint Sitesi'nde unutumuş olduğunuz şifrenizi değiştirebilmek için sıfırlama kodunuz: <strong> <?= $reset_password_code ?> </strong></p>
<p>Dilerseniz aşağıdaki bağlantıyı da kullanabilirsiniz:<br>
<a href="<?= $reset_password_link ?>"><?= $reset_password_link ?></a></p>
<p>Sıfırlama isteğini siz yapmadıysanız lütfen bu mesajı kaale almayın.</p>
@stop