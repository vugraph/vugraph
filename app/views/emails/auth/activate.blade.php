@extends('emails/default')
@section('content')
<p>Sayın <?= $name ?>,
<p><?= $sitename ?> web sitesine yapmış olduğunuz kaydı aktive etmek için aşağıdaki bağlantıyı kullanınız:<br>
<a href="<?= $link ?>"><?= $link ?></a></p>
<p>Kaydı siz yapmadıysanız lütfen bu mesajı kaale almayın.</p>
@stop