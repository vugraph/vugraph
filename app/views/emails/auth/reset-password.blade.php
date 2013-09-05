@extends('emails/default')
@section('content')
<p>Sayın <?= $name ?>,
<p><?= $sitename ?> web sitesi şifrenizi değiştirmek için aşağıdaki bağlantıyı kullanabilirsiniz:<br>
<a href="<?= $link ?>"><?= $link ?></a></p>
<p>Sıfırlama isteğini siz yapmadıysanız lütfen bu mesajı kaale almayın.</p>
@stop