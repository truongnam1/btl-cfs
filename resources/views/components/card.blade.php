<div {{$attributes}}>
    @php
        echo "<pre>";
            print_r($cus);            
        echo "</pre>";
    @endphp

    {{$arr1("nam")}}
    <p>{{$attributes["cus"]}}</p>
</div>