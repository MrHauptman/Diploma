<p>Здравствуйте <b>{{ $user->name }}</b>,</p>

<p>Пользователь <b>{{ $author->name }}</b> Поделился с вами.</p>
<hr>
@foreach($files as $file)
    <p>{{$file->is_folder ? 'Folder' : 'File'}} - {{$file->name}}</p>
@endforeach
