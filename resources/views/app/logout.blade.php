@if ((Session::has('user_name')))
    {{!! Session::flush() !!}}
    {{!! redirect()->to('/') !!}}
@else
    {{!! redirect()->to('/') !!}}
@endif
