@php
    use Knuckles\Scribe\Tools\WritingUtils as u;
    /** @var  Knuckles\Camel\Output\OutputEndpointData $endpoint */
@endphp

{{-- ```text
{{ rtrim($baseUrl, '/') }}/{{ ltrim($endpoint->boundUri, '/') }}
``` --}}

@if(count($endpoint->cleanQueryParameters))
{{-- ```text
Query params
``` --}}
```json
{!! u::printQueryParamsAsKeyValue($endpoint->cleanQueryParameters, "\"", ":", 4, "{}") !!}
```
@endif

{{-- @if(!empty($endpoint->headers))
```json
{
@foreach($endpoint->headers as $header => $value)
    "{{$header}}": "{{$value}}",
@endforeach
@empty($endpoint->headers['Accept'])
    "Accept": "application/json",
@endempty
}
```
@endif --}}

@if(count($endpoint->cleanBodyParameters))
{{-- ```text
Body
``` --}}
```json
@if ($endpoint->headers['Content-Type'] == 'application/x-www-form-urlencoded')
{!! http_build_query($endpoint->cleanBodyParameters, '', '&') !!}
@else
{!! json_encode($endpoint->cleanBodyParameters, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE) !!}
```
@endif
@endif
