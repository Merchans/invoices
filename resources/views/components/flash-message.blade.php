@if(session()->has('message'))
<div id="message" class="fixed top-0 left-1/2 transform -translate-x-1/2 p-4 mb-4 text-sm text-green-700 bg-green-100 rounded-lg dark:bg-green-200 dark:text-green-800" role="alert">
  <p>
    {{session('message')}}
  </p>
</div>
@endif
