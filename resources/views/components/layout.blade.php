<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Invoices</title>
    @vite('resources/css/app.css')
</head>

<body class="container mx-auto">
    <section class="grid h-screen place-items-center">
        {{ $slot }}
    </section>
    <x-flash-message />
    <script src="http://code.jquery.com/jquery-3.3.1.min.js"
               integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
               crossorigin="anonymous">
    </script>
    <script type="text/javascript" src="{{asset('js/getSubject.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/repeater.js')}}"></script>
    <script>
        jQuery(document).ready(function () {

            jQuery('#receiver').change(function () {
                console.log('change');
                var ico = jQuery(this).val();
                jQuery.ajax({
                    url: "{{ url('subjectinfo') }}",
                    type: 'GET',
                    contentType: "application/json; charset=utf-8",
                    dataType: "json",
                    data: "ico=" + ico,
                    cache: false,
                    success: function (data) {
                        console.log(data);
                        if (data.status == 1) {
                            jQuery('input[name=receiver_company]').val(data.company);
                            jQuery('input[name=receiver_village]').val(data.village);
                            jQuery('input[name=receiver_zipcode]').val(data.zip_code);
                        } else {
                            
                        }
                    },
                });
            });

            jQuery('#supplier').change(function () {
                console.log('changex');
                console.log('change');
                var ico = jQuery(this).val();
                jQuery.ajax({
                    url: "{{ url('subjectinfo') }}",
                    type: 'GET',
                    contentType: "application/json; charset=utf-8",
                    dataType: "json",
                    data: "ico=" + ico,
                    cache: false,
                    success: function (data) {
                        console.log(data);
                        if (data.status == 1) {
                            jQuery('input[name=supplier_company]').val(data.company);
                            jQuery('input[name=supplier_village]').val(data.village);
                            jQuery('input[name=supplier_zipcode]').val(data.zip_code);
                        } else {
                            
                        }
                    },
                });
            });
        }
        );
    </script>
</body>

</html>
